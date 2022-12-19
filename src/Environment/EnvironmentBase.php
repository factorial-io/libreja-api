<?php

namespace Factorial\Libreja\Environment;

use Factorial\Libreja\Basic\AccessToken;

/**
 * Abstract Libreja environment class.
 */
abstract class EnvironmentBase implements EnvironmentInterface {

  /**
   * Api access token.
   *
   * @var \Factorial\Libreja\Basic\AccessToken
   */
  private $accessToken;

  /**
   * Constructor.
   *
   * @param \Factorial\Libreja\Basic\AccessToken|null $accessToken
   *   The api authentication token.
   */
  public function __construct(AccessToken $accessToken = null) {
    $this->accessToken = $accessToken;
  }

  /**
   * Return access token.
   *
   * @return \Factorial\Libreja\Basic\AccessToken
   *   The access token.
   */
  public function accessToken() {
    return $this->accessToken;
  }

  public function setAccessToken(AccessToken $accessToken) {
    $this->accessToken = $accessToken;
    return $this;
  }
}
