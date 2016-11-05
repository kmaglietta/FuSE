<?php

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'kmaglietta2013';   // Needs to be changed to your designated table database name
$dbuser = 'kmaglietta2013';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'PqEhBu57jb'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$select = "SELECT * FROM USERS";



?>
