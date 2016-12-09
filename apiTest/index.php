<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//prevent warnings
error_reporting(E_ERROR);
function exception_handler($ex) {
	header("HTTP/1.1". " ". 418 ." ". "Error");
	header("Content-Type:". "application/json");
	$error = array();
	$error['errorMessage'] = $ex->getMessage();
	$error['line'] = $ex->getLine();
	echo json_encode($error, JSON_PRETTY_PRINT);
}
set_exception_handler('exception_handler');


require_once("customExceptions.php");
require_once("restAPI.php");



class api extends restAPI {

	public function executeApi()
	{
		$debug_isEnable = true;

		try
		{

			// Define path to data folder
			define('DATA_PATH', realpath(dirname(__FILE__).'/data'));

			//get the request mothod and allow only POST
			$method = $_SERVER['REQUEST_METHOD'];
			if ($method != 'POST')
			{
				throw new ResponseException(400,'Request method not valid');
			}

			//get all of the parameters in the POST/GET request
			$params = $_REQUEST;

			$body  = file_get_contents('php://input');//-----------------------------------

			//get the controller and format it correctly so the first letter is always capitalized
			//$controller = ucfirst(strtolower($params['controller']));
			$controller = 'post';


			//get the action and format it correctly so all the letters are not capitalized, and append 'Action'
			//$action = strtolower($params['action']).'Action';
			$action = ($this->missingAction($params,'action')).'Action';

			//check if the controller exists. if not, throw an exception
			if( file_exists("controllers/{$controller}.php") )
			{
				include_once "controllers/{$controller}.php";
			} else
			{
				throw new ResponseException(404,'Controller is invalid.');
			}

			//create a new instance of the controller, and pass it the parameters from the request
			$controller = new $controller($params);

			//check if the action exists in the controller. if not, throw an exception.
			if( method_exists($controller, $action) === false ) {
				throw new ResponseException(404,'Action is invalid.');
			}


//$this ->setHttpHeaders('application/json', 200);
//echo json_encode($params, JSON_PRETTY_PRINT);
//echo $this->getArrayValue($params,'jtStartIndex');
//exit();

			$jsonObj[]= json_decode($body);
			$obj = array();
			if($jsonObj) {
			  foreach($jsonObj as $param_name => $param_value) {
				$obj[$param_name] = $param_value;
				//$obj ->$param_name = $param_value;
			  }
			}
			if ($debug_isEnable == true)
			{
				$result['objparams'] = $params;
				$result['objPosted'] = $obj;
			}
			
			//move array elements one level up 
			$obj = array_shift($obj);

//throw new ResponseException(200,$this->encodeJson($params));
//$params = $this->encodeJson($params);
			//execute the action
			$rows = $controller->$action($obj,$params);
			//$result['data'] = $controller->$action($obj);
			
			if($rows['Options'])
			{
				$result['Options'] = $rows['Options'];
			}
			if($rows['data'])
			{
				$result['data'] = $rows['data'];
			}
			if($rows['Records'])
			{
				$result['Records'] = $rows['Records'];
			}
			if($rows['Record'])
			{
				$result['Record'] = $rows['Record'];
			}
			// used for additional data to be return from api
			$attributes = $rows['attributes'];
			$attributes = array_shift($attributes);
			if($attributes) {
			  foreach($attributes as $param_name => $param_value) {
				$result[$param_name] = $param_value;
			  }
			}
			//$result['TotalRecordCount'] = $rows['attributes'];

//throw new ResponseException(500, "[$result]");

			$result['success'] = true;

			$response = $result;
			$statusCode = 200;
			$result['Result'] = "OK";
		}
		catch( Exception $e )
		{
			$result['success'] = false;

			//catch custom exceptions and report the problem
			$error = array();
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

			$result['Message'] = $e->getMessage();
			$result['Error'] = $error;
			$result['Result'] = "ERROR";
		}
		
		
		$result['debugging'] = $debug_isEnable;
		$response = $this->encodeJson($result);
		$requestContentType = 'application/json';
		$this ->setHttpHeaders($requestContentType, $statusCode);
		echo $response;
		exit();
	}

	private function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData, JSON_PRETTY_PRINT);
		return $jsonResponse;
	}
	private function isDefined($array, $property)	{
		if (array_key_exists($property, $array)) {
			return strtolower($array[$property]);
		}
		else
		{
			throw new ResponseException(417,'Property does not exist in array');
		}
	}
	private function missingAction($array, $property)	{
		if (array_key_exists($property, $array)) {
			return strtolower($array[$property]);
		}
		else
		{
			throw new ResponseException(400,'Missing action');
		}
	}
}


$RunAPI = new api();
$RunAPI->executeApi();


?>
