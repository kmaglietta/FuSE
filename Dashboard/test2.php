<!DOCTYPE html>
<html>
    <head>
        <title>GOT - Go Owl Tutor!</title>
        


<!-- adjsut for media viewgin -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, user-scalable=0">
<script type="text/javascript">
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



<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>       
<link rel="stylesheet" type="text/css" href="datatable.css">



        
        
        <!---Additional Styling---->
        <link rel="stylesheet" type="text/css" href="style.css">

		     
<script>
$(document).ready(function() {
 
       /* var max = oTable.fnPagingInfo().iTotalPages;
        var ctr=0; // DEFAULT VALUE OF CTR
        setInterval(function(){
        if (ctr < max){
        oTable.fnPageChange( 'next' );
        ctr=ctr+1; // INCREASE VALUE OF CTR
        }
        else{
        oTable.fnPageChange( 'first' );
        ctr=0; // RESETS THE VALUE OF CTR TO 0
        }
        },1000); */
    
    
    
        
       /* setInterval(function() {
            if(table.page() + 1 === table.page.len()) {
                table.page('first');
            } else {
                table.page('next');
            }
            table.draw('page');
        }, 1000); */

    

    var table = $('#courses').DataTable( {
//	 "ajax": "arrays.txt"
	    "ajax": {
			"url": "http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getlist",
			"type": "POST",
		  	}
	  , "columns": [	
		  { "data": 'class' },
		  { "data": 'coursename' },
		  { "data": 'name' },
		  { "data": 'location' },
		  { "data": 'starttime' },
		  { "data": 'endtime' }
	    ]
	, "deferRender": true,
        
 
    
    "sDom" : 'rt',
	
	"oLanguage": {
         "sSearch": "Search any field:"
       },
    
    

    } );
    
    setInterval(function() {
            
            if(table.page() === table.page('last').page()) {
                table.page('first');
            } else {
                table.page('next');
            }
            table.draw('page');
        }, 2000); 

    
       
} );
</script>



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

              <a class="navbar-brand" ui-sref="home"><img src="images/fau-logo.png"/></a>
              </div>

              <div class="collapse navbar-collapse navbar-right" id="js-navbar-collapse" uib-collapse="isNavCollapsed">

               
              </div>
            </div>
          </div>
    </div>
        
        
<div class="makeresponsive">
	<h1 tyle="margin-left:auto; margin-right:auto; ">Welcome to Go Owl Tutor!</h1>
	
</div>	   
	<hr class="star-primary">      

	<div class="col-xs-12 text-center">
	    <h2>Live Sessions</h2>
	</div>

<div class="listtable">
	<table width="100%" id="courses" class="display " cellspacing="0">
	  <thead>
		<tr>
		    <th>Class</th>
		    <th>Course Name</th>
		    <th>Tutor Name</th>
		    <th>Location</th>
		    <th>Start Time</th>
		    <th>End Time</th>
		</tr>
	  </thead>
	</table>
</div>			     
		

<br><br>
                       

    
           
        
    </body>
</html>