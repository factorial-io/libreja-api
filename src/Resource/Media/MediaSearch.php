<?php

namespace Factorial\Libreja\Resource\Media;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get media list.
 */
class MediaSearch extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($filter = '') {
        parent::__construct('/search/list' . ($filter ? ('?' . $filter) : '' ) );
    }

}
