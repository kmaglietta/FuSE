<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'kmaglietta2013';   // Needs to be changed to your designated table database name
$dbuser = 'kmaglietta2013';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'Mobster88'; // Needs to be changed to reflect your LAMP server credentials

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
// Selecting Database
$db = mysqli_select_db($conn, "kmaglietta2013");
// SQL query to fetch information of registerd users and finds user match.
$query = $conn->query("select * from login where password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>
