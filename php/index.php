<?php

require_once 'db_handler.php';
require_once 'hashing.php';
require_once 'rest.php';

class apiCall {
  private $error = array();
  private $data = array();

  function __construct(){
    $api = new rest();
    $db = new db_handler();
  }
}


function executeApi () {

  $api = new rest();
  $db = new db_handler();

  $error = array();  // array to hold validation errors
  $data = array();        // array to pass back data
  $jsonContentType = 'application/json';
  $method = $_SERVER['REQUEST_METHOD'];
  $params = $_REQUEST;

  $action = missingAction($params, 'action');
  if($action === 'getusers'){
    $data['response'] = $db->getTutoringRecords();
  } elseif ($action === 400) {
    // Action is empty
    $error['status'] = $action;
    $error['message'] = $api->getHttpStatusMessage($action);
  } else {
    // Action is undefined
    $error['status'] = 404;
    $error['message'] = $api->getHttpStatusMessage($error['status']);
  }

  if (!empty($error)) {
    // if there are items in errors array, return those errors
    $data['status'] = $error['status'];
    $data['success'] = false;
    $data['message']  = $error['message'];
  } else {

    // if there are no errors, return a message
    $data['status'] = 200;
    $data['success'] = true;
    $data['message'] = 'Success!';
  }

  $response = encodeJson($data);
  echo $response;
}

function encodeJson($responseData) {
  $jsonResponse = json_encode($responseData, JSON_PRETTY_PRINT);
  return $jsonResponse;
}

function missingAction($array, $property)
{
  if (array_key_exists($property, $array)) {
    return strtolower($array[$property]);
  } else {
    return $error = 400;
  }
}

executeApi();

?>
