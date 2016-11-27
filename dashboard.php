<?php include('_masterHeader.php');?>


<script>
$(document).ready(function() {
 
/* table ************ */
    var table = $('#courses').DataTable( {
	    "ajax": {
			"url": "apiTest/?action=getdashboardlist",
			"type": "POST"
		  	}
	  , "columns": [
		  { "data": 'class' },
		  { "data": 'coursename' },
		  { "data": 'name' },
		  { "data": 'location' },
		  { "data": 'starttime' },
		  { "data": 'endtime' },
		  { "data": 'status' }
	    ]
	, 
	"deferRender": true,
	"sDom" : 'rt',

	"oLanguage": {
         "sSearch": "Search any field:"
       }
	 
    } );
    
        setInterval(function() {
            
            if(table.page() === table.page('last').page()) {
                table.page('first');
            } else {
                table.page('next');
            }
            table.draw('page');
        }, 5000); 

 //table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
 //       var data = this.data();        
//        //console.log(data);
//	  alert(data);
        
//        data[0] = '*ddddd ' + data[0];
                
 //       //this.data(data);
//    });
//https://datatables.net/reference/api/columns().every()

// Draw once all updates are done
//table.draw();


});


</script>


<div class="listtable listtable2">
	<table width="100%" id="courses" class="display " cellspacing="0">
	  <thead>
		<tr>
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


<?php include('_masterFooter.php');?>
