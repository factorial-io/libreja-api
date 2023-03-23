<?php

namespace Factorial\Libreja\Resource\Project;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get project details.
 */
class ProjectDetails extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($id) {
        parent::__construct("/project/{$id}");
    }

}
