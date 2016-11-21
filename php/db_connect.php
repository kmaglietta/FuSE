<?php
// Establishing connection to the database
// Return connection handler
class db_connect{
	private $conn;

	function connect(){
		include_once('config.php');
		// Do not change the following two lines.
		//$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
		//$server_root = dirname($_SERVER['PHP_SELF']);

		//$dbhost = 'localhost';  // Most likely will not need to be changed
		//$dbname = 'ppakhapo';   // Needs to be changed to your designated table database name
		//$dbuser = 'ppakhapo';   // Needs to be changed to reflect your LAMP server credentials
		//$dbpass = 'htgdCTo9g6'; // Needs to be changed to reflect your LAMP server credentials

		$this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if(mysqli_connect_errno()) {
		    die("Failed to connect to MySQL: " . mysqli_connect_error());
		}

		// Return the connection
		return $this->conn;
	}
}
?>
