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
  public function __construct($data) {
    parent::__construct('/project/new', $data);
  }

}
