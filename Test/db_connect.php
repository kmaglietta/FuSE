<?php


    $dbhost = 'localhost';
    $dbuser = 'kmaglietta2013';
    $dbname = 'kmaglietta2013';
    $dbpass = 'PqEhBu57jb';

    $db = new mysquli($dbhost, $dbuser, $dbpass, $dbname);

    if($db->connect_errno > 0) {
        die('Unable to conect' . $db->connect_error);
    }
?>
