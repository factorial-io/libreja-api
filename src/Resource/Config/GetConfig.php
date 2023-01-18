<?php

namespace Factorial\Libreja\Resource\Config;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get Config.
 */
class GetConfig extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        parent::__construct('/config');
    }

}
