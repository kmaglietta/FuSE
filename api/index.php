<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//prevent warnings
error_reporting(E_ERROR);

require_once("customExceptions.php");
require_once("restAPI.php");



class api extends restAPI {
	public function executeApi() 
	{	
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
	
			//execute the action
			$result['data'] = $controller->$action();
			$result['success'] = true;
	
			$response = $result;
			$statusCode = 200;
		} 
		catch( Exception $e ) 
		{
			$result['success'] = false;
			
			//catch custom exceptions and report the problem
			$error = array();
			if (is_a($e, 'ResponseException')) {
				$statusCode = $e->getStatusCode();
				$error['exceptionType'] = 'ResponseException';
			}
			else
			{
				$statusCode = 500;
				$error['exceptionType'] = 'Exception';
			}
			$error['httpStatusCode'] = $statusCode;
			$error['httpStatusMessage'] = $this->getHttpStatusMessage($statusCode);
			$error['errorMessage'] = $e->getMessage();
			$error['line'] = $e->getLine();
			
			$result['error'] = $error;
		}

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
	
	private function isDefined($array, $property)
	{
		if (array_key_exists($property, $array)) {
			return strtolower($array[$property]);
		}
		else
		{
			throw new ResponseException(417,'Property does not exist in array'); 	
		}
	}
	private function missingAction($array, $property)
	{
		if (array_key_exists($property, $array)) {
			return strtolower($array[$property]);
		}
		else
		{
			throw new ResponseException(400,'Missing action'); 	
		}
	}	
	
}


$test = new api();
$test->executeApi();
?>