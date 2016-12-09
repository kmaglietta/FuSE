<?php
/**
 * Database configuration
 */
//define('DB_USERNAME', 'ppakhapo');
//define('DB_PASSWORD', 'SaQ95TBEP3');
//define('DB_HOST', 'localhost');
//define('DB_NAME', 'ppakhapo');

/**
 * Database configuration for localhost
 */
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', '');
 define('DB_HOST', 'localhost');
 define('DB_NAME', 'my_db');

// Define path to data folder
define('DATA_PATH', realpath(dirname(__FILE__).'/data'));

// Secret key for JWT
define('SECRET_KEY', 'RTXEDIV7N778JSZT4C5591GN0FHUTS7T');
// Algorithm used to sign the token
define('ALGORITHM', 'HS512');

/*// Create a database if not exist
$sql = 'CREATE DATABASE IF NOT EXISTS my_db';
$db->query($sql);
if(!$sql) {
  die('Cannot create a database [' . $db->error . ']');
}*/

?>
