<?php

namespace Factorial\Libreja\Resource\Project;

use Factorial\Libreja\Http\HttpRequestPost;

/**
 * Create a new project.
 */
class ProjectCreate extends HttpRequestPost {

  /**
   * {@inheritdoc}
   */
  public function __construct($data) {
    parent::__construct('/project/new', $data);
  }

}
