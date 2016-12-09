<?php include('_masterHeader.php');?>

 
<script>
 $(document).ready(function() {
   var table = $('#courses').DataTable( {
	    "ajax": {
			"url": "apiTest/?action=getlist",
			"type": "POST"
		  	}
	  , "columns": [
	  	  { "data": 'SessionStartTime', 'visible': false, 'searchable': false,},
		  { "data": 'class' },
		  { "data": 'coursename' },
		  { "data": 'name' },
		  { "data": 'location' },
		  { "data": 'date' },
		  { "data": 'starttime' },
		  { "data": 'endtime' },
		  { "data": 'status' , 
             	render: function ( data, type, row ) {
              		return '<div class="' + data.toLowerCase() + '">' + data + '</div>';
            	}
		  }
		  ,
		  { "data": 'studentid' , 
             	render: function ( data, type, row ) {
              		return '<a href="/~jherna65/tutorProfile.php?studentid='+data+'"><img src="/~jherna65/images/user-id-32.png" width="32" height="32" alt=""/></a>';
            	}
		}

	    ]
	, "order": [[0,'asc'],[1,'asc'] ]
	, "deferRender": true,

	"oLanguage": {
         "sSearch": "Search any field:"
	   , "sEmptyTable": "No Sessions are available at this time..."
	   ,  "sZeroRecords": "No Sessions are available at this time..."
       },
	 "language": {
		"emptyTable": "No Sessions are available at this time..."
		, "zeroRecords": "No Sessions are available at this time..."
	    }


    } );
    
        setInterval( function () {
		    table.ajax.reload( null, false ); // user paging is not reset on reload
		}, 10000 );


});   

        //table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        //var data = this.data();        
        //console.log(data);
        
	  //table.ajax.reload( null, false );
        //data[0] = '*ddddd ' + data[0];
        //this.data(data);
    //});




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
			<th></th>
		    <th>Class</th>
		    <th>Course Name</th>
		    <th>Tutor Name</th>
		    <th>Location</th>
		    <th>Date</th>
		    <th>Start Time</th>
		    <th>End Time</th>
		    <th>Status</th>
		    <th>View Profile</th>
		</tr>
	  </thead>
	</table>
</div>


<?php include('_masterFooter.php');?>
