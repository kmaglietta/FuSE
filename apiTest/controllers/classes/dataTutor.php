<?php
require_once("helpers.php");
class dataTutor
{
	public function getnamesAction($data,$params){
		$selectQuery = "
			SELECT
			concat(c.Subject , ' ' , c.CourseNumber, ' ' ,  c.CourseName, ' - ', s.FirstName , ' ' , s.LastName) as DisplayText
			, TutorId Value
			FROM proTutor as t  
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			order by 1
		";
		
		$retobj = array();
		$retobj["Options"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
	
	public static function deleteAction($data,$params)
	{
		
		$TutorId = helpers::getArrayValue($params,'TutorId');
		$selectQuery = "
			SELECT 
			
			t.TutorId, t.StudentId, t.ClassId, t.ApprovedOn, t.ApprovedByAdminId, t.DateEntered
			
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, concat(c.Subject , ' ' , c.CourseNumber, ' ' ,  c.CourseName) as ApprovedForClassName
			, concat(p.FirstName , ' ' , p.LastName) as ApprovedByName
			
			FROM proTutor t
			inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where TutorId = $TutorId
		";
		
		$deleteQuery = "
			DELETE FROM proTutor WHERE proTutor.TutorId =  '$TutorId'
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Tutor Id does not exists in database');
		}
		helpers::runQuery($deleteQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		return $retobj;
		
	}
	
	public static function updateAction($data,$params)
	{
		$TutorId = helpers::getArrayValue($params,'TutorId');
		$StudentId = helpers::getArrayValue($params,'StudentId');
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$ApprovedByAdminId = helpers::getArrayValue($params,'ApprovedByAdminId');

		$selectQuery = "
			SELECT 
			
			t.TutorId, t.StudentId, t.ClassId, t.ApprovedOn, t.ApprovedByAdminId, t.DateEntered
			
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, concat(c.Subject , ' ' , c.CourseNumber, ' ' ,  c.CourseName) as ApprovedForClassName
			, concat(p.FirstName , ' ' , p.LastName) as ApprovedByName
			
			FROM proTutor t
			inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 
				t.StudentId = $StudentId
				and t.ClassId = $ClassId
				and t.TutorId <> $TutorId
		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Tutor already approved for this class');
		}
				
		$updateQuery = "
			Update proTutor set
				StudentId = $StudentId, 
				ClassId = $ClassId, 
				ApprovedByAdminId =  $ApprovedByAdminId
			where TutorId = '$TutorId'
		";
		
		$selectQuery = "
			SELECT 
			
			t.TutorId, t.StudentId, t.ClassId, t.ApprovedOn, t.ApprovedByAdminId, t.DateEntered
			
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ApprovedForClassName
			, concat(p.FirstName , ' ' , p.LastName) as ApprovedByName
			
			FROM proTutor t
			inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where TutorId = $TutorId
		";
		
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Tutor Id does not exists in database');
		}
		
		
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){

		$StudentId = helpers::getArrayValue($params,'StudentId');
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$ApprovedByAdminId = helpers::getArrayValue($params,'ApprovedByAdminId');

		$selectQuery = "
			SELECT 
			
			t.TutorId, t.StudentId, t.ClassId, t.ApprovedOn, t.ApprovedByAdminId, t.DateEntered
			
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ApprovedForClassName
			, concat(p.FirstName , ' ' , p.LastName) as ApprovedByName
			
			FROM proTutor t
			inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 
				t.StudentId = $StudentId
				and t.ClassId = $ClassId
		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Tutor and class combination already exists in database');
		}

		$insertQuery = "
			INSERT INTO proTutor (TutorId, StudentId, ClassId, ApprovedOn, ApprovedByAdminId, DateEntered) 
			VALUES (NULL, $StudentId, $ClassId, '$ApprovedOn', $ApprovedByAdminId, CURRENT_TIMESTAMP);
		";
	
		
		
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Tutor already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		$StudentName = helpers::validateValueString((helpers::getArrayValue($params,'StudentName')),'StudentName');
		$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		
			
