<?php include('_masterHeader.php');?>


<script>
$(document).ready(function() {
	
	//alert($.fn.dataTable.version);
 
/* table ************ */
    var table = $('#courses').DataTable( {
	    "ajax": {
			"url": "apiTest/?action=getdashboardlist",
			"type": "POST"
		  	}
	  , "columns": [
	  	  { "data": 'SessionStartTime', 'visible': false, 'searchable': false,},
		  { "data": 'class' },
		  { "data": 'coursename' },
		  { "data": 'name' },
		  { "data": 'location' },
		  { "data": 'starttime' },
		  { "data": 'endtime' },
		  { "data": 'status' , 
             	render: function ( data, type, row ) {
              		return '<div class="' + data.toLowerCase() + '">' + data + '</div>';
            	}
		  },
		  
	    ]
	, "order": [[0,'asc'],[5,'asc'], [6,'asc'] ]
	,

	"deferRender": true,
	"sDom" : 'rt',

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
    
        setInterval(function() {
            
            if(table.page() === table.page('last').page()) {
                table.page('first');
		    table.ajax.reload( null, false ); 
            } else {
                table.page('next');
            }
          	//  table.draw('page');
	   	table.draw('page');
        }, 3000); 


});


</script>


<div class="listtable listtable2">
	<table width="100%" id="courses" class="display " cellspacing="0">
	  <thead>
		<tr>
			<th></th>
		    <th>Class</th>
		    <th>Course Name</th>
		    <th>Tutor Name</th>
		    <th>Location</th>
		    <th>Start Time</th>
		    <th>End Time</th>
		    <th>Status</th>
		</tr>
	  </thead>
	</table>
</div>

<!---
update proTutoringSession
set SessionStartTime = DATE_ADD(now(),INTERVAL -1 hour)
, SessionEndTime = DATE_ADD(now(),INTERVAL 5 hour)

--->


<?php include('_masterFooter.php');?>
