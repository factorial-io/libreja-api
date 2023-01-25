<?php

namespace Factorial\Libreja\Resource\Media;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media image.
 */
class MediaImage extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct($mediaId) {
    parent::__construct("/media/{$mediaId}/image/");
  }

}