		$selectQuery = "
			
			SELECT 
			
			t.TutorId, t.StudentId, t.ClassId, t.ApprovedOn, t.ApprovedByAdminId, t.DateEntered
			
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) as ApprovedForClassName
			, concat(p.FirstName , ' ' , p.LastName) as ApprovedByName
			
			FROM proTutor t
			inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
			inner join proStudent as s on s.StudentId = t.StudentId
			inner join proClassInformation as c on c.ClassId = t.ClassId
			
			where 1 = 1
		";

		if ($StudentName != "") {
			$selectQuery .= " and concat(s.FirstName , ' ' , s.LastName) like '%$StudentName%' ";
		}
		if ($CourseName != "") {
			$selectQuery .= " and concat(c.Subject , ' ' , c.Coursename, ' ' ,  c.CourseName) like '%$CourseName%' ";
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		
		return $retobj;
	}
	
	
	
	
	
	
	
	
	public function getprofileAction($data,$params){
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		
		$selectQuery = "
			
		SELECT 
			t.StudentId
			, s.FirstName
			, s.LastName
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
			, min(t.ApprovedOn) TutorSince
			, count(1) TotalStudentsTutored
			, sum(tss.StudentRating ) TotalRatingSum
			, sum( case when tss.StudentRating > 0 then 1 else 0 end) TotalStudentsRatedTutor
			, sum(tss.StudentRating ) /  sum( case when tss.StudentRating > 0 then 1 else 0 end)  AverageRating
			
			
			from 
			proTutor t 
			inner join proStudent s on s.StudentId = t.StudentId
			inner join proTutoringSession ts on ts.TutorId = t.TutorId 
			left join  proTutoringSessionStudents tss   on tss.SessionId = ts.SessionId

			where t.StudentId = $StudentId
			
			group by t.StudentId
			, s.FirstName
			, s.LastName
			, concat(s.FirstName , ' ' , s.LastName)
			
		";
		
		$retobj = array();
		
		$retobj['Records'] = helpers::runQuery($selectQuery);
		//$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		return $retobj;
	}


	public function gettutorclassesAction($data,$params){
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		
		$selectQuery = "
			
				SELECT 
					
				
				concat(c.Subject , ' ' , c.CourseNumber) Course
				, c.CourseName
				
				, sum(tss.StudentRating ) TotalRatingSum
							, sum( case when tss.StudentRating > 0 then 1 else 0 end) TotalStudentsRatedTutor
							, sum(tss.StudentRating ) /  sum( case when tss.StudentRating > 0 then 1 else 0 end)  AverageRating
							
						FROM proTutor t
							inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
							inner join proStudent as s on s.StudentId = t.StudentId
							inner join proClassInformation as c on c.ClassId = t.ClassId
				inner join proTutoringSession ts on ts.TutorId = t.TutorId
				
				left join  proTutoringSessionStudents tss   on tss.SessionId = ts.SessionId
				
				
				where t.StudentId = $StudentId
				
				group by 
				concat(c.Subject , ' ' , c.CourseNumber) 
				, c.CourseName
				
				order by 1,2
							
			
		";
//throw new ResponseException(500, "[$selectQuery]");		
		$retobj = array();
		
		$retobj['Records'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("
		
			SELECT 
					
				count(distinct t.TutorId) TotalRecordCount
							
						FROM proTutor t
							inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
							inner join proStudent as s on s.StudentId = t.StudentId
							inner join proClassInformation as c on c.ClassId = t.ClassId
				inner join proTutoringSession ts on ts.TutorId = t.TutorId
				
				left join  proTutoringSessionStudents tss   on tss.SessionId = ts.SessionId
				
				
				where t.StudentId = $StudentId
				
				

		
		
		
		");
		return $retobj;
	}	
	


	
}

?>
