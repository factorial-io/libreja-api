<?php

namespace Factorial\Libreja\Connection;

use Factorial\Libreja\Http\HttpRequestPost;
use Factorial\Libreja\Environment\EnvironmentInterface;

/**
 * The authentification request
 */
class AuthenticationRequest extends HttpRequestPost {

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'nick',
    'password',
  ];

  /**
   * {@inheritdoc}
   */
  public function __construct(EnvironmentInterface $environment, array $data) {
    parent::__construct('/token/login');
    $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
  }
}