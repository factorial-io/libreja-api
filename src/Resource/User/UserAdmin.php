<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get user Admin.
 */
class UserAdmin extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($libId) {
        parent::__construct("/user/$libId");
    }

}
