<?php

namespace Factorial\Libreja\Http;

/**
 * GET Request.
 */
class HttpRequestGet extends HttpRequestBase {

  /**
   * Build request parameters.
   */
  public function buildRequestData() {
    $this->cleanUpParameters();
    if (!empty($this->data)) {
      $this->endpoint .= '?' . http_build_query($this->data);
    }
  }

}
