<?php
require_once("helpers.php");
class dataMain
{

	public function getlistAction(){
		$selectQuery = "
			SELECT
			concat(s.FirstName , ' ' , s.LastName) as name
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
		";
		
		$retobj = array();
		$retobj["data"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
}

?>
