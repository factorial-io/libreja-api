<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get user details.
 */
class UserDetails extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct('/order/user/current');
  }

}