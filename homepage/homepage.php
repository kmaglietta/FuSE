<html>
    <head>
        <title>Admin</title>
        
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width">
        
         <!-- Normalize.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css" />
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
        
        <!------FontAwesome Script--------->
        <script src="https://use.fontawesome.com/3e15612180.js"></script> 
        
       <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        
        
        
        <!---Additional Styling---->
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

              <a class="navbar-brand" ui-sref="home"><img src="img/fau-home-logo.png"/></a>
              </div>

              <div class="collapse navbar-collapse navbar-right" id="js-navbar-collapse" uib-collapse="isNavCollapsed">

                <ul class="nav navbar-nav">
                  <li><a ui-sref="home">Home</a></li>
                  <!-- Profile page will double as a login page if not already logged in -->
                  <li ui-sref-active-eq="activeNav"><a ui-sref="login">Login</a></li>
                  <!-- Visible to both tutors and Admin -->
                  <li ui-sref-active-eq="activeNav"><a ui-sref="contact">Messages</a></li>
                </ul>
              </div>
            </div>
          </div>
    </div>
        
        
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
                
                                <!-----Available Tutors Table---------->
                
                
                
                <!-----Search Fields------->
                <div class="container-fluid" id="search">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#searchForm" id="formDropDownBtn">Click to Search Sessions</button>
                        </div>
                    </div>
                    
                    
                   <div class="row collapse" id="searchForm">
                        <div class="col-xs-12 text-center">
                            <form method="post">
                     
                                <div class="form-group">
                                    <label for="classname">Class:</label><br> 
                                    <input type="text" name="classname" class="form-control">
                                </div>
                                
                                
                                <div class="form-group">
                                     <label for="tutorname">Tutor:</label> <br>
                                    <input type="text" name="tutorname" class="form-control">
                                </div>

                                
                                <div class="form-group">
                                    <label for="date">Date:</label> <br>
                                    <input type="text" name="date" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="location">Location:</label><br> 
                                    <input type="text" name="tutorlocation" class="form-control">
                                </div>

                    

                                <button type="submit" name="button" class="btn btn-primary" id="searchTutors">Search Tutors</button>

    
                    
                            </form>
                       </div>     
                   </div>
                   
                </div>
                
                <div class="container-fluid" id="available">
                    <div class="row">
                       <div class="col-xs-12 text-center">
                            <h2>Live Sessions:</h2>
                        </div>
                    </div>

                </div>
                 
                 <div id="availabilityTable">
                
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
            
            <div class="footer" id="footer">
            </div>

           
        </div>
                       

    
           
        
    </body>
</html>