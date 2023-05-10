<?php

namespace Factorial\Libreja\Resource\Invoice;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get PDF of an invoice.
 */
class InvoicePDF extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct($id) {
        parent::__construct("/pdf/{$id}");
    }

}
