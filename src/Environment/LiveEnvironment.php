<?php

namespace Factorial\Libreja\Environment;

/**
 * The test environment.
 */
class LiveEnvironment extends EnvironmentBase {

  /**
   * {@inheritdoc}
   */
  public function baseUrl() {
    return 'https://fta-release.libreja.com/api';
  }

}