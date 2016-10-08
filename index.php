<?php
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

    $dbhost = 'localhost';
    $dbname = 'kmaglietta2013';
    $dbuser = 'kmaglietta2013';
    $dbpass = 'PqEhBu57jb';

    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error .    ']');
    }
?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Hello</h1>
    </body>
</html>