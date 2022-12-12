<?php

namespace Factorial\Libreja\Http;

use Factorial\Libreja\Exception\IOException;

/**
 * Request that holds all the necessary information required by Libreja client.
 */
abstract class HttpRequestBase implements HttpRequestInterface {

  /**
   * The endpoint uris.
   *
   * @var string
   */
  public $endpoint;

  /**
   * The request methode.
   *
   * @var string
   */
  protected $verb = 'GET';

  /**
   * The request headers.
   *
   * @var array
   */
  public $headers;

  /**
   * The request data.
   *
   * @var array
   */
  public $data;

  /**
   * The data that irrelevant to request parameters.
   *
   * @var array
   */
  protected $nonParameters = [];

  /**
   * The data that required to request parameters.
   *
   * @var array
   */
  protected $requiredParameters = [];

  /**
   * Constructor.
   */
  public function __construct(string $endpoint, array $data = []) {
    $this->endpoint = $endpoint;
    $this->data = $data;
    $this->headers = [
      'Content-Type' => 'application/json',
    ];
    $this->buildRequestData();
  }

  /**
   * Finalize parameters.
   */
  public function finalizeParameters() {
    foreach ($this->nonParameters as $key) {
      unset($this->data[$key]);
    }
    foreach ($this->requiredParameters as $key) {
      if (empty($this->date[$key])) {
        throw new IOException('Missing parameter: ' . $key);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  abstract public function buildRequestData();

}
