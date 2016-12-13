<?php

class db_handler
{
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

  public function postMessage($data) {
    // Semd a message to an admin user
    $senderId = $data['sender'];
    $recipientId = $data['recipient'];
    $subject = $data['subject'];
    $body = $data['body'];

    if($senderId == $recipientId) {
      throw new ResponseException(200,'Cannot send message to yourself');
    }

    $query = "SELECT * FROM proAdministrator pa WHERE 1=1 AND pa.AdminId LIKE "
    .$recipientId.";";
    $r = $this->runQuery($query);
    if (!empty($r['error'])) {
      throw new ResponseException(200,'Recipient does not exist');
    }

    $query = "INSERT INTO proMessages
    (MessageId, TimeStamp, StudentId, RecipientId, Subject, Body)
    VALUES (NULL, CURRENT_TIMESTAMP, ".$senderId.", ".$recipientId.", '".$subject."', '".$body."');";

    return $r = $this->runQuery($query);
  }

  public function getMessages($data) {
    // This function get all messages from the recipient end
    $recipientId = $data['recipient'];

    $query = "SELECT m.messageId, m.StudentId, m.Subject, m.Body FROM proMessages m
    WHERE 1=1 AND m.recipientId LIKE " . $recipientId . ";";

    return $r = $this->runQuery($query);
  }

  public function getUserMessages($senderId) {
    // This function get all messages that the sender has sent
    $query = "SELECT m.messageId, m.recipientId, m.Subject, m.Body FROM proMessages m
    where 1=1 AND m.StudentId LIKE " . $senderId . ";";

    return $r = $this->runQuery($query);
  }

  public function getInstructorId($id) {
    // Get instructor's id
    $query = "SELECT t.TutorId FROM proTutor t
    INNER JOIN proStudent s ON s.StudentId LIKE t.StudentId
    WHERE t.StudentId LIKE " . $id;

    return $r = $this->runQuery($query);
  }

  public function getUserLogin($data) {
    // Post user credential and establish user's session
    $email = $data['email'];
    $password = $data['password'];
    $isAdmin = $data['isAdmin'];

    if($isAdmin == true) {
      $query = "SELECT pa.AdminId id,
      null tutorid, UUID() guiid, 1 isAdmin
      FROM proAdministrator pa WHERE pa.EmailAddress LIKE '".$email.
      "' AND pa.Password LIKE '".$password."' LIMIT 1;";
    } else {
      $query = "SELECT s.StudentId id, t.TutorId, UUID() guiid,
      CASE WHEN t.TutorId IS null THEN 0 else 1 END isTutor, 1 isStudent
      FROM proStudent s LEFT JOIN proTutor t ON s.StudentId = t.StudentId
      WHERE s.EmailAddress LIKE '".$email.
      "' AND s.Password LIKE '".$password."' LIMIT 1;";
    }

    $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
    if ($result->num_rows > 0) {
      $r = array();
      return $r = $result->fetch_assoc();
    } else return;
  }

  public function viewAttendedSessions($data){
    // Get the list of all classes that a student has attended
    $studentId = $data['id'];

    $query = "SELECT tss.tssId, tss.SessionId sessionid,
    tss.StudentRating rating,
    concat(c.Subject , ' ' , c.CourseNumber) as class,
    c.coursename coursename,
    CASE
      WHEN tss.StudentRating LIKE 0 THEN 'Not Yet Rated'
    ELSE 'Rated' END ratingStatus,
    s.EmailAddress email,
    tss.StudentRatingComment comment, tss.StudentRatingDate ratedOn, ts.TutorId tid,
    concat(s.FirstName, ' ', s.LastName) tutorName,
    DATE(ts.SessionStartTime) date
    FROM proTutoringSessionStudents tss
    INNER JOIN proTutoringSession ts ON ts.SessionId LIKE tss.SessionId
    INNER JOIN proTutor t ON ts.TutorId LIKE t.TutorId
    INNER JOIN proStudent s ON t.StudentId LIKE s.StudentId
    INNER JOIN proClassInformation c ON t.ClassId LIKE c.ClassId
    WHERE
    tss.StudentId LIKE " . $studentId . ";";

    return $r = $this->runQuery($query);
  }

  public function rateTutor($data) {
    // Let any student rate a tutor but only once
    $tssId = $data['tssid'];
    $id = $data['id'];
    $rating = $data['newRating'];
    $sid = $data['sessionid'];

    $query = "UPDATE proTutoringSessionStudents SET StudentRating = ".$rating.
    ", StudentRatingDate = CURRENT_TIMESTAMP WHERE tssId LIKE ".$tssId.
    " AND StudentId LIKE ".$id.";";

    if($this->conn->query($query)) {
      return $r = 'Successfully rated';
    } else {
      $r = array(
        'type' => 'error',
        'message' => 'Cannot update the rating'
      );
      return $r;
    }
  }

  public function getStudentMySession() {
    // Get the list of all students who are not tutors
    //$id = $data['id'];

    $query = "SELECT s.StudentId sid, s.EmailAddress email,
    concat(s.FirstName, ' ', s.LastName) AS name
    FROM proStudent s WHERE s.StudentId NOT IN (SELECT t.studentId FROM proTutor t)";

    return $r = $this->runQuery($query);
  }

