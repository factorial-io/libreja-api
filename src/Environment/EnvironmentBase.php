<?php

namespace Factorial\Libreja\Environment;

/**
 * Abstract Libreja environment class.
 */
abstract class EnvironmentBase implements EnvironmentInterface {

  /**
   * Api authentification token.
   *
   * @var string
   */
  private $authentificationToken;

  /**
   * Constructor.
   *
   * @param string $authentificationToken
   *   The api authentification token.
   */
  public function __construct(string $authentificationToken = '') {
    $this->authentificationToken = $authentificationToken;
  }

  /**
   * Return authentification token.
   *
   * @return string
   *   The authentification token.
   */
  public function authentificationToken() {
    return $this->authentificationToken;
  }

  public function setAuthentificationToken(string $authentificationToken) {
    $this->authentificationToken = $authentificationToken;
    return $this;
  }
}
