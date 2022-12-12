<?php

namespace Factorial\Libreja\Environment;

/**
 * The test environment.
 */
class TestEnvironment extends EnvironmentBase {

  /**
   * {@inheritdoc}
   */
  public function baseUrl() {
    return 'https://alpha.libreja.de/api';
  }

}