  public function addStudentMySession($data) {
    // Add students to currently logged in tutor's session
    if(!isset($data)) {
      throw new ResponseException(200,'No student is added');
    }
    else{
      $sessionId = $data['sessionid'];
      $studentId = $data['id'];
      if (!empty($data['id'])) {
        $query = "SELECT * FROM proTutoringSession ts
        WHERE ts.SessionId LIKE ".$sessionId.";";
        $result = $this->runQuery($query);

        if (!empty($result['error'])) {
          throw new ResponseException(200,'Session does not exist');
        }
        else {
          foreach ($result as $row) {
            $dateCreated = $row['DateCreated'];
          }

          $query = "SELECT * FROM proTutoringSessionStudents tss
          WHERE tss.SessionId LIKE ".$sessionId.";";
          //$query = "SELECT * FROM proTutoringSessionStudents tss ;";
          $result = $this->runQuery($query);
        //  foreach ($result as $row) {
        //    echo $row['DateCreated'];
        //  }
          if(!empty($result['type'])) {
            // Insert new record if empty
            $query = "INSERT INTO proTutoringSessionStudents (tssId, SessionId, StudentId,
            CompletedTutoring, StudentRating)
            VALUES(NULL, ".$sessionId.", ".$studentId.", 1, 0)";

            $this->conn->query($query) or die($this->conn->error . __LINE__);
          }
          else {
            // Get tss ID
            if(isset($result)) {
              foreach ($result as $row) {
                $tssId = $row['tssId'];
              }
            }
            // Check if the student has already been added
            $query = "SELECT tss.tssId, tss.SessionId, tss.StudentId
            FROM proTutoringSessionStudents tss WHERE
            tss.SessionId LIKE ".$sessionId." AND tss.StudentId LIKE ".$studentId.";";
            $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
            if($result->num_rows > 0) {
              // Student is already added to the session
              $r = array(
                'type' => 'error',
                'message' => 'This student has already been added to your session'
              );
              return $r;
            }
            else {
              // If already exist then add student to the session
              $query = "UPDATE proTutoringSessionStudents SET StudentId = ".$studentId.
              ", CompletedTutoring = 1, StudentRating = 0
              WHERE tssId LIKE ".$tssId." AND SessionId LIKE ".$sessionId.";";

              $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
            }
          }
        }
      }
      else {
        throw new ResponseException(200,'Not a valid session ID');
      }
    }

    return $r = 'Student has been added';
  }

  public function getMySessionsDropdown($data) {
    $id = $data['id'];

    $query = "SELECT ts.sessionId sessionid, c.coursename coursename
    FROM proTutoringSession ts INNER JOIN proTutor t ON ts.TutorId LIKE t.tutorId
    INNER JOIN proClassInformation c ON t.ClassId LIKE c.ClassId
    INNER JOIN proLocation l ON ts.LocationId LIKE l.LocationId
    INNER JOIN proStudent s ON t.StudentId LIKE s.StudentId
    WHERE s.StudentId LIKE ".$id.";";

    $r = $this->runQuery($query);
    if(!empty($r['error'])) {
      return $error = array(
        'type' => 'error',
        'message' => "No sessions available"
      );
    }

    return $r;
  }

  public function getMySessions($data) {
    // Get all of a tutor's active sessions
    $id = $data['id'];

    $query = "SELECT ts.SessionId sessionid,
    concat(c.Subject , ' ' , c.CourseNumber) as class,
    c.coursename coursename,
    concat(l.BuildingName, ' ' , l.RoomNumber) as location,
    dayname(ts.SessionStartTime) day,
    DATE(ts.SessionStartTime) date,
    TIME_FORMAT(ts.SessionStartTime,'%h:%i %p') starttime,
    TIME_FORMAT(ts.SessionEndTime,'%h:%i %p') endtime,
    CASE WHEN ts.Canceled LIKE 0 THEN
      CASE
        WHEN NOW() between ts.SessionStartTime AND ts.SessionEndTime THEN 'Active'
        WHEN ts.SessionEndTime <= NOW() THEN 'Completed'
        ELSE 'Upcoming'
      END
    ELSE 'Canceled' END status,
    ts.CancelReason reason,
    l.Active active
    FROM proTutoringSession ts INNER JOIN proTutor t ON ts.TutorId LIKE t.TutorId
    INNER JOIN proLocation l ON ts.LocationId LIKE l.LocationId
    INNER JOIN proClassInformation c ON t.ClassId LIKE c.ClassId
    WHERE t.StudentId LIKE ".$id.";";

    $r = $this->runQuery($query);
    if(!empty($r['error'])) {
      return $error = array(
        'type' => 'error',
        'message' => "No sessions available"
      );
    }

    return $r;
  }

  public function getDashboardProfile($data) {
    // Get user profile
    $id = $data['id'];
    $role = $data['role'];

    if ($role == 'admin') {
      $query = "SELECT pa.AdminId id,
      concat(pa.FirstName,' ', pa.LastName) name,
      pa.EmailAddress email
      FROM proAdministrator pa WHERE pa.AdminId LIKE ".$id.";";

      return $r = $this->runQuery($query);
    }
    else {
      $query = "SELECT s.StudentId id,
      concat(s.FirstName,' ', s.LastName) name,
      s.EmailAddress email";
    }

    if ($role == 'tutor') {
      $query .= ", t.TutorId tid, t.ClassId
      FROM proStudent s INNER JOIN proTutor t ON s.StudentId LIKE t.StudentId";
    }
    else {
      $query .= " FROM proStudent s";
    }

    $query .= " WHERE s.StudentId LIKE " .$id.";";

    return $r = $this->runQuery($query);
  }

  private function runQuery($query) {
    // Run query and return associative array
    $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
    $r = array();

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $r[] = $row;
      }
    }
    else {
      return $error = array(
        'type' => 'error',
        'message' => 'No records found'
      );
    }
    return $r;
  }

}

?>
