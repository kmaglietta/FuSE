<!--
DataTables | https://datatables.net
Copyright (C) 2008-2016, SpryMedia Ltd.
https://datatables.net/license/mit


PHPPOT | http://phppot.com/
Use samples and references
--><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<?php /*?><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"><?php */?>



<link rel="stylesheet" type="text/css" href="http://lamp.cse.fau.edu/~jstephen2014/FuSE/homepage/style.css">
<link rel="stylesheet" type="text/css" href="datatable.css">
</head> 





<script>
$(document).ready(function() {
    $('#courses').DataTable( {
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



<table id="courses" class="display" cellspacing="0" data-page-length='3'>
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

</table>
    
