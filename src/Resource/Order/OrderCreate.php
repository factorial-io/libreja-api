<?php

namespace Factorial\Libreja\Resource\Order;

use Factorial\Libreja\Http\HttpRequestPost;

/**
 * Create a new project.
 */
class OrderCreate extends HttpRequestPost {

  /**
   * {@inheritdoc}
   */
  public function __construct($data) {
    parent::__construct('/order/new', $data);
  }

}
