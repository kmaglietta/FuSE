<?php

require_once 'db_handler.php';
require_once 'hashing.php';
require_once 'rest.php';

/**
 * Handling Api Call
 */
class apiHandler
{
  private $db;
  private $api;

  function __construct() {
    $api = new rest();
    $db = new db_handler();
  }

  public function startApiCaller() {
    $error = array();  // array to hold validation errors
    $data = array();        // array to pass back data
    $contentType = 'application/json';
    $inputJson = file_get_contents('php://input');
    $method = $_SERVER['REQUEST_METHOD'];
    $params = $_REQUEST;

    $action = this->missinParams($params, 'action');
    if ($action == '') {
      # code...
    } else {
      // Action is undefined
      $error['status'] = 404;
      $error['message'] = $api->getHttpStatusMessage($error['status']);
    }
  }

  function decodeJson($inputData) {
    $r = array();
    $r = $inputData;
    $jsonResponse = json_decode($r, true); // return associative array

    return $jsonResponse;
  }

  function encodeJson($responseData) {
    $jsonResponse = json_encode($responseData, JSON_PRETTY_PRINT);
    return $jsonResponse;
  }

  function missinParams($array, $property)
  {
    if (array_key_exists($property, $array)) {
      return strtolower($array[$property]);
    } else {
      return $error = -1;
    }
  }
}

$execute = new apiHandler();
$execute->startApiCaller();

?>
