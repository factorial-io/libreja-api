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
  public function __construct($token, $expiresIn = 86400) {
    $this->token = $token;
    $this->expiresIn = $expiresIn;
    $this->createdTime = time();
  }

  /**
   * Check if token expired.
   */
  public function isExpired() {
    return time() >= $this->createTime + $this->expiresIn;
  }

}
