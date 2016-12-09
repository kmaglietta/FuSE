<?php
 session_start();
 
// $username = 'admin@admin.com';
//$password = '12345';
//$isadmin = 'true';

require_once("apiTest/controllers/classes/helpers.php");

//var_dump($result);

 
  if(isset($_POST['btn-login']))
 {

  try
  { 

    	$username = trim($_POST['user_email']);
  	$password = trim($_POST['password']);
	if (isset($_POST['isadmin']))
 	$isadmin = trim($_POST['isadmin']);
  else 
  	$isadmin ='';
  
	$url = 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getuser&EmailAddress=';
	$url.= $username;
	$url.= '&Password=';
	$url.= $password;
	$url.= '&isAdmin=';
	if ($isadmin == 'on')
	$url.= 'true';
	else
	$url.= 'false';
	//$data = array('EmailAddress' => '$username', 'Password' => '$password', 'isAdmin' =>  'isadmin');
	
	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
		  //'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		  'method'  => 'POST'
		  //,'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	$jsonObj = array();
	$jsonObj = json_decode($result, true);
	
	$Record = array();
	$Record = $jsonObj['Record'];
	//$guiid = helpers::getArrayValue($obj['Record'],'guiid');
	
	//if ($result === FALSE) { echo "email or password does not exist."; }
	
//$result['Records']
 
 $guiid = $Record[0]['guiid'];
 $StudentID = $Record[0]['id'];
 $tutorId = $Record[0]['tutorid'];
 $AdminId = $Record[0]['id'];
 $isAdmin = $Record[0]['isAdmin'];
 $isStudent = $Record[0]['isStudent'];
 $isTutor = $Record[0]['isTutor'];
 
 
 
 
 
  
 
// var_dump($Record);
 
 if ($isAdmin == 1){
	 $_SESSION["isAdmin"] = 1;
	 $_SESSION["guiid"] = $guiid;
 	echo "1";
	return;
 }
if  ($isTutor == 1){
	 $_SESSION["isTutor"] = 1;
	 $_SESSION["isStudent"] = 1;
	  $_SESSION["StudentID"] = $StudentID;
	   $_SESSION["guiid"] = $guiid;
	echo "2" ;
	return;
}

if  ($isStudent == 1)
{	
	$_SESSION["isStudent"] = 1;
	 $_SESSION["StudentID"] =$StudentID;
	  $_SESSION["guiid"] = $guiid;
 	echo "3";
	return;
}
  else{
   throw "Error";
   }
    
  }
 // catch(PDOException $e){
catch (Exception $e)	{  
   //echo $e->getMessage();
    session_unset();
    session_destroy();
    echo "email or password does not exist."; // wrong details 
  }
  
  
 };
 

?>






















