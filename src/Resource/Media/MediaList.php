<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media list.
 */
class MediaList extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct($libId = 0) {
    parent::__construct('/media' . ($libId ? ('/library/' . $libId) : ''));
  }

}