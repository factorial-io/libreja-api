<?php

namespace Factorial\Libreja\Resource\Order;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get order details.
 */
class OrderCurrent extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct('/order/user/current');
  }

}
