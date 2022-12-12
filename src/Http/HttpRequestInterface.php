<?php

namespace Factorial\Libreja\Http;

/**
 * Interface that can be implemented to build http request.
 */
interface HttpRequestInterface {

  /**
   * Build request data.
   */
  public function buildRequestData();

}
