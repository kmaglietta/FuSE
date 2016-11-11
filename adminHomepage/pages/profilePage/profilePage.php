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
        
        
        <div class="header" ng-controller="NavCtrl">
          <div class="navbar navbar-default navbar-custom" role="navigation">
            <div class="container">
              <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" ng-click="isNavCollapsed = !isNavCollapsed"
                data-toggle="collapse" data-target="#js-navbar-collapse" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

              <a class="navbar-brand" ui-sref="home"><img src="img/fau-home-logo.png" id="navbarLogo"/></a>
              </div>

              <div class="collapse navbar-collapse navbar-right" id="js-navbar-collapse" uib-collapse="isNavCollapsed">

                <ul class="nav navbar-nav">
                  <li><a ui-sref="home" href="#">Home</a></li>
                  <!-- Profile page will double as a login page if not already logged in -->
                  <li ui-sref-active-eq="activeNav"><a ui-sref="login">Login</a></li>
                  <!-- Visible to both tutors and Admin -->
                  <li ui-sref-active-eq="activeNav"><a ui-sref="contact">Messages</a></li>
                  <!-- Visible to Admin only -->
                  <li ui-sref-active-eq="activeNav"><a ui-sref="dashboard" href="../editTutorPage/editTutorPage.php">Edit Tutors</a></li>
                  <li ui-sref-active-eq="activeNav"><a ui-sref="analytics">Analytics</a></li>
                </ul>
              </div>
            </div>
          </div>
    </div>
        
        
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
            
            
            
            
            <div class="footer" id="footer">
            </div>
            

                
        </div>
    </body>
</html>