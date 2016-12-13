


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
			
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			,s.StudentId
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where TS.SessionId = $SessionId
		";
		
		$deleteQuery = "
			DELETE FROM proTutoringSession WHERE SessionId =  $SessionId
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
				
		$Canceled = helpers::getArrayValue($params,'Canceled');
		$CanceledByAdminId = helpers::getArrayValue($params,'CanceledByAdminId');
		$CancelReason = helpers::getArrayValue($params,'CancelReason');
		$CanceledByTutor = helpers::getArrayValue($params,'CanceledByTutor');


		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			,s.StudentId
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
				SessionEndTime = STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p'),
				Canceled = $Canceled, 
				CancelReason = '$CancelReason',
				CanceledByAdminId = $CanceledByAdminId,
				DateCanceled = 
					case when $CanceledByAdminId > 0 or $CanceledByTutor > 0 then NOW() else null end,
				CanceledByTutor = $CanceledByTutor
			where SessionId = $SessionId
		";
//
		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			,s.StudentId
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
		
//throw new ResponseException(500, "[$updateQuery]");

		
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
		//$Canceled = helpers::getArrayValue($params,'Canceled');
		//$CanceledByAdminId = helpers::validateInt($params,'CanceledByAdminId');
		//$CancelReason = helpers::getArrayValue($params,'CancelReason');


		
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$ApprovedByAdminId = helpers::getArrayValue($params,'ApprovedByAdminId');

		$selectQuery = "
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			,s.StudentId
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 
				TS.TutorId = $TutorId
				and TS.LocationId = $LocationId
				and TS.SessionStartTime = STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p') 
				and TS.SessionEndTime = STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p')

		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Session combination already exists in database');
		}

		//,Canceled,CanceledByAdminId
		//,$Canceled, case when $CanceledByAdminId = 0  then NULL else $CanceledByAdminId end		
		$insertQuery = "
			INSERT INTO proTutoringSession (SessionId, TutorId, LocationId, SessionStartTime, SessionEndTime, DateCreated) 
			VALUES (NULL, $TutorId, $LocationId, STR_TO_DATE('$SessionStartTime','%Y-%m-%d %h:%i %p') , STR_TO_DATE('$SessionEndTime','%Y-%m-%d %h:%i %p'), CURRENT_TIMESTAMP);
		";
	
//throw new ResponseException(500, "[$insertQuery]");			
		
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Session already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
//throw new ResponseException(500, "[$selectQuery]");		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutoringSession");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		//$StudentName = helpers::validateValueString((helpers::getArrayValue($params,'StudentName')),'StudentName');
		//$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		 $iSearch = helpers::validateValueString((helpers::getArrayValue($params,'iSearch')),'iSearch');
		$isCanceled = helpers::validateInt((helpers::getArrayValue($params,'isCanceled')),'isCanceled');
		$selectQuery = "
			
			SELECT

			TS.SessionId, TS.TutorId, TS.LocationId, TS.SessionStartTime, TS.SessionEndTime
			, TS.Canceled, TS.CancelReason, TS.CanceledByAdminId, TS.CanceledByTutor, TS.DateCanceled, TS.DateCreated
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			,s.StudentId
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId


			
			where 1 = 1
		";
		
		if ($isCanceled == 1) {
			$selectQuery .= " and TS.Canceled  = 1 ";
		}
		elseif ($isCanceled == 2){
			$selectQuery .= " and TS.Canceled = 0 ";
		}
		if ($iSearch != ""  ) {
			$selectQuery .= " and ( concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) like '%$iSearch%' 
							or concat(s.FirstName , ' ' , s.LastName) like '%$iSearch%' 
							)
			";
		}
		
		
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount  FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId");
		
		return $retobj;
	}




public static function gettutoredlistAction($data,$params)
	{

		$StudentId = helpers::getArrayValue($params,'StudentId');
		$iSearch = helpers::validateValueString((helpers::getArrayValue($params,'iSearch')),'iSearch');
		
		$selectQuery = "
			
			SELECT
			distinct 
			TS.SessionId 
                        
			
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ClassSession

			
			, TS.SessionStartTime
			, TS.SessionEndTime
			
			, case when TS.Canceled = 0 then 
				case 
					when NOW() between TS.SessionStartTime and TS.SessionEndTime then 'Active'
					when TS.SessionEndTime <= NOW() then 'Completed'
					else 'Upcoming' 
				end	
			else 'Canceled' end Status
			
			 FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId


			
			where s.studentId = $StudentId


			
		";
		
//throw new ResponseException(500, "[$selectQuery]");	
		if ($iSearch != ""  ) {
			$selectQuery .= " and ( concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) like '%$iSearch%' 
							)
			";
		}
		
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount  FROM 
			proTutoringSession TS
			inner join proTutor as t  on TS.TutorId = t.TutorId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId


			
			where s.studentId = $StudentId");
		
		return $retobj;
	}


	
}

?>
