<html>
    <head>
        <title>Admin</title>
        
        <!------FontAwesome Script--------->
        <script src="https://use.fontawesome.com/3e15612180.js"></script> 
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        
        
        <!---Additional Styling---->
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
    <body>
        <div class="container" id="header">
            <img src="img/fau-logo.png">
        </div>
        
        
        <nav class="navbar navbar-inverse sidebar" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Admin Hub</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active navbutton" id="homePage"><a href="#">Home<span  class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                        <li class="navbutton" id="messagePage"><a href="#">Messages<span class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                        <li class="navbutton" id="editTutors"><a href="../editTutorPage/editTutorPage.php">Edit Tutors<span class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span></a></li>
                        <li class="navbutton" id="analytics"><a href="#">Analytics<span class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        
        <div class="main">
            <!-- Content Here -->
            <div class="container content" id="homePageDiv">
                
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
                
                
                <!-----Search Fields------->
                <div class="container-fluid" id="search">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="searchHeading">Find a Tutor:</h2>
                        </div>
                    </div>

                    <form>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    Class: <input type="text" name="classname">
                                </div>
                                <div class="col-sm-3">
                                    Tutor: <input type="text" name="tutorname">
                                </div>
                                <div class="col-sm-3">
                                    Date: <input type="text" name="date">
                                </div>
                                <div class="col-sm-3">
                                    Location: <input type="text" name="tutorlocation">
                                </div>
                            </div>

                            <div class="row">
                                <div class="span2 offset3 text-center">
                                    <button type="submit" name="button" class="btn btn-primary" id="searchTutors">Search Tutors</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-----Available Tutors Table---------->
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
                       


           
                
        
    </body>
</html>