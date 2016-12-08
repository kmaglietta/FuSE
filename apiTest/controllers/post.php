<?php
require_once("classes/dataDirector.php");
require_once("classes/dataClassinfo.php");
require_once("classes/dataLocation.php");
require_once("classes/dataMain.php");
require_once("classes/dataStudent.php");
require_once("classes/dataTutor.php");
require_once("classes/dataClasssession.php");



class post
{
	
	public function addDirectorAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->addAction($data,$params); }
	public function updateDirectorAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->updateAction($data,$params); }
	public function deleteDirectorAction($data,$params) 	{ $dataClass = new dataDirector(); 	return $dataClass->deleteAction($data,$params); }
	public function getDirectorsAction($data,$params)	{ $dataClass = new dataDirector(); 	return $dataClass->getAction($data,$params);  }	
	public function getDirectornamesAction($data,$params) { $dataClass = new dataDirector(); 	return $dataClass->getnamesAction($data,$params);  }	
	
	public function addClassinfoAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->addAction($data,$params); }
	public function updateClassinfoAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->updateAction($data,$params); }
	public function deleteClassinfoAction($data,$params) 	{ $dataClass = new dataClassinfo(); return $dataClass->deleteAction($data,$params); }
	public function getClassinfosAction($data,$params)	{ $dataClass = new dataClassinfo(); return $dataClass->getAction($data,$params); }	
	public function getClassinfonamesAction($data,$params){ $dataClass = new dataClassinfo(); return $dataClass->getnamesAction($data,$params);  }	

	
	public function addLocationAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->addAction($data,$params); }
	public function updateLocationAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->updateAction($data,$params); }
	public function deleteLocationAction($data,$params) 	{ $dataClass = new dataLocation(); 	return $dataClass->deleteAction($data,$params); }
	public function getLocationsAction($data,$params)	{ $dataClass = new dataLocation(); 	return $dataClass->getAction($data,$params); }
	public function getLocationnamesAction($data,$params) { $dataClass = new dataLocation(); return $dataClass->getnamesAction($data,$params);  }	

	public function addStudentAction($data,$params)		{ $dataClass = new dataStudent(); 	return $dataClass->addAction($data,$params); }
	public function updateStudentAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->updateAction($data,$params); }
	public function deleteStudentAction($data,$params) 	{ $dataClass = new dataStudent(); 	return $dataClass->deleteAction($data,$params); }
	public function getStudentsAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->getAction($data,$params); }	
	public function getStudentnamesAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->getnamesAction($data,$params);  }	
	public function getstudentclassesAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->getstudentclassesAction($data,$params);  }	
	public function getstudentprofileAction($data,$params)	{ $dataClass = new dataStudent(); 	return $dataClass->getstudentprofileAction($data,$params);  }	
	public function getuserAction($data,$params)		{ $dataClass = new dataStudent(); 	return $dataClass->getuserAction($data,$params); }
	


	public function addTutorAction($data,$params)		{ $dataClass = new dataTutor(); 	return $dataClass->addAction($data,$params); }
	public function updateTutorAction($data,$params)	{ $dataClass = new dataTutor(); 	return $dataClass->updateAction($data,$params); }
	public function deleteTutorAction($data,$params) 	{ $dataClass = new dataTutor(); 	return $dataClass->deleteAction($data,$params); }
	public function getTutorsAction($data,$params)		{ $dataClass = new dataTutor(); 	return $dataClass->getAction($data,$params); }	
	public function getTutornamesAction($data,$params)	{ $dataClass = new dataTutor(); 	return $dataClass->getnamesAction($data,$params);  }	
	
	public function getProfileAction($data,$params)		{ $dataClass = new dataTutor(); 	return $dataClass->getprofileAction($data,$params);  }	
	public function getTutorclassesAction($data,$params)	{ $dataClass = new dataTutor(); 	return $dataClass->gettutorclassesAction($data,$params);  }	
	

	
	
	
	
	public function addClasssessionAction($data,$params)		{ $dataClass = new dataClasssession(); 	return $dataClass->addAction($data,$params); }
	public function updateClasssessionAction($data,$params)	{ $dataClass = new dataClasssession(); 	return $dataClass->updateAction($data,$params); }
	public function deleteClasssessionAction($data,$params) 	{ $dataClass = new dataClasssession(); 	return $dataClass->deleteAction($data,$params); }
	public function getClasssessionAction($data,$params)		{ $dataClass = new dataClasssession(); 	return $dataClass->getAction($data,$params); }	

	public function gettutoredlistAction($data,$params)		{ $dataClass = new dataClasssession(); 	return $dataClass->gettutoredlistAction($data,$params); }	


	public function getlistAction($data,$params)		{ $dataClass = new dataMain(); 		return $dataClass->getlistAction($data,$params); }
	public function getdashboardlistAction($data,$params)	{ $dataClass = new dataMain(); 		return $dataClass->getdashboardlistAction($data,$params); }

	

}

?>