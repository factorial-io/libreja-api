<?php

namespace Factorial\Libreja\Resource\Config;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get App Config.
 */
class AppConfig extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        parent::__construct('/config');
    }

}
