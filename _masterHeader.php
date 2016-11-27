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
	<script type="text/javascript" src="/~jherna65/jquery/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/datatables.1.10.12/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/~jherna65/jquery/date.format.js"></script> 
	<script type="text/javascript" src="/~jherna65/jquery/jtable.2.4.0/jquery.jtable.js" ></script> 
	
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
			
			<a class="navbar-brand" href="/~jherna65/index.php"><img src="/~jherna65/images/fau-logo.png"/></a>
		  
              </div>

		<?php if(strpos($page, 'dashboard.php') == false) : ?>
		<div class="collapse navbar-collapse navbar-right" id="js-navbar-collapse" uib-collapse="isNavCollapsed">
			<ul class="nav navbar-nav">
				<li><a href="/~jherna65/index.php">Home</a></li>
				<!-- Profile page will double as a login page if not already logged in -->
				<li ui-sref-active-eq="activeNav"><a ui-sref="login">Login</a></li>
				<!-- Visible to both tutors and Admin -->
				<li ui-sref-active-eq="activeNav"><a ui-sref="contact">Messages</a></li>
			</ul>
		</div>
		<?php else : ?>
			<div style="float:right; color:white; font: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:2.2em; font-variant:normal;">Go Owl Tutor - LIVE SESSIONS</div>
		<?php endif; ?>
		  
		  
		  
            </div>
          </div>
    </div>
        
    <div> 
     
     
    	<?php if(strpos($page, 'dashboard.php') == false) : ?>
	<div style="padding:5px; display:inline-table; background-color:black;">
		&nbsp;&nbsp;<a href="directorAdministration.php">Administrators</a> 
		&nbsp;&nbsp;<a href="studentAdministration.php">Student Management</a> 
		&nbsp;&nbsp;<a href="locationAdministration.php">Location Management</a> 
		&nbsp;&nbsp;<a href="classinfoAdministration.php">Class Management</a> 
		&nbsp;&nbsp;<a href="tutorAdministration.php">Tutor Management</a> 
		&nbsp;&nbsp;<a href="classsessionAdministration.php">Tutoring Session Management</a> 
		
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="dashboard.php">Auto Cycle Dashboard</a> 
	</div>
	<?php endif; ?>
	
</div>    




