<?php

namespace Factorial\Libreja\Resource\Invoice;

use Factorial\Libreja\Http\HttpRequestGet;

/**
 * Get PDF of an invoice.
 */
class InvoicePDF extends HttpRequestGet {

  public $rawResponse = true;

  /**
   * {@inheritdoc}
   */
  public function __construct($id) {
    $this->endpoint = "/pdf/{$id}";
    $this->data = [];
    $this->headers = [
      'Content-Type' => 'application/pdf',
    ];
    $this->buildRequestData();
  }

}
