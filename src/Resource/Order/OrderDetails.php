<?php

namespace Factorial\Libreja\Resource\Order;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get project details.
 */
class OrderDetails extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($id) {
        parent::__construct("/order/{$id}");
    }

}
