<?php

require_once 'db_handler.php';
require_once 'hashing.php';

require '.././Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;
// Status code - Global Variable
$httpStatusCode = NULL;

$app->post('/login', function() use ($app){
  // Sign user in
  $app->response()->header("Content-Type", "application/json");
  $r = json_decode($app->request->getBody());
  verifyRequiredParams(array('username', 'password'),$r->userData);
  $response = array();
  $db = new db_handler();
  $user = $r->userData->username;
  $pass = $r->userData->password;
  $sql = "SELECT userid, username, password FROM users WHERE username='$user'";
  $result = $db->getRecord($sql);
  if($result != NULL){
    $httpStatusCode = 200;
    if(hashing::check_password($result['password'], $pass)){
      // Username and password are correct
      $response['status'] = "success";
      $response['statusMessage'] = getHttpStatusMessage($httpStatusCode);
      $response['message'] = "Login successful.";
      $response['uid'] = $result['uid'];
      $response['username'] = $user;
      $response['role'] = $result['role'];
      $response['authenticated'] = true;
      if(!isset($_SESSION)) session_start();
      $_SESSION['uid'] = $result['uid'];
      $_SESSION['username'] = $user;
      $_SESSION['role'] = $result['role'];

    } else {
      // Only username is correct
      $response['status'] = "error";
      $response['message'] = 'Login unsuccessful. Incorrect username and/or password';
    }
  } else {
    $response['status'] = "error";
    $response['message'] = 'No such user is registered.';
  }
  outputResponse($httpStatusCode, $response);

});

$app->get('/logout', function(){
  $db = new db_handler();
  $session = $db->destroySession();
  $httpStatusCode = 200;
  $response["status"] = "info";
  $response["message"] = "Logged out successfully";
  echoResponse($httpStatusCode, $response);
});


/*
 * Private Function
*/
function verifyRequiredParams($required_fields,$request_params){
  // Verify that required fields are populated
  $error = false;
  $error_fields = "";
  foreach ($required_fields as $field) {
    if (!isset($request_params->$field) || strlen(trim($request_params->$field)) <= 0) {
      $error = true;
      $error_fields .= $field . ', ';
    }
  }

  if ($error) {
    // Required field(s) are missing or empty
    // echo error json and stop the app
    $response = array();
    $app = \Slim\Slim::getInstance();
    $response["status"] = "error";
    $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
    outputResponse(200, $response);
    $app->stop();
  }
}

function outputResponse($status_code, $response) {
  // Return server response code
  $app = \Slim\Slim::getInstance();
  // HTTP response code
  $app->status($status_code);
  // setting response content type to json
  $app->contentType('application/json');
  echo json_encode($response, JSON_PRETTY_PRINT);
}


$app->run();
?>
