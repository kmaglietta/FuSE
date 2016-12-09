<?php
// Establishing connection to the database
// Return connection handler
class db_connect{
	private $conn;

	function connect(){
		include_once('config.php');

		$this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if(mysqli_connect_errno()) {
		    die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		// Return the connection
		return $this->conn;
	}
}
?>
