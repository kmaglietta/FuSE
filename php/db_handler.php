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

  public function getSession(){
    // User session
    if (!isset($_SESSION)) session_start();
    $s = array();
    if (isset($_SESSION['id'])) {
      $s['id'] = $_SESSION['id'];
      $s['username'] = $_SESSION['username'];
      $s['role'] = $_SESSION['role'];
    } else {
      $s['id'] = '';
      $s['username'] = 'guest';
      $s['role'] = 'guest';
    }
    return $s;
  }
  public function destroySession(){
    // Destroy user session
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['id'])) {
      unset($_SESSION['id']);
      unset($_SESSION['username']);
      unset($_SESSION['role']);
      $info = 'info';
      if (isset($_COOKIE['info'])) {
        // Destroy session cookie
        setcookie($info, '', time() - $cookie_time);
      }
      session_destroy();
      $status = 'success';
    } else {
      $status = 'fail';
    }
    return $status;
  }
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
  public function getUserRecords($user, $password){
    // Fetch user record if exists
    $query = "SELECT u.id, u.username, u.role FROM users AS u
    WHERE u.username LIKE '" . $user
    . "' AND u.password LIKE '" . $password . "' LIMIT 1;";
    $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
    $row = array();
    $records = mysqli_num_rows($result);
    if($records > 0){
      return $row = $result->fetch_assoc();
    } else {
      return $error = array(
        'code' => 401,
        'type' => 'No such user found'
      );
    }
  }
  public function getUserRole($id) {
    // Fetch user's role based on their id
    $id = (int)$id;
    $query = "SELECT u.role FROM users u WHERE u.id LIKE '" . $id . "' LIMIT 1;";
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
  public function getUserProfile($id) {
    // Fetch user's profile based on their id
    $id = (int)$id;
    $query = "SELECT ts.name, ts.coursename, td.rating FROM tutoringsessions ts
    INNER JOIN tutordata td ON td.sessionId LIKE ts.sessionId
    WHERE ts.active NOT LIKE 0
    AND ts.profileId LIKE " . $id . ";";
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
