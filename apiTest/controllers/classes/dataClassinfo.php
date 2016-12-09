<?php
require_once("helpers.php");
class dataClassinfo
{
	public function getnamesAction($data,$params){
		$selectQuery = "
			SELECT
			concat(Subject , ' ' , CourseNumber, ' - ' ,  CourseName) as DisplayText
			, ClassId Value
			FROM proClassInformation
		";
		
		$retobj = array();
		$retobj["Options"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
	public static function deleteAction($data,$params)
	{
		
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$selectQuery = "
			SELECT 
			ClassId, Subject, CourseNumber, Lab, CourseName, ApprovedBy, DateEntered
			FROM proClassInformation 
			where s.ClassId = $ClassId
		";
		
		$deleteQuery = "
			DELETE FROM proClassInformation WHERE proClassInformation.ClassId =  '$ClassId'
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Class Id does not exists in database');
		}
		helpers::runQuery($deleteQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proClassInformation");
		return $retobj;
		
	}
	
	public static function updateAction($data,$params)
	{
		
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$Subject = helpers::validateString((helpers::getArrayValue($params,'Subject')),'Subject');
		$CourseNumber = helpers::validateString((helpers::getArrayValue($params,'CourseNumber')),'CourseNumber');
		$CourseName = helpers::validateString((helpers::getArrayValue($params,'CourseName')),'CourseName');
		$Lab = helpers::validateString((helpers::getArrayValue($params,'Lab')),'Lab');
		$ApprovedBy = helpers::validateInt((helpers::getArrayValue($params,'ApprovedBy')),'ApprovedBy');
		
		$selectQuery = "
			SELECT 
			ClassId, Subject, CourseNumber, Lab, CourseName, ApprovedBy, DateEntered
			FROM proClassInformation 
			where (Subject = '$Subject' and  CourseNumber = '$CourseNumber' and Lab = $Lab and CourseName = '$CourseName')
			and ClassId <> $ClassId
		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Subject, CourseNumber, CourseName and Lab combination already exists in database');
		}
	
		$updateQuery = "
			Update proClassInformation set
				Subject = upper('$Subject')
				, CourseNumber = '$CourseNumber' 
				, CourseName =  '$CourseName' 
				, Lab =  $Lab
				, ApprovedBy =  $ApprovedBy 
			where ClassId = '$ClassId'
		";
		$selectQuery = "
			SELECT 
			ClassId, Subject, CourseNumber, Lab, CourseName, ApprovedBy, DateEntered
			FROM proClassInformation 
			where ClassId = '$ClassId'
		";
		
		
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Class Id does not exists in database');
		}
		
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proClassInformation");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){
		
		$ClassId = helpers::getArrayValue($params,'ClassId');
		$Subject = helpers::validateString((helpers::getArrayValue($params,'Subject')),'Subject');
		$CourseNumber = helpers::validateString((helpers::getArrayValue($params,'CourseNumber')),'CourseNumber');
		$CourseName = helpers::validateString((helpers::getArrayValue($params,'CourseName')),'CourseName');
		$Lab = helpers::validateString((helpers::getArrayValue($params,'Lab')),'Lab');
		$ApprovedBy = helpers::validateInt((helpers::getArrayValue($params,'ApprovedBy')),'ApprovedBy');
		
		//todo
		$insertQuery = "
			INSERT INTO proClassInformation (ClassId, Subject, CourseNumber, CourseName, Lab, ApprovedBy, DateEntered) 
			VALUES (NULL, upper('$Subject'), '$CourseNumber', '$CourseName', $Lab, '$ApprovedBy', CURRENT_TIMESTAMP);
	";
		$selectQuery = "
			SELECT 
			ClassId, Subject, CourseNumber, Lab, CourseName, ApprovedBy, DateEntered
			FROM proClassInformation 
			where  Subject = '$Subject' and  CourseNumber = '$CourseNumber' and Lab = $Lab and CourseName = '$CourseName'
		";
		
//throw new ResponseException(500, "[$insertQuery]");	
	
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Class already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proClassInformation");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		$iSearch = helpers::validateValueString((helpers::getArrayValue($params,'iSearch')),'iSearch');
		
		 	
		$selectQuery = "
			SELECT 
			c.ClassId, c.Subject, c.CourseNumber, c.Lab, c.CourseName, c.ApprovedBy, c.DateEntered
			, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
			FROM proClassInformation c
 			inner join proAdministrator  as p on c.ApprovedBy = p.AdminId
			where 1 = 1
		";

		
		if ($iSearch != ""  ) {
			$selectQuery .= " and ( c.Subject like '%$iSearch%' 
							or c.CourseNumber like '%$iSearch%' 
							or c.Lab like '%$iSearch%' 
							or c.CourseName like '%$iSearch%' 
							or concat(p.FirstName , ' ' , p.LastName) like '%$iSearch%' 
							
							)
			";
		}
		
//throw new ResponseException(500, "$selectQuery");	
		

		
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proClassInformation");
		
		return $retobj;
	}


	
}

?>
