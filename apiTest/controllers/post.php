<?php
require_once("classes/dataDirector.php");
require_once("classes/dataClassinfo.php");
require_once("classes/dataLocation.php");
require_once("classes/dataMain.php");
require_once("classes/dataStudent.php");



class post
{
	
	public function addDirectorAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->addAction($data,$params); }
	public function updateDirectorAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->updateAction($data,$params); }
	public function deleteDirectorAction($data,$params) 	{ $dataClass = new dataDirector(); 	return $dataClass->deleteAction($data,$params); }
	public function getDirectorsAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->getAction($data,$params);  }	
	public function getDirectornamesAction($data,$params){ $dataClass = new dataDirector(); 	return $dataClass->getnamesAction($data,$params);  }	
	
	public function addClassinfoAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->addAction($data,$params); }
	public function updateClassinfoAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->updateAction($data,$params); }
	public function deleteClassinfoAction($data,$params) 	{ $dataClass = new dataClassinfo(); return $dataClass->deleteAction($data,$params); }
	public function getClassinfosAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->getAction($data,$params); }	

	
	public function addLocationAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->addAction($data,$params); }
	public function updateLocationAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->updateAction($data,$params); }
	public function deleteLocationAction($data,$params) 	{ $dataClass = new dataLocation(); 	return $dataClass->deleteAction($data,$params); }
	public function getLocationsAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->getAction($data,$params); }

	public function addStudentAction($data,$params)		{ $dataClass = new dataStudent(); 	return $dataClass->addAction($data,$params); }
	public function updateStudentAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->updateAction($data,$params); }
	public function deleteStudentAction($data,$params) 	{ $dataClass = new dataStudent(); 	return $dataClass->deleteAction($data,$params); }
	public function getStudentsAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->getAction($data,$params); }	
	
	
	
	

	public function getlistAction($data,$params)		{ $dataClass = new dataMain(); 		return $dataClass->getlistAction($data,$params); }
	
	
	

}

?>