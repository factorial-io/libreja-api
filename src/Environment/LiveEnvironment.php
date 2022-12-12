<?php

namespace Factorial\Libreja\Environment;

/**
 * The live environment.
 */
class LiveEnvironment extends EnvironmentBase {

  /**
   * {@inheritdoc}
   */
  public function baseUrl() {
    return getenv('LIBEREJA_API_BASE_URL') . '/api';
  }

}