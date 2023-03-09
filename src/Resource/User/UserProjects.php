<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get user details.
 */
class UserProjects extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct('/project/user/current');
  }

}
