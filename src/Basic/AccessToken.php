<?php

namespace Factorial\Libreja\Basic;

/**
 * The access token.
 */
class AccessToken {

  /**
   * The access token.
   *
   * @var string
   */
  public $token;

  /**
   * The access token expired in.
   *
   * @var int
   */
  public $expiresIn;

  /**
   * The access token creating time.
   *
   * @var int
   */
  private $createdTime;

  /**
   * Constructor.
   */
  public function __construct($token, $createdTime = 0, $expiresIn = 86400) {
    $this->token = $token;
    $this->expiresIn = $expiresIn;
    $this->createdTime = $createdTime ? $createdTime : time();
  }

  /**
   * Check if token expired.
   */
  public function isExpired() {
    return time() >= $this->createdTime + $this->expiresIn;
  }

  /**
   * Get created time.
   */
  public function getCreated() {
    return $this->createdTime;
  }

}
