<?php

namespace Factorial\Libreja\Connection;

/**
 * Curl wrapper used by Libreja client to make http request.
 */
class Curl {

  /**
   * Hold the class instance.
   *
   * @var null|Curl
   */
  private static $instance = NULL;

  /**
   * The curl resource.
   *
   * @var false|resource
   */
  private $curl;

  /**
   * Gets the instance via initialization.
   */
  public static function getInstance() {
    if (self::$instance === NULL) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /**
   * Constructor.
   */
  private function __construct() {
    $this->curl = curl_init();
  }

  /**
   * Prevent the instance from being cloned (which would create a second instance of it).
   */
  private function __clone() {}

  /**
   * Prevent from being unserialized (which would create a second instance of it).
   */
  public function __wakeup() {}

  /**
   * Set curl opt value.
   *
   * @param string $option
   *   Opt key.
   * @param string $value
   *   Opt value.
   *
   * @return Curl
   *   Current curl.
   */
  public function setOpt(string $option, string $value) {
    curl_setopt($this->curl, $option, $value);
    return $this;
  }

  /**
   * Close current curl.
   *
   * @return Curl
   *   Current curl.
   */
  public function close() {
    curl_close($this->curl);
    return $this;
  }

  /**
   * Execute curl.
   *
   * @return bool
   *   The curl success or failed.
   */
  public function exec() {
    return curl_exec($this->curl);
  }

  /**
   * Curl error no.
   *
   * @return int
   *   Curl error no.
   */
  public function errNo() {
    return curl_errno($this->curl);
  }

  /**
   * Get curl option info.
   *
   * @param string $option
   *   Option key.
   *
   * @return mixed
   *   Option info.
   */
  public function getInfo(string $option) {
    return curl_getinfo($this->curl, $option);
  }

  /**
   * Get curl error.
   *
   * @return string
   *   Curl error.
   */
  public function error() {
    return curl_error($this->curl);
  }

}
