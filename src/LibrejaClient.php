<?php

namespace Factorial\Libreja;

use Factorial\Libreja\Basic\AccessToken;
use Factorial\Libreja\Connection\Curl;
use Factorial\Libreja\Environment\EnvironmentInterface;
use Factorial\Libreja\Exception\HttpException;
use Factorial\Libreja\Injector\AuthenticationInjector;
use Factorial\Libreja\Injector\InjectorInterface;

/**
 * Libreja http client.
 */
class LibrejaClient {

  /**
   * Libreja api enviroment.
   *
   * @var \Factorial\Libreja\Environment\EnvironmentInterface
   */
  public $environment;

  /**
   * Injections data.
   *
   * @var \Factorial\Libreja\Injector\InjectorInterface[]
   */
  public $injectors = [];

  /**
   * Access token.
   *
   * @var \Factorial\Libreja\Basic\AccessToken
   */
  private $accessToken;

  /**
   * Authentication header injector.
   *
   * @var \Factorial\Libreja\Injector\InjectorInterface
   */
  public $authInjector;

  /**
   * Constructor.
   *
   * @param \Factorial\Libreja\Environment\EnvironmentInterface $environment
   *   Libreja enviroment.
   * @param \Factorial\Libreja\Basic\AccessToken $accessToken
   *   Access token.
   * @param string[] $credentials
   *   API credentials.
   */
  public function __construct(EnvironmentInterface $environment, AccessToken $accessToken, array $credentials = []) {
    $this->environment = $environment;
    $this->accessToken = $accessToken;
    $this->authInjector = new AuthenticationInjector($this, $environment, $accessToken, $credentials);
    $this->addInjector($this->authInjector);
  }

  /**
   * Injectors for modifying a request, Executed in first-in first-out order.
   *
   * @param \Factorial\Libreja\Injector\InjectorInterface $inj
   *   The injectors.
   */
  public function addInjector(InjectorInterface $inj) {
    $this->injectors[] = $inj;
  }

  /**
   * Execute libreja api request.
   *
   * @param \Factorial\Libreja\Http\HttpRequestInterface $httpRequest
   *   Current request.
   *
   * @return array|null
   *   The api response.
   */
  public function execute(HttpRequestInterface $httpRequest) {
    $curl = Curl::getInstance();

    foreach ($this->injectors as $inj) {
      $inj->inject($httpRequest);
    }
    $url = $this->environment->baseUrl() . $httpRequest->path;
    $formattedHeaders = $this->prepareHeaders($httpRequest->headers);

    $curl->setOpt(CURLOPT_URL, $url);
    $curl->setOpt(CURLOPT_CUSTOMREQUEST, $httpRequest->verb);
    $curl->setOpt(CURLOPT_HTTPHEADER, $this->serializeHeaders($formattedHeaders));
    $curl->setOpt(CURLOPT_RETURNTRANSFER, 1);
    $curl->setOpt(CURLOPT_HEADER, 1);

    if (!is_null($httpRequest->body)) {
      if (isset($formatted_headers['content-type']) && $formatted_headers['content-type'] == 'application/json') {
        $body = json_encode($httpRequest->body);
      }
      else {
        $body = http_build_query($httpRequest->body);
      }
      if (!empty($httpRequest->body)) {
        $curl->setOpt(CURLOPT_POSTFIELDS, $body);
      }
    }

    if (strpos($this->environment->baseUrl(), 'https://') === 0) {
      $curl->setOpt(CURLOPT_SSL_VERIFYPEER, TRUE);
      $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
    }

    $response = $this->parseResponse($curl);
    $curl->close();
    return $response;
  }

  /**
   * Serialize headers.
   */
  private function serializeHeaders(array $headers) {
    $header_array = [];
    if ($headers) {
      foreach ($headers as $key => $val) {
        $header_array[] = $key . ': ' . $val;
      }
    }

    return $header_array;
  }

  /**
   * Convert header to array.
   */
  private function headersToArray($header) {
    $headers = [];
    $headers_tmp = explode("\r\n", $header);
    for ($i = 0; $i < count($headers_tmp); ++$i) {
      if (strlen($headers_tmp[$i]) > 0) {
        if (strpos($headers_tmp[$i], ':')) {
          $header_name = substr($headers_tmp[$i], 0, strpos($headers_tmp[$i], ':'));
          $header_value = substr($headers_tmp[$i], strpos($headers_tmp[$i], ':') + 1);
          $headers[$header_name] = $header_value;
        }
      }
    }

    return $headers;
  }

  /**
   * Returns an array representing lower case headers.
   */
  protected function prepareHeaders($headers) {
    $prepared_headers = array_change_key_case($headers);
    if (array_key_exists('content-type', $prepared_headers)) {
      $prepared_headers['content-type'] = strtolower($prepared_headers['content-type']);
    }
    return $prepared_headers;
  }

  /**
   * Execute libreja api request.
   *
   * @param \Factorial\Libreja\Http\HttpRequestInterface $http_request
   *   Current request.
   *
   * @return array|null
   *   The api response.
   */


  /**
   * Parse response.
   *
   * @throws \Factorial\Libreja\Exception\HttpException
   * @throws \Factorial\Libreja\Exception\IOException
   */
  private function parseResponse($curl) {
    $response_data = $curl->exec();
    $status_code = $curl->getInfo(CURLINFO_HTTP_CODE);
    $error_code = $curl->errNo();
    $error = $curl->error();

    if ($error_code > 0) {
      throw new IOException($error, $error_code);
    }

    if (!empty($response_data)) {
      $response = json_decode($response_data);
      if (!empty($response['error'])) {
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header_str = substr($response_data, 0, $header_size);
        $headers = $this->headersToArray($header_str);
        throw new HttpException($response['error'], $status_code, $headers);
      }
      return $response;
    }
    return [];
  }
}