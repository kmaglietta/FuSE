<?php 
$page = $_SERVER['REQUEST_URI'];
?>
	
<!DOCTYPE html>
<html>
    <head>
        <title>GOT - Go Owl Tutor!</title>
        


<!-- adjsut for media viewgin -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, user-scalable=0">
<script  >
    if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
        var viewportmeta = document.querySelector('meta[name="viewport"]');
        if (viewportmeta) {
            viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0';
            document.body.addEventListener('gesturestart', function () {
                viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
            }, false);
        }
    }
</script>


<!--
DataTables | https://datatables.net
Copyright (C) 2008-2016, SpryMedia Ltd.
https://datatables.net/license/mit


PHPPOT | http://phppot.com/
Use samples and references
-->



 






	
	<!-- jQuery library -->
	<script type="text/javascript" src="/~jherna65/jquery/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui-timepicker-addon-i18n.min.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui-sliderAccess.js"></script>
	
	
	
	<script type="text/javascript" src="/~jherna65/jquery/datatables.1.10.12/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/date.format.js"></script> 
	<script type="text/javascript" src="/~jherna65/jquery/jtable.2.4.0/jquery.jtable.js" ></script> 
	
<script type="text/javascript" src="/~jherna65/jquery/jquery.validationEngine.js"></script>
<script type="text/javascript" src="/~jherna65/jquery/jquery.validationEngine-en.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/~jherna65/styles/jquery-ui-timepicker-addon.css">
	<link rel="stylesheet" type="text/css" href="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="/~jherna65/styles/datatable.css">

	<!-- Normalize.css -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



	<script type="text/javascript" src="/~jherna65/jquery/action.js" ></script>
	<link rel="stylesheet" type="text/css" href="/~jherna65/styles/style.css">
	<link rel="stylesheet" type="text/css" href="/~jherna65/jquery/jtable.2.4.0/themes/lightcolor/blue/jtable.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>

	
    </head>
    
    <body>
    

    
        <div class="header" ng-controller="NavCtrl">
          <div class="navbar navbar-default navbar-custom" role="navigation">
            <div class="container">
              <div class="navbar-header">

			<?php if(strpos($page, 'dashboard.php') == false) : ?>
			<button type="button" class="navbar-toggle collapsed" ng-click="isNavCollapsed = !isNavCollapsed" data-toggle="collapse" data-target="#js-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php endif; ?>
			<!--- class="navbar-brand" --->
			<a  href="/~jherna65/index.php"><img src="/~jherna65/images/fau-logo.png" class="logo"/></a>
		  
              </div>

		<?php if(strpos($page, 'dashboard.php') == false) : ?>
		<div class="collapse navbar-collapse navbar-right" id="js-navbar-collapse" uib-collapse="isNavCollapsed">
			<ul class="nav navbar-nav">
				<li><a href="/~jherna65/index.php">Home</a></li>
				<li><a ui-sref="login">Login</a></li>
				<li><a href="/~jherna65/dashboard.php">Dashboard</a></li>
			</ul>
		</div>
		<?php else : ?>
			<div style=" color:white; font: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:1.8em; font-variant:normal; padding-top:10px; text-align:right;">Go Owl Tutor - LIVE SESSIONS</div>
		<?php endif; ?>
		  
		  
		  
            </div>
          </div>
    </div>
        
    <div> 
     
    	<?php if(strpos($page, 'dashboard.php') == false) : ?>
     <style>
     		#nav2 {
		padding: 0;
		width: 100%;
		float: left;
		margin: 0px auto 0px auto;
		list-style: none;
		background-color: #f2f2f2;
		border-bottom: 2px solid #f2f2f2; 
		border-top: 1px solid #ccc; }
	    #nav {
		padding: 0;
		width: 100%;
		float: left;
		/*margin: -20px auto 10px auto;*/
		margin: -20px auto 0 auto;
		list-style: none;
		background-color: #f2f2f2;
		border-bottom: 2px solid #f2f2f2; 
		border-top: 1px solid #ccc; }
	#nav li ,#nav2 li {
		float: right; }
	#nav li a,#nav2 li a {
		display: block;
		padding: 5px 20px;
		text-decoration: none;
		font-weight: bold;
		color: #069;
		border-right: 1px solid #ccc; 
		font-size:13px;
		}
	#nav li a:hover,#nav2 li a:hover {
		color: #c00;
		background-color: #fff; }
     </style>
	<ul id="nav">
		<li>ADMIN MENU</li>
		<li><a href="directorAdministration.php">Administrators</a></li>
		<li><a href="classsessionAdministration.php">Tutoring Session</a></li>
		<li><a href="locationAdministration.php">Locations</a></li>
		<li><a href="classinfoAdministration.php">Classes</a></li>
		<li><a href="tutorAdministration.php">Tutor</a></li>
		<li><a href="studentAdministration.php">Students</a></li>
		<!--<li><a href="dashboard.php">Auto Cycle Dashboard</a></li>-->
		
	</ul>
	<ul id="nav2">
		<li>TUTOR MENU</li>
		<li><a href="reviewSessions.php">Review my Tutoring Sessions</a></li>
		<li><a href="sessionSelectStudents.php">Add Student to Session</a></li>
		
	</ul>
	<ul id="nav2">
		<li>STUDENT MENU</li>
		<li><a href="sessionsAttended.php">See my attended Classes</a></li>
		
	</ul>
	<ul id="nav2">
		<li>ALL MENU</li>
		<li><a href="tutorProfiles.php">Tutor Profiles</a></li>
		<li><a href="dashboard.php">Auto Cycle Dashboard</a></li>
	</ul>
	
	
	<br>
	<?php endif; ?>
	
</div>    




