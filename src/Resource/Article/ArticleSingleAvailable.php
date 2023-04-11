<?php

namespace Factorial\Libreja\Resource\Article;

use Factorial\Libreja\Http\HttpRequestPost;

/**
 * Check if the article is available.
 */
class ArticleSingleAvailable extends HttpRequestPost {

  /**
   * {@inheritdoc}
   */
  public function __construct($articleId, $startDate, $endDate) {
    parent::__construct("/availability/article/{$articleId}", [
      'date_start' => $startDate,
      'date_end' => $endDate,
    ]);
  }

}