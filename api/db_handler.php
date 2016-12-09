<?php

class db_handler{
  private $conn;

  function __construct(){
    // Connect to the database via default constructor
    require_once 'db_connect.php';
    $db = new db_connect();
    $this->conn = $db->connect();
  }
  function __destruct(){
    // Default Destructor
    mysqli_close($this->conn);
  }

  public function postMessage() {

  }

  public function getInstructorId($id) {
    // Get instructor's id
    $query = "SELECT t.TutorId FROM proTutor t
    INNER JOIN proStudent s ON s.StudentId LIKE t.StudentId
    WHERE t.StudentId LIKE " . $id;

    $result = $this->conn->query($query) or die($this->conn->error . __LINE__);

    if ($result->num_rows > 0) {
      $r = array();
      return $r = $result->fetch_assoc();
    }
    else {
      return $error = array(
        'code' => 401,
        'type' => 'No such user found'
      );
    }
  }

}

?>
