<?php

namespace Factorial\Libreja\Resource\Project;

use Factorial\Libreja\Http\HttpRequestPut;

/**
 * Create a new project.
 */
class ProjectCreate extends HttpRequestPut {

  /**
   * {@inheritdoc}
   */
  public function __construct($libId, $customer, $name, $externalProjectNr, $startDate, $endDate, $format="") {
    parent::__construct('/project/new', [
      'library' => $libId,
      'customer' => $customer,
      'name' => $name,
      'nr' => $externalProjectNr,
      'begin' => $startDate,
      'end' => $endDate,
      'format' => $format
    ]);
  }

}
