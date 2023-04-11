<?php

namespace Factorial\Libreja\Resource\Article;

use Factorial\Libreja\Http\HttpRequestPut;

/**
 * Check if multi articles are available.
 */
class ArticleMultiAvailable extends HttpRequestPut {

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