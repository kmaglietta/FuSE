
<?
try
{
	$con = new mysqli("localhost","databaseName","userName","password");
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>


<!DOCTYPE html>
<html><head>
    <title>concat (Subject , ' ', CourseNumber, ' - ', CourseName) Courses</title>
   
    <script src="https://use.fontawesome.com/3e15612180.js"></script>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    
    <link type="text/css" rel="stylesheet" href="http://lamp.cse.fau.edu/~jstephen2014/homepage/css/style.css">
    <script type="text/javascript" src="http://lamp.cse.fau.edu/~jstephen2014/homepage/javascript/script.js"></script>

    <style>
		header {clear:both; margin-top:200px;}
		#headerlogo img { margin:10px;}
		.dform label {padding-right:5px;}
	
		
		.rTable {
		    	display: table;
		    	width: 80%;
				margin-left:auto;
				margin-right:auto; 
				color:white;
		}
		.rTableRow {
		    	display: table-row;
				transition: background 0.2s ease-in;
				background: rgb(44,52,70);
								
		}
		.rTableRow:nth-child(odd) {
			background: rgb(50,60,80);
		}
		.rTableRow:hover {
		    	background:#EEF331;
				color:#725F00;
				
		}
		

		.rTableCell, .rTableHead {
		    	display: table-cell;
		    	padding: 3px 10px;
		    	border: 0;
				line-height:3em;
		}
		.rTableHeading {
		    	display: table-header-group;
		    	background-color: #003366;
				color: white;
		    	font-weight: bold;
				text-align:center;
		}
		.rTableFoot {
		    	display: table-footer-group;
		    	font-weight: bold;
		    	background-color: #ddd;
		}
		.rTableBody {
		    	display: table-row-group;
		}
		
		
		@media screen and (max-width: 755px) {
			header {margin-top:100px;}
			.container {width:500px;

			}
			.intro-text h1{ font-size:smaller}
			 [class*="col-"] {
				width: 100%;
			}
			.rTable {
		    	width: 500px;
				margin-left:auto;
				margin-right:auto;
			}
			.img-responsive {
				width: 300px;
   				 height: auto;
			}
			header { padding:5px;}
			
			.fixed {display: table; width:300px;margin-left:auto;
				margin-right:auto; }
	.fixed .col-sm-3{display:table-row}
	.fixed label, .fixed input {display: table-cell;}
			
		}
		@media screen and (max-width: 500px) {
			.container {width:350px;

			}

			 [class*="col-"] {
				width: 100%;
			}
			.rTable {
		    	width: 340px;
				margin-left:auto;
				margin-right:auto;
			}
	
		}
		
		


	</style>
    
    
    </head>
    
    
    <body>
        <div id="wrap">
            <div id="main">
                <!-- Navigation -->
                <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header page-scroll" id="headerlogo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                        </button>
                        <img src="http://lamp.cse.fau.edu/~jstephen2014/homepage/img/fau-home-logo.png" height="85px" width="200px">
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li class="page-scroll">
                                <a>Home</a>
                            </li>
                            <li class="page-scroll">
                                <a>Profile</a>
                            </li>
                            <li class="page-scroll">
                                <a>Login</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
                </nav>

                <!-- Intro Header -->
                <header>
                 
                     
                            <div class="col-lg-12">
                                <div class="intro-text">
                                    <h1>Welcome to Go Owl Tutor!</h1>
                                </div>
                                <img class="img-responsive" src="http://lamp.cse.fau.edu/~jstephen2014/homepage/img/owl-logo.png" alt="">
                                <hr class="star-primary">
                            </div>
                   
                 
                </header>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         $("#classname").select2();
		 $("#tutorname").select2();
    });
</script>

                <!-----Search Fields------->
                <div class="container-fluid" id="search">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Find a Tutor:</h2>
                        </div>
                    </div>

                    <form>
                    <div class="dform">
                        <div class="container">
                            <div class="row fixed">
                                <div class="col-sm-3"><label for="classname">Class: </label>
                                
                                <? 
								if ($result = $con->query("select concat (Subject , ' ', CourseNumber, ' - ', CourseName) Courses from proClassInformation order by 1")) {
									/*printf("Select returned %d rows.\n", $result->num_rows); */
									//$num = mysqli_num_rows($result);
									//$i=0;
									//while ($i < $num) {
									echo '<select id="classname" style="width:200px;">';
									echo '<option value="" ></option>';
									while ($row = mysqli_fetch_array($result)) {
									//	$name=mysqli_result($result,$i,"Courses");
										echo '<option value="'.$row['Courses'].'">'.$row['Courses'].'</option>';
									}
									echo '</select>';
									
									$result->close();
								}
								?>
                                
                                
                                </div>
                                <div class="col-sm-3"><label for="classname">Tutor: </label>
                                
                                 <? 
								if ($result = $con->query("SELECT 
													distinct
													concat(s.firstname, ' ', s.lastname) names
													 FROM proTutor t
													inner join proStudent s on t.studentid = s.studentid order by 1")) {
									/*printf("Select returned %d rows.\n", $result->num_rows); */
									//$num = mysqli_num_rows($result);
									//$i=0;
									//while ($i < $num) {
									echo '<select id="tutorname" style="width:200px;">';
									echo '<option value="" ></option>';
									while ($row = mysqli_fetch_array($result)) {
									//	$name=mysqli_result($result,$i,"Courses");
										echo '<option value="'.$row['names'].'">'.$row['names'].'</option>';
									}
									echo '</select>';
									
									$result->close();
								}
								?>
                                
                                
                                </div>
                                <div class="col-sm-3"><label for="classname">Date: </label><input type="text" name="date"></div>
                                <div class="col-sm-3"><label for="classname">Location: </label><input type="text" name="tutorlocation"></div>
                            </div>

                            <div class="row">
                                <div class="span2 offset3 text-center">
                                    <button type="submit" name="button" class="btn btn-primary">Search Tutors</button>
                                </div>
                            </div>
                        </div>
                       </div>
                    </form>

                </div>

                <!-----Available Tutors----->
                <div class="container-fluid" id="available">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Tutors Available Now:</h2>
                        </div>
                    </div>


                  

                </div>
                
                <div class="rHTable">
                
                 <div class="rTable">
                             <div class=" rTableHeading">
                                <div class="rTableHead">Classes</div>
                                <div class="rTableHead">Tutor</div>
                                <div class="rTableHead">Time</div>
                                <div class="rTableHead">Location</div>
                            </div>
                            <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
                             <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
                             <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
                         <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
                         <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
                         <div class="rTableRow">
                                <div class="rTableCell">ClassName</div>
                                <div class="rTableCell">TutorName</div>
                                <div class="rTableCell">12:00pm</div>
                                <div class="rTableCell">GS 2XX</div>
                            </div>
 
                    </div>
                    </div>
                
                
            </div>
        </div>
        <div id="footer">

        </div>



    </body>
</html>