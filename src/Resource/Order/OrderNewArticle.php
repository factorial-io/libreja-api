<?php

namespace Factorial\Libreja\Resource\Order;

use Factorial\Libreja\Http\HttpRequestPost;

/**
 * Add a new article to an order.
 */
class OrderNewArticle extends HttpRequestPost {

    /**
     * {@inheritdoc}
     */
    public function __construct($order_id, $media_id) {
        parent::__construct("/order/{$order_id}/add/{$media_id}");
    }

}
