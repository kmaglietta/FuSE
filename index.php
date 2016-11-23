<?php include('_masterHeader.php');?>


<script>
$(document).ready(function() {
    $('#courses').DataTable( {
	    "ajax": {
			"url": "apiTest/?action=getlist",
			"type": "POST"
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

	"oLanguage": {
         "sSearch": "Search any field:"
       }

    } );

} );
</script>

<div class="makeresponsive">
	<h1 tyle="margin-left:auto; margin-right:auto; ">Welcome to Go Owl Tutor!</h1>
	<!--<img src="http://lamp.cse.fau.edu/~jstephen2014/homepage/img/owl-logo.png" alt="" >-->
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


<?php include('_masterFooter.php');?>
