<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get user details.
 */
class UserListLibrary extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($libId) {
        parent::__construct("/user/library/$libId");
    }

}
