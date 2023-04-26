<?php

namespace Factorial\Libreja\Resource\Project;

use Factorial\Libreja\Http\HttpRequestPut;

/**
 * Update the existing project.
 */
class ProjectUpdate extends HttpRequestPut {

    /**
     * {@inheritdoc}
     */
    public function __construct($id, $data) {
        parent::__construct("/project/{$id}", $data);
    }

}
