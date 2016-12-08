<?php
require_once("helpers.php");
class dataStudent
{

	public function getnamesAction($data,$params){
		$selectQuery = "
			SELECT
			concat(FirstName , ' ' , LastName) as DisplayText
			, StudentId Value
			FROM proStudent
		";
		
		$retobj = array();
		$retobj["Options"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	

	public static function deleteAction($data,$params)
	{
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		$selectQuery = "
			SELECT 
			s.StudentId
			, s.EmailAddress
			, '********' Password
			, s.FirstName
			, s.LastName
			, s.ContactPhone
			, s.FavoriteTutorId
			, s.DateEntered
			, case when t.tutorId is null then 'No' else 'Yes' end isTutor
			FROM proStudent as s
			left outer join proTutor as t on s.StudentId = t.StudentId
			where s.StudentId = $StudentId
		";
		
		$deleteQuery = "
			DELETE FROM proStudent WHERE proStudent.StudentId =  '$StudentId'
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Student Id does not exists in database');
		}
		helpers::runQuery($deleteQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proStudent");
		return $retobj;
		
	}
	
	public static function updateAction($data,$params)
	{
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		$LastName = helpers::validateString((helpers::getArrayValue($params,'LastName')),'LastName');
		$FirstName = helpers::validateString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		$Password = helpers::validateString((helpers::getArrayValue($params,'Password')),'Password');
		$ContactPhone = helpers::validatePhone((helpers::getArrayValue($params,'ContactPhone')),'ContactPhone');

		$selectQuery = "
			SELECT 
			s.StudentId
			, s.EmailAddress
			, '********' Password
			, s.FirstName
			, s.LastName
			, s.ContactPhone
			, s.FavoriteTutorId
			, s.DateEntered
			, case when t.tutorId is null then 'No' else 'Yes' end isTutor
			FROM proStudent as s
			left outer join proTutor as t on s.StudentId = t.StudentId
			where s.StudentId = $StudentId
		";
		
		$updateQuery = "
			Update proStudent set
				Password = CASE  when '$Password' = '********' then Password else '$Password' end
				, FirstName = '$FirstName' 
				, LastName =  '$LastName' 
				, ContactPhone =  '$ContactPhone'
			where StudentId = '$StudentId'
		";
//throw new ResponseException(500, "[$updateQuery]");	
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Student Id does not exists in database');
		}
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proStudent");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){
		$EmailAddress = helpers::validateEmail(helpers::getArrayValue($params,'EmailAddress'));
		$LastName = helpers::validateString((helpers::getArrayValue($params,'LastName')),'LastName');
		$FirstName = helpers::validateString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		$Password = helpers::validateString((helpers::getArrayValue($params,'Password')),'Password');
		$ContactPhone = helpers::validatePhone((helpers::getArrayValue($params,'ContactPhone')),'ContactPhone');

		$insertQuery = "
			INSERT INTO proStudent (StudentId, EmailAddress, Password, FirstName, LastName, ContactPhone, FavoriteTutorId, DateEntered) 
			VALUES (NULL, '$EmailAddress', '$Password', '$FirstName', '$LastName', '$ContactPhone', NULL, CURRENT_TIMESTAMP);
		";
	
		$selectQuery = "
			SELECT 
			s.StudentId
			, s.EmailAddress
			, '********' Password
			, s.FirstName
			, s.LastName
			, s.ContactPhone
			, s.FavoriteTutorId
			, s.DateEntered
			, case when t.tutorId is null then 'No' else 'Yes' end isTutor
			FROM proStudent as s
			left outer join proTutor as t on s.StudentId = t.StudentId
			where s.EmailAddress = '$EmailAddress'
		";
		
		
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Student already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proStudent");
		return $retobj;
	}
		
	public static function getAction($data,$params)
	{

		$isTutor = helpers::validateInt((helpers::getArrayValue($params,'isTutor')),'isTutor');
		$iSearch = helpers::validateValueString((helpers::getArrayValue($params,'iSearch')),'iSearch');
		//$LastName = helpers::validateValueString((helpers::getArrayValue($params,'LastName')),'LastName');
		//$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		
			
		$selectQuery = "
			SELECT 
			s.StudentId
			, s.EmailAddress
			, '********' Password
			, s.FirstName
			, s.LastName
			, s.ContactPhone
			, s.FavoriteTutorId
			, s.DateEntered
			, case when t.tutorId is null then 'No' else 'Yes' end isTutor
			FROM proStudent as s
			left outer join proTutor as t on s.StudentId = t.StudentId
			where 1 = 1
		";
		if ($isTutor == 1) {
			$selectQuery .= " and t.tutorId is not null ";
		}
		elseif ($isTutor == 2){
			$selectQuery .= " and t.tutorId is null ";
		}
		//if ($LastName != "") {
//			$selectQuery .= " and s.LastName like '%$LastName%' ";
//		}
//		if ($FirstName != "") {
//			$selectQuery .= " and s.FirstName like '%$FirstName%' ";
//		}
		if ($iSearch != ""  ) {
			$selectQuery .= " and ( s.FirstName like '%$iSearch%' 
							or s.LastName like '%$iSearch%' 
							or s.ContactPhone like '%$iSearch%' 
							or s.EmailAddress like '%$iSearch%' 
							
							)
			";
		}
//throw new ResponseException(500, "[$selectQuery]");		

		
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proStudent");
		
		return $retobj;
	}
	
	
	public function getuserAction($data,$params){
		$EmailAddress = helpers::getArrayValue($params,'EmailAddress');
		$Password = helpers::getArrayValue($params,'Password');
		
		
		$selectQuery = "
		SELECT 

			StudentId 
			, guiid 
			FROM proStudent 
			where EmailAddress = '$EmailAddress'  
			and Password = '$Password' 
		";
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		//$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
//throw new ResponseException(500, "[$selectQuery]");	

		return $retobj;
		
	}
	
	
	
	public function getstudentprofileAction($data,$params){
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		
		$selectQuery = "
			
		SELECT 
			s.StudentId
			, s.FirstName
			, s.LastName
			, concat(s.FirstName , ' ' , s.LastName) as StudentName
	
		
			from 
			proStudent s
			where s.StudentId = $StudentId
			
			
		";
	 	
		$retobj = array();
	
		$retobj['Records'] = helpers::runQuery($selectQuery);
		//$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proTutor");
		return $retobj;
	}


	public function getstudentclassesAction($data,$params){
		
		$StudentId = helpers::getArrayValue($params,'StudentId');
		
		$selectQuery = "
			
SELECT 
concat(c.Subject , ' ' , c.CourseNumber) Course
, c.CourseName
, tss.studentRating
FROM proTutor t
inner join proAdministrator  as p on t.ApprovedByAdminId = p.AdminId
inner join proStudent as s on s.StudentId = t.StudentId
inner join proClassInformation as c on c.ClassId = t.ClassId
inner join proTutoringSession ts on ts.TutorId = t.TutorId
left join  proTutoringSessionStudents tss   on tss.SessionId = ts.SessionId
				
where s.StudentId = $StudentId

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
