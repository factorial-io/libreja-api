<?php

namespace Factorial\Libreja\Resource\Invoice;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get Invoices from current user.
 */
class InvoiceCurrent extends HttpRequestGet {

    /**
     * {@inheritdoc}
     */
    public function __construct() {
        parent::__construct('/invoice/user/current');
    }

}
