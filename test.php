<!--
DataTables | https://datatables.net
Copyright (C) 2008-2016, SpryMedia Ltd.
https://datatables.net/license/mit


PHPPOT | http://phppot.com/
Use samples and references
--><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
</head> 



<style>
div {padding:2px;}
a {padding:0 5px;}
</style>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
	  "processing": true,
        "serverSide": true,
	    "ajax": {
			"url": "api/?action=getlist",
			"type": "POST"
		  	}
	  , "columns": [	
		  { "data": 'name' },
		  { "data": 'class' },
		  { "data": 'coursename' },
		  { "data": 'location' },
		  { "data": 'starttime' },
		  { "data": 'endtime' }
	    ]
    } );
} );
</script>


<table id="example" class="display" width="100%" cellspacing="0" data-page-length='5'>
  <thead>
	<tr>
	    <th>Name</th>
	    <th>Class</th>
	    <th>CourseName</th>
	    <th>Location</th>
	    <th>Startdate</th>
	    <th>EndTime</th>
	</tr>
  </thead>
  <tfoot>
	<tr>
	    <th>Name</th>
	    <th>Class</th>
	    <th>CourseName</th>
	    <th>Location</th>
	    <th>Startdate</th>
	    <th>EndTime</th>
	</tr>
  </tfoot>
</table>
    
