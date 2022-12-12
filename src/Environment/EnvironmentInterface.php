<?php

namespace Factorial\Libreja\Environment;

/**
 * Libreja environment interface.
 */
interface EnvironmentInterface {

  /**
   * API base url.
   *
   * @return string
   *   The API base url.
   */
  public function baseUrl();

}