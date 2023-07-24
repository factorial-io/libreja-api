<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get all users in a list.
 */
class UserOffers extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        parent::__construct('/proposal/user/current');
    }

}
