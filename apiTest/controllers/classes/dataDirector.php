<?php
require_once("helpers.php");
class dataDirector
{
	
	public function getnamesAction($data,$params){
		$selectQuery = "
			SELECT
			concat(FirstName , ' ' , LastName) as DisplayText
			, AdminId Value
			FROM proAdministrator
		";
		
		$retobj = array();
		$retobj["Options"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
	
	public static function deleteAction($data,$params)
	{
		
		$AdminId = helpers::getArrayValue($params,'AdminId');
		$selectQuery = "
			SELECT 
				AdminId, FirstName, LastName, EmailAddress, '********' Password, DateEntered
				
			FROM proAdministrator
			where AdminId = $AdminId
		";
		
		$deleteQuery = "
			DELETE FROM proAdministrator WHERE proAdministrator.AdminId =  '$AdminId'
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Admin Id does not exists in database');
		}
		helpers::runQuery($deleteQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proAdministrator");
		return $retobj;
		
	}
	
	public static function updateAction($data,$params)
	{
		
		$AdminId = helpers::getArrayValue($params,'AdminId');
		$LastName = helpers::validateValueString((helpers::getArrayValue($params,'LastName')),'LastName');
		$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		$Password = helpers::validateValueString((helpers::getArrayValue($params,'Password')),'Password');
		//$ContactPhone = helpers::validatePhone((helpers::getArrayValue($params,'ContactPhone')),'ContactPhone');

		$selectQuery = "
			SELECT 
				AdminId, FirstName, LastName, EmailAddress, '********' Password, DateEntered
				
			FROM proAdministrator
			where AdminId = $AdminId
		";
		
		$updateQuery = "
			Update proAdministrator set
				Password = CASE when '$Password' = '********' then Password else '$Password' end
				, FirstName = '$FirstName' 
				, LastName =  '$LastName' 
			where AdminId = '$AdminId'
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'Admin Id does not exists in database');
		}
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proAdministrator");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){
		$EmailAddress = helpers::validateEmail(helpers::getArrayValue($params,'EmailAddress'));
		$LastName = helpers::validateValueString((helpers::getArrayValue($params,'LastName')),'LastName');
		$FirstName = helpers::validateValueString((helpers::getArrayValue($params,'FirstName')),'FirstName');
		$Password = helpers::validateValueString((helpers::getArrayValue($params,'Password')),'Password');

		$insertQuery = "
			INSERT INTO proAdministrator (AdminId, FirstName, LastName, EmailAddress, Password, DateEntered) 
			VALUES (NULL, '$FirstName', '$LastName', '$EmailAddress', '$Password', CURRENT_TIMESTAMP);
		";
	
		$selectQuery = "
			SELECT 
				AdminId, FirstName, LastName, EmailAddress, '********' Password, DateEntered
				
			FROM proAdministrator
			where EmailAddress = '$EmailAddress'
		";
		
		
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Admin already exists in database');
		}
		helpers::runQuery($insertQuery);
		$obj = helpers::runQuery($selectQuery);
		
		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proAdministrator");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		$iSearch = helpers::validateValueString((helpers::getArrayValue($params,'iSearch')),'iSearch');
		
			
		$selectQuery = "
			SELECT 
				AdminId, FirstName, LastName, EmailAddress, '********' Password, DateEntered
				
			FROM proAdministrator
			where 1 = 1
		";

		if ($iSearch != ""  ) {
			$selectQuery .= " and ( FirstName like '%$iSearch%' 
							or LastName like '%$iSearch%' 
							or EmailAddress like '%$iSearch%' 
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proAdministrator");
		
		return $retobj;
	}


	
}

?>
