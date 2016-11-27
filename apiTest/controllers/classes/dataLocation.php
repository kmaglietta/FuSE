<?php
require_once("helpers.php");
class dataLocation
{
	
	public function getnamesAction($data,$params){
		$selectQuery = "
			SELECT
			concat(BuildingName , ' ' , RoomNumber) as DisplayText
			, LocationId Value
			FROM proLocation
		";
		
		$retobj = array();
		$retobj["Options"] = helpers::runQuery($selectQuery);
		return $retobj;
	}
	
	
	public static function deleteAction($data,$params)
	{
		
		$LocationId = helpers::getArrayValue($params,'LocationId');
		$selectQuery = "
			SELECT 
			l.LocationId
				, l.BuildingName
				, l.RoomNumber
				, l.RequiresBooking
				, l.MultiBookingAllowed
				, l.MaxNumberUsers
				, l.Active
				, l.ApprovedBy
				, l.DateEntered
				, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
				
				FROM proLocation as l
				inner join proAdministrator  as p on l.ApprovedBy = p.AdminId
			where l.LocationId = $LocationId
		";
		
		$deleteQuery = "
			DELETE FROM proLocation WHERE proLocation.LocationId =  '$LocationId'
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proLocation");
		return $retobj;
		
	}
//http://jtable.org/Demo/CascadeDropDown	
	public static function updateAction($data,$params)
	{
		
		$LocationId = helpers::getArrayValue($params,'LocationId');
		$BuildingName = helpers::validateValueString((helpers::getArrayValue($params,'BuildingName')),'BuildingName');
		$RoomNumber = helpers::validateValueString((helpers::getArrayValue($params,'RoomNumber')),'RoomNumber');
		$RequiresBooking = helpers::validateInt((helpers::getArrayValue($params,'RequiresBooking')),'RequiresBooking');
		$MultiBookingAllowed = helpers::validateInt((helpers::getArrayValue($params,'MultiBookingAllowed')),'MultiBookingAllowed');
		$MaxNumberUsers = helpers::validateInt((helpers::getArrayValue($params,'MaxNumberUsers')),'MaxNumberUsers');
		$Active = helpers::validateInt((helpers::getArrayValue($params,'Active')),'Active');
		$ApprovedBy = helpers::validateInt((helpers::getArrayValue($params,'ApprovedBy')),'ApprovedBy');

		
		
		$selectQuery = "
			SELECT 
			l.LocationId
				, l.BuildingName
				, l.RoomNumber
				, l.RequiresBooking
				, l.MultiBookingAllowed
				, l.MaxNumberUsers
				, l.Active
				, l.ApprovedBy
				, l.DateEntered
				, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
				
				FROM proLocation as l
				inner join proAdministrator  as p on l.ApprovedBy = p.AdminId
			where (l.BuildingName = '$BuildingName'
			and RoomNumber = '$RoomNumber'
			) and LocationId <> '$LocationId'
		";
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Location and Room number already exists in database');
		}
		
		$updateQuery = "
			Update proLocation set
				BuildingName = '$BuildingName'
				, RoomNumber = '$RoomNumber' 
				, RequiresBooking =  $RequiresBooking 
				, MultiBookingAllowed =  $MultiBookingAllowed 
				, MaxNumberUsers =  '$MaxNumberUsers'
				, Active =  $Active 
				, ApprovedBy =  $ApprovedBy 
				
			where LocationId = '$LocationId'
		";
		

		
		$selectQuery = "
			SELECT 
			l.LocationId
				, l.BuildingName
				, l.RoomNumber
				, l.RequiresBooking
				, l.MultiBookingAllowed
				, l.MaxNumberUsers
				, l.Active
				, l.ApprovedBy
				, l.DateEntered
				, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
				
				FROM proLocation as l
				inner join proAdministrator  as p on l.ApprovedBy = p.AdminId
			where l.LocationId = $LocationId
		";
		
