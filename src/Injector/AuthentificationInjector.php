<?php

namespace Factorial\Libreja\Injector;

use Factorial\Libreja\Basic\AccessToken;
use Factorial\Libreja\Connection\AuthentificationRequest;
use Factorial\Libreja\Environment\EnvironmentInterface;
use Factorial\Libreja\LibrejaClient;

/**
 * The authentification injector.
 */
class AuthentificationInjector {

  /**
   * The http client.
   *
   * @var \Factorial\Libreja\LibrejaClient
   */
  private $client;

  /**
   * The enviroment.
   *
   * @var \Factorial\Libreja\Environment\EnvironmentInterface
   */
  private $environment;

  /**
   * @var string[]
   */
  private $credentials;

  /**
   * The access token.
   *
   * @var \Factorial\Libreja\Basic\AccessToken
   */
  private $accessToken;

  /**
   * Creates the discovery object.
   *
   * @param \Factorial\Libreja\LibrejaClient $client
   *   The http client handle request.
   * @param \Factorial\Libreja\Environment\EnvironmentInterface $environment
   *   The request enviroment.
   * @param array $credentials
   *   The authentification credentials.
   * @param \Factorial\Libreja\Basic\AccessToken|null $accessToken
   *   The access token.
   */
  public function __construct(LibrejaClient $client, EnvironmentInterface $environment, array $credentials, $accessToken = null) {
    $this->client = $client;
    $this->environment = $environment;
    $this->credentials = $credentials;
    $this->accessToken = $accessToken;
  }

  /**
   * Inject request header.
   *
   * @param \Factorial\Libreja\Http\HttpRequestInterface $request
   *   The http request.
   */
  public function inject(HttpRequestInterface &$request) {
    if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request)) {
      if (is_null($this->accessToken) || $this->accessToken->isExpired()) {
        $this->accessToken = $this->fetchAccessToken();
      }
      $request->headers['Authorization'] = 'librejaToken ' . $this->accessToken->token;
    }
  }

  /**
   * Fetch access token.
   *
   * @return \Factorial\Libreja\Basic\AccessToken
   *   The access token object.
   */
  private function fetchAccessToken() {
    $access_token_response = $this->client->execute(new AuthentificationRequest($this->environment, $this->credentials));
    return new AccessToken($access_token_response->access_token, $access_token_response->token_type, $access_token_response->expires_in);
  }

  /**
   * Check whether request is auth request.
   *
   * @param \Factorial\Libreja\Http\HttpRequestInterface $request
   *   The http request.
   *
   * @return bool
   *   Whether auth request.
   */
  private function isAuthRequest(HttpRequestInterface $request) {
    return $request instanceof AuthentificationRequest;
  }

  /**
   * Check whether request has auth header.
   *
   * @param \Factorial\Libreja\Http\HttpRequestInterface $request
   *   The http request.
   *
   * @return bool
   *   Request has auth header.
   */
  private function hasAuthHeader(HttpRequestInterface $request) {
    return array_key_exists('Authorization', $request->headers);
  }

}