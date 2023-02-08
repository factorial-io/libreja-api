<?php

namespace Factorial\Libreja\Resource\Article;

use Factorial\Libreja\Http\HttpRequestPut;

/**
 * Check if the article is available.
 */
class ArticleSingleAvailable extends HttpRequestPut {

  /**
   * {@inheritdoc}
   */
  public function __construct($articleId, $startDate, $endDate) {
    parent::__construct("/availability/article/{$articleId}", [
      'date_start' => $startDate,
      'date_end' => $endDate,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function buildRequestData() {
    parent::buildRequestData();
    $this->body = json_encode($this->data);
  }
}