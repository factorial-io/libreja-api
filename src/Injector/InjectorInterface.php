<?php

namespace Factorial\Libreja\Injector;

use Factorial\Libreja\Http\HttpRequestInterface;

/**
 * Interface that can be implemented to apply injectors to Http client.
 */
interface InjectorInterface {

  /**
   * Inject http request.
   */
  public function inject(HttpRequestInterface &$request);

}