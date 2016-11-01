<?php
require_once 'db_connect.php';
require_once 'functions.php';


$userErr = "";
$passErr = "";


session_start();
if(isset($_SESSION['name'])){
    $user = $_SESSION['name'];
    session_destroy();
    header('Location: homepage.html');
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if there is valid info in the feilds
    if(!empty($_POST["email"])) {
        $USER_ID = test_input($_POST["USER_ID"]);
        $error = FALSE;
    } else{ $userErr = "name required"; $error = TRUE;}
    if(!empty($_POST["password"])) {
        $PASSWORD = test_input($_POST["PASSWORD"]);
        $error = FALSE;
    } else { $passErr = "password required"; $error = TRUE;}
    //if there were no errors attempt to login
    if(!$error){
        //call function attempt_login then set the seesion and load the wall attempt_login($db, $USER_ID, $PASSWORD
        if(TRUE){
             $_SESSION['name'] = $USER_ID;
             $_SESSION['pass'] = $PASSWORD;
             header('Location: homepage.html');
             session_destroy();
         } else{ echo "Username or Password is incorect"; }
        //$PASSWORD = encrypt($PASSWORD);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Blackboard Learn</title>
    <script src="https://use.fontawesome.com/3e15612180.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--Additional styling -->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/functions.js"></script>
    </head>


    <body>
        <div id="wrap">
            <div id="main">
                <!-- Navigation -->
                <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                        </button>
                        <img src="img/fau-home-logo.png" height="85px" width="200px">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="intro-text">
                                    <h1>Log In</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-----Log in Form------->
                    <form class="login" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="row">
                                  <div class="col-sm-4"></div>
                                  <div class="col-sm-4">
                                      <label for="email">Email</lable>
                                      <input type="email" name="email" id="email" placeholder="example@fau.edu">
                                      <span class="error"><?php echo $userErr;?></span><br>
                                      <label for="password">Password</lable>
                                      <input type="password" name="password" id="password">
                                      <span class="error"><?php echo $passErr;?></span><br>
                                  </div>
                                  <div class="col-sm-4"></div>
                              </div>
                            <div class="row">
                                <div class="span2 offset3 text-center">
                                    <button type="submit" name="button" class="btn btn-primary" onclick="search();">Log In</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="footer">

        </div>
    </body>
</html>
