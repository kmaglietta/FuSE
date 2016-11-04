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
        
        <script src="javascript/script.js"></script>
        
        <!---Additional Styling---->
        <meta name="viewport" content ="width=device-width,initial-scale=1.0,user-scalable=yes" />
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
                        <li class="active navbutton" id="homePage"><a href="../homepage/homepage.php">Home<span  class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                        <li class="navbutton" id="messagePage"><a href="#">Messages<span class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                        <li class="navbutton" id="editTutors"><a href="../editTutorPage/editTutorPage.php">Edit Tutor Profiles<span class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span></a></li>
                        <li class="navbutton" id="analytics"><a href="#">Analytics<span class="pull-right hidden-xs showopacity glyphicon glyphicon-stats"></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        
        <div class="main">
            <!-- Content Here -->
            
            
            
            <div class="container content" id="profilePagesDiv">
                <div class="container well profile">
                    <div class="row">
                        
                            
                                <div class="col-xs-12">
                                    <div class="col-xs-12 col-xs-8">
                                        <h2><span class="info" id="name"><span>First name Last name</span></span></h2>
                                        <p><strong>About: </strong> <span class="info"><span>Admin</span></span> </p>
                                        <p><strong>Hobbies: </strong> <span class="info"><span>Reading, video games, programming</span></span> </p>
                                        <p><strong>Classes:</strong>
                                            <span>
                                            <span class="tags">MAC 2311</span> 
                                            <span class="tags">COP 3813</span>
                                            <span class="tags">MAC 2312</span>
                                            </span>
                                        </p>
                                         <button type="button" class="btn btn-primary" id="editBtn">Edit</button>
                                    </div>             
                                    <div class="col-xs-12 col-xs-4 text-center">
                                        <figure>
                                            <img src="img/owl-logo.png" alt="" class="img-responsive">
                                            <figcaption class="ratings">
                                                <p>Ratings
                                                <a href="#">
                                                    <span class="fa fa-star"></span>
                                                </a>
                                                <a href="#">
                                                    <span class="fa fa-star"></span>
                                                </a>
                                                <a href="#">
                                                    <span class="fa fa-star"></span>
                                                </a>
                                                <a href="#">
                                                    <span class="fa fa-star"></span>
                                                </a>
                                                <a href="#">
                                                     <span class="fa fa-star-o"></span>
                                                </a> 
                                                </p>
                                            </figcaption>
                                        </figure>
                                    </div>
                                
                                </div>            
                               
                                        
                    
                    </div>
                    <div class="row">
                        <div class="container-fluid" id="available">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h2>Schedule:</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row" id="table">
      
                             <div class="rTable">
                                         <div class=" rTableHeading">
                                            <div class="rTableHead">Classes</div>
                                            <div class="rTableHead">Tutor</div>
                                            <div class="rTableHead">Time</div>
                                            <div class="rTableHead">Location</div>
                                        </div>
                                        <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                         <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                       <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                        <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                        <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                        <div class="rTableRow">
                                            <div class="rTableCell">ClassName</div>
                                            <div class="rTableCell"><a href="../profilePage/profilePage.php">TutorName</a></div>
                                            <div class="rTableCell">12:00pm</div>
                                            <div class="rTableCell">GS 2XX</div>
                                            </div>
                                </div>

                        </div>
                </div>
            </div>
            
            
            
            
            
            

                
        </div>
    </body>
</html>