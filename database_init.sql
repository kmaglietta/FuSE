---------------------------------------------------
--proAdministrators
---------------------------------------------------
CREATE TABLE proAdministrators (
	AdminId INT (11) NOT NULL auto_increment
	, FirstName VARCHAR(50)
	, LastName VARCHAR(50)
	, Password VARCHAR(50)
	, EmailAddress VARCHAR(50)
	, DateEntered TIMESTAMP
	, PRIMARY KEY (AdminId)
	);

---------------------------------------------------
--proClassInfo
---------------------------------------------------
CREATE TABLE proClassInfo (
	ClassId INT (11)
	, Lab boolean
	, Subject VARCHAR(3)
	, CourseNummber INT (4)
	, CourseName VARCHAR(50)
	, ApprovedBy INT (11)
	, DateEntered TIMESTAMP
	, PRIMARY KEY (ClassId)
	, FOREIGN KEY (ApprovedBy) REFERENCES proAdministrators(AdminId)
	);

---------------------------------------------------
--proLocation
---------------------------------------------------
CREATE TABLE proLocation (
	LocationId INT (11) NOT NULL auto_increment
	, BuildingName VARCHAR(50)
	, RoomNumber VARCHAR(50)
	, RequiresBooking boolean
	, MultiBookingAllowed boolean
	, Active boolean
	, ApprovedBy INT (11)
	, DateEntered DATETIME
	, PRIMARY KEY (LocationId)
	, FOREIGN KEY (approvedBy) REFERENCES proAdministrator(AdminId)
	);

---------------------------------------------------
--proStudent
---------------------------------------------------
CREATE TABLE proStudent (
	StudentId INT (11) NOT NULL auto_increment
	, FirstName VARCHAR(50)
	, LastName VARCHAR(50)
	, Password VARCHAR(50)
	, EmailAddress VARCHAR(50)
	, ContactPhone VARCHAR(10)
	, DateEntered TIMESTAMP
	, PRIMARY KEY (StudentId)
	,
	);

---------------------------------------------------
--proTutor
---------------------------------------------------
CREATE TABLE proTutor (
	TutorId INT (11) NOT NULL auto_increment
	, StudentId INT (11)
	, ClassId INT (11)
	, ApprovedOn DATETIME
	, ApprovedByAdmin INT (11)
	, DateEntered TIMESTAMP
	, DateModified DATETIME
	, DateModifiedWho INT (11)
	, FOREIGN KEY (StudentId) REFERENCES prostudents(StudentId)
	, FOREIGN KEY (ApprovedByAdmin) REFERENCES proAdministrator(AdminId)
	, PRIMARY KEY (TutorId)
	);

---------------------------------------------------
--proTutoringSession
---------------------------------------------------
CREATE TABLE proTutoringSession (
	SessionId INT (11) NOT NULL auto_increment
	, TutorId INT (11)
	, LocationId INT (11)
	, SessionStartDate DATETIME
	, SessionEndDate DATETIME
	, Completed boolean
	, Cancled boolean
	, CancledByAdminId INT (11)
	, CancledByTutorId INT (11)
	, DateCreated TIMESTAMP
	, DateModified DATETIME
	, DateModifiedWho INT (11)
	, PRIMARY KEY (SessionId)
	, FOREIGN KEY (TutorId) REFERENCES protutors(TutorId)
	, FOREIGN KEY (cancledByAdminId) REFERENCES proAdministrators(AdminId)
	, FOREIGN KEY (cancledByTutuorId) REFERENCES protutors(TutorId)
	, FOREIGN KEY (LocationId) REFERENCES prolocations(LocationId)
	);

---------------------------------------------------
--protutoringSessionStudents
---------------------------------------------------
CREATE TABLE protutoringSessionStudents (
	TssId INT (11)
	, SessionId INT (11)
	, StudentId INT (11)
	, CompletedTutoring boolean
	, StudentRating INT (11)
	, StudentRatingComment VARCHAR(500)
	, StudentRatingDate DATETIME
	, DateCreated TIMESTAMP
	, FOREIGN KEY (StudentId) REFERENCES pro(AdminId)
	);
