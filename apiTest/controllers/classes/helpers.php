
<?php

class helpers
{


	public static function validatePhone($data, $varname){
		$numbers = helpers::validateString($data, $varname);
		$numbers = preg_replace("%[^0-9]%", "", $numbers );
		$length = strlen($numbers);
		if ( $length == 10 || $length == 7 ) {
			  return $numbers;
		    }
		else{
			throw new ResponseException(200,"Please enter a valid $varname.");
		}
	}
	
	
	public static function validateInt($data, $varname){
		if ($data == "")
		{
			$data = 0;
		}
		$data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
		if ($data == "")
		{
			$data = 0;
		}
		return $data;
	}
	public static function validateValueString($data, $varname){
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		return $data;	
	}
	public static function validateString($data, $varname){
		if ($data == "")
		{
			throw new ResponseException(200,"Please enter a $varname.");
		}
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		if ($data == "")
		{
			throw new ResponseException(200, "Please enter a valid $varname.");
		}
		return $data;	
	}
	public static function validateEmail($data){
		if ($data == "")
		{
			throw new ResponseException(200,"Please enter an email.");
		}
		//$data = filter_var($data, FILTER_SANITIZE_EMAIL); //-------------------NEED TO BE FIXED
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
			throw new ResponseException(200,"[$data] is NOT a valid email address.");
		  }
		return $data;	
	}
	public static function StoreProcedure($ProcedureName){
		$servername = 'localhost';
		$dbname = 'jherna65';
		$dbuser = 'jherna65';
		$dbpass = 'Urpn+4y4NO';

		// Create connection
		$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

		if($conn->connect_error) {
		   throw new Exception ('Unable to connect to database [' . $conn->connect_error . ']');
		}

		// $call = $conn->prepare('CALL test_proc(?, ?, ?, @sum, @product, @average)');
		// $call->bind_param('iii', $procInput1, $procInput2, $procInput3);
		// $call->execute();
		// $result = $conn->query("CALL" + $ProcedureName);

		$conn->close();
		$rows = array();
		$total_records = mysqli_num_rows($result);
		if($total_records > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}
		else
		{
			//throw new ResponseException(204,'No records found');
			return $rows;
		}
	}
	public static function runQuery($sql){
		$servername = 'localhost';
		$dbname = 'jherna65';
		$dbuser = 'jherna65';
		$dbpass = 'Urpn+4y4NO';

		// Create connection
		$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

		if($conn->connect_error) {
		   throw new Exception ('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$result = $conn->query($sql);
		$conn->close();
		$rows = array();
		$total_records = mysqli_num_rows($result);
		if($total_records > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}
		else
		{
			//throw new ResponseException(204,'No records found');
			return $rows;
		}
	}
	public static function getArrayValue($array, $property)	{
		try
		{
			if (array_key_exists($property, $array)) {
				$data = strtolower($array[$property]);
				$data = filter_var($data, FILTER_SANITIZE_STRING);
				return $data;
			}
			else
			{
				return "";
			}
		}
		catch( Exception $e )
		{
			return "";
		}
	}
	public static function test()
	{
	 return "is working";	
	}
	
	
}
?>
