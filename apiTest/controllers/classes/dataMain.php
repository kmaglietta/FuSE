<?php
require_once("helpers.php");
class dataMain
{
//where l.active = 1
	public function getlistAction(){
		$selectQuery = "
			SELECT
			concat(s.FirstName , ' ' , s.LastName) as name
			, concat(c.Subject , ' ' , c.CourseNumber) as class
			, c.coursename
			, concat(l.BuildingName, ' ' , l.RoomNumber) as location
			, dayname(ts.SessionStartTime) day
			, DATE(ts.SessionStartTime) date
			, TIME_FORMAT(ts.SessionStartTime,'%h:%i %p') starttime
			, TIME_FORMAT(ts.SessionEndTime,'%h:%i %p') endtime
			, case when ts.Canceled = 0 then 
				case 
					when NOW() between ts.SessionStartTime and ts.SessionEndTime then 'Active'
					when ts.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end status
			, s.studentid
			FROM proStudent s
			inner join proTutor t on s.StudentId = t.StudentId
			inner join proClassInformation  c on t.ClassId = c.ClassId
			inner join proTutoringSession ts on ts.TutorId = t.TutorId
			inner join proLocation l on l.LocationId = ts.LocationId
			
			where ts.SessionEndTime >= DATE_ADD(NOW(),INTERVAL - 24 hour)
			and ts.SessionEndTime <= DATE_ADD(CURDATE(),INTERVAL 7 day)
			
			Order by ts.SessionStartTime, c.coursename, concat(s.FirstName , ' ' , s.LastName)
		";
		
		$retobj = array();
		$retobj["data"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
	
	
	public function getdashboardlistAction(){
		$selectQuery = "
			SELECT
			concat(s.FirstName , ' ' , s.LastName) as name
			, concat(c.Subject , ' ' , c.CourseNumber) as class
			, c.coursename
			, concat(l.BuildingName, ' ' , l.RoomNumber) as location
			, dayname(ts.SessionStartTime) day
			, ts.SessionStartTime
			, TIME_FORMAT(ts.SessionStartTime,'%h:%i %p') starttime
			, TIME_FORMAT(ts.SessionEndTime,'%h:%i %p') endtime
			, case when ts.Canceled = 0 then 
				case 
					when NOW() between ts.SessionStartTime and ts.SessionEndTime then 'Active'
					when ts.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end status
			, s.studentid
			FROM proStudent s
			inner join proTutor t on s.StudentId = t.StudentId
			inner join proClassInformation  c on t.ClassId = c.ClassId
			inner join proTutoringSession ts on ts.TutorId = t.TutorId
			inner join proLocation l on l.LocationId = ts.LocationId
			
			where ts.SessionEndTime >= DATE_ADD(NOW(),INTERVAL - 1 hour)
			and ts.SessionEndTime <= DATE_ADD(CURDATE(),INTERVAL 1 day)
			
			Order by ts.SessionStartTime, c.coursename, concat(s.FirstName , ' ' , s.LastName)
		";
		
		// ts.SessionStartTime is today
		
		$retobj = array();
		$retobj["data"] = helpers::runQuery($selectQuery);
		return $retobj;
	}	
	
	
	
	
}

?>
