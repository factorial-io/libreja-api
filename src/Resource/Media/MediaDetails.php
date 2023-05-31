<?php

namespace Factorial\Libreja\Resource\Media;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media details.
 */
class MediaDetails extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct($mediaId, $date = null) {
    parent::__construct("/media/{$mediaId}" . ($date ? ('?' . $date) : '' ) );

  }

}
