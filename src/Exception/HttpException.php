<?php

namespace Factorial\Libreja\Exception;

/**
 * Custom http exception.
 */
class HttpException extends \Exception {

  /**
   * Status code.
   *
   * @var int
   */
  public $statusCode;

  /**
   * Headers.
   *
   * @var array
   */
  public $headers;

  /**
   * Constructor.
   */
  public function __construct(string $message, int $status_code, array $headers) {
    parent::__construct($message);
    $this->statusCode = $status_code;
    $this->headers = $headers;
  }

}
