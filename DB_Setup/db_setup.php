<?php

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'test';   // Needs to be changed to your designated table database name
$dbuser = 'kmaglietta2013';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'PqEhBu57jb'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

if(!$db->query("SELECT * FROM pro_students")){
  $create = "create table pro_students(
    studentId int(11) not null auto_increment,
    userName varchar(50),
    password varchar(50),
    firstName varchar(50),
    lastName varchar(50),
    email varchar(50),
    phoneNumber int(11),
    favoriteTutor int(11),
    dateEntered timestamp,
    primary key (studentId),
    foreign key (favoriteTutor) references pro_tutors(tutorId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_students created ";
  }
}

//moved raiting to tutor
if(!$db->query("SELECT * FROM pro_tutors")){
  $create = "create table pro_tutors(
    tutorId int(11) not null auto_increment,
    studentId int(11),
    classId int(11),
    approvedOn datetime,
    approvedBy int(11),
    rating int(11),
    dateEntered timestamp,
    dateModified datetime,
    dateModifiedWho int(11),
    foreign key (studentId) references pro_students(studentId),
    foreign key (approvedBy) references pro_admin(adminId),
    primary key (tutorId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_tutors created ";
  }
}

if(!$db->query("SELECT * FROM pro_admins")){
  $create = "create table pro_admins(
    adminId int(11) not null auto_increment,
    userName varchar(50),
    password varchar(50),
    firstName varchar(50),
    lastName varchar(50),
    email varchar(50),
    dateEntered timestamp,
    primary key (adminId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_admins created ";
  }
}

if(!$db->query("SELECT * FROM pro_tutoringSession")){
  $create = "create table pro_tutoringSession(
    sessionId int(11) not null auto_increment,
    tutorId int(11),
    locationId int(11),
    sessionStartDate datetime,
    sessionEndDate datetime,
    cancled boolean,
    cancledBy int(11),
    dateCreated timestamp,
    dateModified datetime,
    dateModifiedWho int(11),
    primary key (sessionId),
    foreign key (tutorId) references pro_tutors(tutorId),
    foreign key (cancledBy) references pro_admins(adminId),
    foreign key (locationId) references pro_locations(locationId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_admins created ";
  }
}

if(!$db->query("SELECT * FROM pro_locations")){
  $create = "create table pro_locations(
    locationId int(11) not null auto_increment,
    buildingName varchar(50),
    roomNum varchar(50),
    requiresBooking boolean,
    multiBookingAllowed boolean,
    active boolean,
    approvedBy int(11),
    dateEntered datetime,
    primary key (locationId),
    foreign key (approvedBy) references pro_admin(adminId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_locations created ";
  }
}

if(!$db->query("SELECT * FROM pro_classInfo")){
  $create = "create table pro_classInfo(
    classId int(11),
    lab boolean,
    subject varchar(3),
    courseNum int(4),
    courseName varchar(50),
    approvedBy int(11),
    dateEntered timestamp,
    primary key (classId),
    foreign key (approvedBy) references pro_admins(adminId)
  )";

  if(!$db->query($create)){
    echo mysqli_error($db);
  }
  else{
    echo "pro_locations created ";
  }
}


?>
