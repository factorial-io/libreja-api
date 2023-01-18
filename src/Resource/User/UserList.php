<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get all users in a list.
 */
class UserList extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        parent::__construct('/user/');
    }

}
