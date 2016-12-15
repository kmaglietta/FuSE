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

  $action = missinParams($params, 'action');
  if($action === 'getusers'){
    $data['response'] = $db->getTutoringRecords();

  } elseif ($action === 'login') {
    // Get JSON read-only stream
    if (isset($_SESSION)) {
      session_destroy();
    }
    $r = array();
    $r = file_get_contents('php://input');
    $request = json_decode($r, true);
    $username = $request['username'];
    $password = $request['password'];
    // Match provided username and password
    $data['response'] = $db->getUserRecords($username, $password);
    if (!isset($data['response']['id'])) {
      // If failed
      $error['status'] = $data['response']['code'];
      $error['message'] = $api->getHttpStatusMessage($error['status']);
    } else {
      if (!isset($_SESSION)) {
        session_start();
        $_SESSION['id'] = $data['response']['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data['response']['role'];
      }
    }

  } elseif ($action === 'logout') {
    $status = $db->destroySession();
    if ($status === 'fail') {
      $error['status'] = 400;
      $error['message'] = $api->getHttpStatusMessage($error['status']);
    }

  } elseif ($action === 'getsession') {
    // Get user's session
    //$request = file_get_contents('php://input');
    //$request = json_decode($request);
    $data['response'] = $db->getSession();

  } elseif ($action === 'getrole') {
    // Get the role of a user
    $r = array();
    $r = file_get_contents('php://input');
    $request = json_decode($r, true);
    $id = $request['id'];
    $data['response'] = $db->getUserRole($id);

  } elseif ($action === 'getprofile') {
    // Fetch user's profile based on user's id
    $id = missinParams($params, 'id');
    /*$r = array();
    $r = file_get_contents('php://input');
    $request = json_decode($r, true);
    $id = $request['id'];*/
    $data['response'] = $db->getUserProfile($id);

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
  flush();
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


executeApi();

?>
