<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'kmaglietta2013';   // Needs to be changed to your designated table database name
$dbuser = 'kmaglietta2013';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'Mobster88'; // Needs to be changed to reflect your LAMP server credentials

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// Selecting Database
$db = mysqli_select_db($conn, "kmaglietta2013");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$query = $conn->query("select username from login  where username='$user_check'");
$rows = mysqli_num_rows($query);

$login_session = $rows['username'];
// if(!isset($login_session)){
// mysqli_close($conn); // Closing Connection
// header('Location: index.php'); // Redirecting To Home Page
// }
?>
