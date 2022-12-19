<?php

namespace Factorial\Libreja;

use Factorial\Libreja\Basic\AccessToken;
use Factorial\Libreja\Connection\Curl;
use Factorial\Libreja\Environment\EnvironmentInterface;
use Factorial\Libreja\Exception\HttpException;
use Factorial\Libreja\Exception\IOException;
use Factorial\Libreja\Http\HttpRequestInterface;
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
   * @param string[] $credentials
   *   API credentials.
   * @param \Factorial\Libreja\Basic\AccessToken $accessToken
   *   Access token.

   */
  public function __construct(EnvironmentInterface $environment, array $credentials = [], AccessToken $accessToken = null) {
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
    $url = $this->environment->baseUrl() . $httpRequest->endpoint;
    $formattedHeaders = $this->prepareHeaders($httpRequest->headers);

    $curl->setOpt(CURLOPT_URL, $url);
    $curl->setOpt(CURLOPT_CUSTOMREQUEST, $httpRequest->verb);
    $curl->setOpt(CURLOPT_HTTPHEADER, $this->serializeHeaders($formattedHeaders));
    $curl->setOpt(CURLOPT_RETURNTRANSFER, 1);
    $curl->setOpt(CURLOPT_HEADER, 1);

    if (!empty($httpRequest->data) && isset($httpRequest->body)) {
      if (isset($formatted_headers['content-type']) && $formatted_headers['content-type'] == 'application/json') {
        $body = json_encode($httpRequest->body);
      }
      else {
        $body = http_build_query($httpRequest->body);
      }
      if (!empty($body)) {
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
    $headerArray = [];
    if ($headers) {
      foreach ($headers as $key => $val) {
        $headerArray[] = $key . ': ' . $val;
      }
    }

    return $headerArray;
  }

  /**
   * Convert header to array.
   */
  private function headersToArray($header) {
    $headers = [];
    $headersTmp = explode("\r\n", $header);
    for ($i = 0; $i < count($headersTmp); ++$i) {
      if (strlen($headersTmp[$i]) > 0) {
        if (strpos($headersTmp[$i], ':')) {
          $headerName = substr($headersTmp[$i], 0, strpos($headersTmp[$i], ':'));
          $headerValue = substr($headersTmp[$i], strpos($headersTmp[$i], ':') + 1);
          $headers[$headerName] = $headerValue;
        }
      }
    }

    return $headers;
  }

  /**
   * Returns an array representing lower case headers.
   */
  protected function prepareHeaders($headers) {
    $preparedHeaders = array_change_key_case($headers);
    if (array_key_exists('content-type', $preparedHeaders)) {
      $preparedHeaders['content-type'] = strtolower($preparedHeaders['content-type']);
    }
    return $preparedHeaders;
  }

  /**
   * Parse response.
   *
   * @throws \Factorial\Libreja\Exception\HttpException
   * @throws \Factorial\Libreja\Exception\IOException
   */
  private function parseResponse($curl) {
    $responseData = $curl->exec();
    $statusCode = $curl->getInfo(CURLINFO_HTTP_CODE);
    $errorCode = $curl->errNo();
    $error = $curl->error();

    if ($errorCode > 0) {
      throw new IOException($error, $errorCode);
    }

    $headerSize = $curl->getInfo(CURLINFO_HEADER_SIZE);
    if (!empty($responseData)) {
      $response = json_decode(substr($responseData, $headerSize), true);
      if (!empty($response['error'])) {
        $header_str = substr($responseData, 0, $headerSize);
        $headers = $this->headersToArray($header_str);
        throw new HttpException($response['error']['message'], $statusCode, $headers);
      }
      return $response;
    }
    return [];
  }
}