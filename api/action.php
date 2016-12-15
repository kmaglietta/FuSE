<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


require_once 'db_handler.php';
require_once 'rest.php';
require_once 'customExceptions.php';

/**
 * Handling Api Call
 */
class apiHandler extends rest
{

  public function startApiCaller() {
    $caller = new db_handler();
    $error = array();  // array to hold validation errors
    $data = array();        // array to pass back data
    $inputJson = file_get_contents('php://input');
    $method = $_SERVER['REQUEST_METHOD'];
    $params = $_REQUEST;

    try
    {
      $action = $this->missinParams($params, 'action');
      if(isset($action) && $method!='GET') $requestData = $this->decodeJson($inputJson);

      if ($action == 'login') {
        if (isset($_SESSION)) session_destroy();
        $data['response'] = $caller->getUserLogin($requestData);
      }
      elseif ($action == 'getdashboardprofile') {
        $data['response'] = $caller->getDashboardProfile($requestData);
      }
      elseif ($action == 'getmysessions') {
        $data['response'] = $caller->getMySessions($requestData);
      }
      elseif ($action == 'getsessiondropdown') {
        $data['response'] = $caller->getMySessionsDropdown($requestData);
      }
      elseif ($action == 'getstudentmysessions') {
        $data['response'] = $caller->getStudentMySession();
      }
      elseif ($action == 'addstudentmysession') {
        $data['response'] = $caller->addStudentMySession($requestData);
      }
      elseif ($action == 'viewattendedsessions') {
        $data['response'] = $caller->viewAttendedSessions($requestData);
      }
      elseif ($action == 'ratemytutor') {
        $data['response'] = $caller->rateTutor($requestData);
      }
      else {
        // Action is undefined
        throw new ResponseException(404,'Action is not defined');
      }
      $data['Success'] = true;
      $statusCode = 200;
      $data['Result'] = 'OK';
    }
    catch (Exception $e)
    {
      $data['Success'] = false;

      if (is_a($e, 'ValidationError')) {
				$statusCode = 200;
				$error['exceptionType'] = 'ValidationError';
			}
			elseif (is_a($e, 'ResponseException')) {
				$statusCode = $e->getStatusCode();
				$error['exceptionType'] = 'ResponseException';
				$error['httpStatusCode'] = $statusCode;
				$error['httpStatusMessage'] = $this->getHttpStatusMessage($statusCode);
			}
			else
			{
				$statusCode = 500;
				$error['exceptionType'] = 'Exception';
				$error['httpStatusCode'] = $statusCode;
				$error['httpStatusMessage'] = $this->getHttpStatusMessage($statusCode);
			}
      $error['Message'] = $e->getMessage();

			$error['errorMessage'] = $e->getMessage();
			$error['line'] = $e->getLine();

			$data['Message'] = $e->getMessage();
			$data['Error'] = $error;
			$data['Result'] = "ERROR";
      //$data['status'] = $statusCode;
    }
    $data['status'] = $statusCode;
    $response = $this->encodeJson($data);
    echo $response;
    flush();
  }

  private function decodeJson($inputData) {
    $r = array();
    $r = $inputData;
    $jsonResponse = json_decode($r, true); // return associative array
    return $jsonResponse;
  }

  private function encodeJson($responseData) {
    $jsonResponse = json_encode($responseData, JSON_PRETTY_PRINT);
    return $jsonResponse;
  }

  private function missinParams($array, $property)
  {
    if (array_key_exists($property, $array)) {
      return strtolower($array[$property]);
    } else {
      throw new ResponseException(400,'Missing action');
    }
  }
}

$execute = new apiHandler();
$execute->startApiCaller();

?>
