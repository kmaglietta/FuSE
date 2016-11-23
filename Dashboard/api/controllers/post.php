<?php

class post
{
	////where xxxx is the action in lower case
	//public function xxxxxAction()
	//{
	//
	//	return $obj;
	//}



	public function getlistAction()
	{

		//$obj = array();
//
//		$obj['xxxx'] = '111';
//		$obj['yyyy'] = '2222';
//		$obj['zzzz'] = '3333';
//
//		$list = array();
//		$list[] = $obj;
//		$list[] = $obj;
//		$list[] = $obj;
//
//
//		$obj['ffff'] = $list;

		$obj = $this -> runQuery("
			SELECT
			concat(s.Firstname , ' ' , s.LastName) as name
			, concat(c.Subject , ' ' , c.CourseNumber) as class
			, c.coursename
			, concat(l.BuildingName, ' ' , l.RoomNumber) as location
			, DATE_FORMAT(ts.SessionStartDate,'%H:%i:%s') starttime
			, DATE_FORMAT(ts.SessionEndDate,'%H:%i:%s') endtime
			FROM proStudent s
			inner join proTutor t on s.StudentId = t.StudentId
			inner join proClassInformation  c on t.ClassId = c.ClassId
			inner join proTutoringSession ts on ts.TutorId = t.TutorId
			inner join proLocation l on l.LocationId = ts.LocationId
			where l.active = 1
		");
		return $obj;
	}

	private function runQuery($sql){
		$servername = 'localhost';
		$dbname = ''; 
		$dbuser = '';
		$dbpass = '';

		// Create connection
		$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

		if($conn->connect_error) {
		   throw new Exception ('Unable to connect to database [' . $conn->connect_error . ']');
		}
		$result = $conn->query($sql);
		$conn->close();
		$rows = array();
		$total_records = mysqli_num_rows($result);
		if($total_records > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}
		else
		{
			//throw new ResponseException(204,'No records found');
			return $rows;
		}
	}

}
