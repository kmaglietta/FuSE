


<?php
require_once("helpers.php");
class dataClasssession
{
	
	public static function deleteAction($data,$params)
	{
		
		$SessionId = helpers::getArrayValue($params,'SessionId');
		
		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where TS.SessionId = $SessionId
		";
		
		$deleteQuery = "
			DELETE FROM proTutor WHERE proTutor.TutorId =  $SessionId
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'SessionId does not exists in database');
		}
		helpers::runQuery($deleteQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutoringSession");
		return $retobj;
		
	}
	
	public static function updateAction($data,$params)
	{
		$SessionId = helpers::getArrayValue($params,'SessionId');
		$TutorId = helpers::getArrayValue($params,'TutorId');
		$LocationId = helpers::getArrayValue($params,'LocationId');
		$SessionStartTime = helpers::getArrayValue($params,'SessionStartTime');
		$SessionEndTime = helpers::getArrayValue($params,'SessionEndTime');

		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 
				t.TutorId = $TutorId
				and t.LocationId = $LocationId
				and t.SessionStartTime = STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p')
				and t.SessionEndTime = STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p')
				and TS.SessionId <> $SessionId
		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Session already exists for this combination');
		}
				
		$updateQuery = "
			Update proTutoringSession set
				TutorId = $TutorId, 
				LocationId = $LocationId, 
				SessionStartTime = STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p')  , 
				SessionEndTime = STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p')
			
			where SessionId = $SessionId
		";
//throw new ResponseException(500, "[$updateQuery]");
		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where TS.SessionId = $SessionId
		";
		
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'SessionId does not exists in database');
		}
		
		
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutoringSession");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){

		$SessionId = helpers::getArrayValue($params,'SessionId');
		$TutorId = helpers::getArrayValue($params,'TutorId');
		$LocationId = helpers::getArrayValue($params,'LocationId');
		$SessionStartTime = helpers::getArrayValue($params,'SessionStartTime');
		$SessionEndTime = helpers::getArrayValue($params,'SessionEndTime');
		
		
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$ApprovedByAdminId = helpers::getArrayValue($params,'ApprovedByAdminId');

		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 
				t.TutorId = $TutorId
				and t.LocationId = $LocationId
				and t.SessionStartTime = STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p') 
				and t.SessionEndTime = STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p')

		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Session combination already exists in database');
		}

		$insertQuery = "
			INSERT INTO proTutoringSession (SessionId, TutorId, LocationId, SessionStartTime, SessionEndTime, DateEntered) 
			VALUES (NULL, $TutorId, $LocationId, STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p') , STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p'), CURRENT_TIMESTAMP);
		";
	
		
		
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Session already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutoringSession");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		//$StudentName = helpers::validateValueString((helpers::getArrayValue($params,'StudentName')),'StudentName');
		//$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		 
			
		$selectQuery = "
			
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId


			
			where 1 = 1
		";

		//if ($StudentName != "") {
//			$selectQuery .= " and concat(s.FirstName , ' ' , s.LastName) like '%$StudentName%' ";
//		}
//		if ($CourseName != "") {
//			$selectQuery .= " and concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) like '%$CourseName%' ";
//		}
		
		$jtSorting = helpers::getArrayValue($params,'jtSorting');
		if ($jtSorting != "" && $jtSorting != "undefined" ){
			$selectQuery .= " ORDER BY $jtSorting";
		}

		$jtStartIndex = helpers::getArrayValue($params,'jtStartIndex');
		if ($jtStartIndex != "" ){
			$selectQuery .= " Limit $jtStartIndex";
		}
		
		
		$jtPageSize = helpers::getArrayValue($params,'jtPageSize');
		if ($jtPageSize != "" ){
			$selectQuery .= " , $jtPageSize";
		}
//throw new ResponseException(500, "[$selectQuery]");
		
		$retobj = array();
		
		$retobj['Records'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutoringSession");
		
		return $retobj;
	}


	
}

?>