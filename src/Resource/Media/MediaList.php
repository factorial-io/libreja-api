<?php

namespace Factorial\Libreja\Resource\Media;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media list.
 */
class MediaList extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct($libId = 0, $filter = '') {
    parent::__construct('/media/list' . ($libId ? ('/library/' . $libId) : '') . ($filter ? ('?' . $filter) : '' ) );
  }

}
