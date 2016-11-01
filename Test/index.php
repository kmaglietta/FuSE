<?php
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

// You will need to require this file on EVERY php file that uses the database.
// Be sure to use $db->close(); at the end of each php file that includes this!

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'kmaglietta2013';   // Needs to be changed to your designated table database name
$dbuser = 'kmaglietta';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'test'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$results = $db->query("SELECT * FROM `users`");
if($results){
  $temp = $results->fetch_assoc();
  var_dump($temp['username']);
  echo $temp['username'];
}

?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Hello</h1>
    </body>
</html>