		$obj = helpers::runQuery($selectQuery);
		if (!$obj)
		{
			throw new ResponseException(200,'LocationId does not exist in database');
		}
		
		
		helpers::runQuery($updateQuery);
		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proLocation");
		return $retobj;
		
	}
	
	public static function addAction($data,$params){
		$LocationId = helpers::getArrayValue($params,'LocationId');
		$BuildingName = helpers::validateValueString((helpers::getArrayValue($params,'BuildingName')),'BuildingName');
		$RoomNumber = helpers::validateValueString((helpers::getArrayValue($params,'RoomNumber')),'RoomNumber');
		$RequiresBooking = helpers::validateInt((helpers::getArrayValue($params,'RequiresBooking')),'RequiresBooking');
		$MultiBookingAllowed = helpers::validateInt((helpers::getArrayValue($params,'MultiBookingAllowed')),'MultiBookingAllowed');
		$MaxNumberUsers = helpers::validateInt((helpers::getArrayValue($params,'MaxNumberUsers')),'MaxNumberUsers');
		$Active = helpers::validateInt((helpers::getArrayValue($params,'Active')),'Active');
		$ApprovedBy = helpers::validateInt((helpers::getArrayValue($params,'ApprovedBy')),'ApprovedBy');

		$insertQuery = "
			INSERT INTO proLocation (LocationId, BuildingName, RoomNumber, RequiresBooking, MultiBookingAllowed, MaxNumberUsers, Active, ApprovedBy, DateEntered) 
			VALUES (NULL, '$BuildingName', '$RoomNumber' , $RequiresBooking , $MultiBookingAllowed , '$MaxNumberUsers', $Active , $ApprovedBy, CURRENT_TIMESTAMP);
		";
	
		$selectQuery = "
			SELECT 
			l.LocationId
				, l.BuildingName
				, l.RoomNumber
				, l.RequiresBooking
				, l.MultiBookingAllowed
				, l.MaxNumberUsers
				, l.Active
				, l.ApprovedBy
				, l.DateEntered
				, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
				
				FROM proLocation as l
				inner join proAdministrator  as p on l.ApprovedBy = p.AdminId
			where l.BuildingName = '$BuildingName'
			and RoomNumber = '$RoomNumber'
		";
		
	
		$obj = helpers::runQuery($selectQuery);
		if ($obj)
		{
			throw new ResponseException(200,'Location Already exists');
		}
		helpers::runQuery($insertQuery);

		$obj = helpers::runQuery($selectQuery);

		$retobj = array();
		$retobj['Record'] = helpers::runQuery($selectQuery);
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proLocation");
		return $retobj;
	}
	
	public static function getAction($data,$params)
	{

		$BuildingName = helpers::validateValueString((helpers::getArrayValue($params,'BuildingName')),'BuildingName');

		$selectQuery = "
			SELECT

				l.LocationId
				, l.BuildingName
				, l.RoomNumber
				, l.RequiresBooking
				, l.MultiBookingAllowed
				, l.MaxNumberUsers
				, l.Active
				, l.ApprovedBy
				, l.DateEntered
				, concat(p.FirstName , ' ' , p.LastName) as  ApprovedByName
				
				FROM proLocation as l
				inner join proAdministrator  as p on l.ApprovedBy = p.AdminId
				

			where 1 = 1
		";
		if ($BuildingName != "") {
			$selectQuery .= " and l.BuildingName like '%$BuildingName%' ";
		}
		
		

		
		$jtSorting = helpers::getArrayValue($params,'jtSorting');
		if ($jtSorting != "" && $jtSorting != "undefined" ){
			$selectQuery .= " ORDER BY $jtSorting";
		}
		else
		{
			$selectQuery .= " ORDER BY 1,2";
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
		$retobj["attributes"] = helpers::runQuery("select count(0) TotalRecordCount from proLocation");
		
		return $retobj;
	}


	
}

?>
