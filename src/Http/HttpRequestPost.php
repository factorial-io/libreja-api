<?php

namespace Factorial\Libreja\Http;

/**
 * POST Request.
 */
class HttpRequestPost extends HttpRequestBase {

  /**
   * @inheritdoc.
   */
  protected $verb = 'POST';

  /**
   * The request body.
   *
   * @var array|string
   */
  public $body;

  /**
   * Build request body.
   */
  public function buildRequestData() {
    $this->cleanUpParameters();
    $this->body = $this->data;
  }
}
