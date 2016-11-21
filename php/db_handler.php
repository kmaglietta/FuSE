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
    mysqli_close($this->conn);
  }

  public function getRecord($query) {
    // Get one user record
    $r = $this->conn->query($query . " LIMIT 1") or die($this->conn->error . __LINE__);
    return $result = $r->fetch_assoc();
  }

  public function getSession(){

  }
  /*public function updateTokenIntoTable($table, $token, $userid){
    // This function is to update the user session token
    $query = "UPDATE " . $table . " SET token='$token' WHERE uid='$userid'";
    $r = $this->conn->query($query) or die($this->conn->error.__LINE__);
  }*/
  public function getTutoringRecords(){
    $query = "SELECT * FROM tutoringSessions AS t WHERE t.active = 1";
    $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
    $rows = array();
    $records = mysqli_num_rows($result);
    if($records > 0){
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    } else {
      return $rows;
    }
  }


}

?>
