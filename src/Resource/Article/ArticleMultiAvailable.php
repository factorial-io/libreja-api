<?php

namespace Factorial\Libreja\Resource\Article;

use Factorial\Libreja\Http\HttpRequestPost;

/**
 * Check if multi articles are available.
 */
class ArticleMultiAvailable extends HttpRequestPost {

  /**
   * {@inheritdoc}
   */
  public function __construct($articleIds, $startDate, $endDate) {
    parent::__construct('/availability/article/multiple', [
      'medium' => $articleIds,
      'date_start' => $startDate,
      'date_end' => $endDate,
    ]);
  }

}