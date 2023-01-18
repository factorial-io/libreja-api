<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get user details.
 */
class UserAdmin extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($libId) {
        parent::__construct("/user/$libId");
    }

}
