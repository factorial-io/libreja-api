<?php

namespace Factorial\Libreja\Resource\User;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media details.
 */
class MediaDetails extends HttpRequestGet {

  /**
   * {@inheritdoc}
   */
  public function __construct($mediaId) {
    parent::__construct("/media/{$mediaId}");
  }

}