<?php
    //test for tables
    $check_db = "SELECT * FROM STUD";
    $result = $db->query($check_db);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            echo($row['STUD_ID']);
        }
    }
    if(!$db->query($check_db)){
        $create_stud = "CREATE TABLE STUD (
            STUD_ID VARCHAR(15) NOT NULL,
            STUD_USERNAME VARCHAR(15) NOT NULL,
            STUD_NAME_FIRST VARCHAR(15) NOT NULL,
            STUD_NAME_LAST VARCHAR(15) NOT NULL,
            PRIMARY KEY (STUD_ID)
        )";

        if($db->query($create_stud)){
            echo "Users created";
        } else {
            echo "Users failled";
        }
    }

    $db->query("INSERT INTO STUD VALUES ('12' ,'testn' , 'Test', 'Name')");

    function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }
?>
