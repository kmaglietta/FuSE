<?php include('_masterHeader.php');?>



<div class="col-xs-12 text-center">
    <h2>Admins Administration</h2>
</div>
<br>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Tutor Management',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'EmailAddress ASC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getTutors&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&iSearch=' + iSearch  ,
							type: 'POST',
							dataType: 'json',
							data: postData,
							success: function (data) {
							    $dfd.resolve(data);
							},
							error: function () {
							    $dfd.reject();
							}
						  });
					    });
					}

					, createAction: function (postData) {
						  return $.Deferred(function ($dfd) {
							$.ajax({
							    url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=addTutor',
							    type: 'POST',
							    dataType: 'json',
							    data: postData,
							    success: function (data) {
								  $dfd.resolve(data); $('#TableContainer').jtable('reload');
							    },
							    error: function () {
								  $dfd.reject();
							    }
							});
						  });
					    }
					, updateAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=updateTutor',
							type: 'POST',
							dataType: 'json',
							data: postData,
							success: function (data) {
							    $dfd.resolve(data); $('#TableContainer').jtable('reload');
							},
							error: function () {
							    $dfd.reject();
							}
						  });
					    });
					}
//					, deleteAction: function (postData, jtParams) {
//					    return $.Deferred(function ($dfd) {
//						  $.ajax({
//							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=deleteTutor',
//							type: 'POST',
//							dataType: 'json',
//							data: postData,
//							success: function (data) {
//							    $dfd.resolve(data); //$('#TableContainer').jtable('reload');
//							},
//							error: function () {
//							    $dfd.reject();
//							}
//						  });
//					    });
//					}
				},
				fields: {
					//``, ``, ``, ``, ``, ``, ``, ``
					TutorId: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					StudentId: {
						title: 'Student Name',
						options: 'apiTest/?action=getStudentnames',
						list: false
					},
					StudentName: {
						title: 'Student Name',
						create: false,
						edit: false,
						list: true
					},
					ClassId: {
						title: 'Class approved for',
						options: 'apiTest/?action=getClassinfonames',
						list: false
					},
					ApprovedForClassName: {
						title: 'Class approved for',
						create: false,
						edit: false,
						list: true
					},
					ApprovedByAdminId: {
						title: 'Approved By',
						options: 'apiTest/?action=getDirectornames',
						list: false
					},
					
					ApprovedOn: {
						title: 'Approved On',
						type: 'date',
						create: false,
						edit: false,
						list: true
					},
					
					ApprovedByName: {
						title: 'Approved By',
						create: false,
						edit: false,
						list: true
					},
					
					DateEntered: {
						title: 'Date Entered',
						type: 'date',
						create: false,
						edit: false,
						list: false
					}
				}
			});

			//$('#TableContainer').jtable('load');

			//Re-load records when user click 'load records' button.
			$('#LoadRecordsButton').click(function (e) {
				e.preventDefault();
				$('#TableContainer').jtable('load', {
				    iSearch: $('#iSearch').val()
				});
			});
			
			//Load all records when page is first shown
			$('#LoadRecordsButton').click();

		});

	</script>
<div class="MainBodyContent">

	<div class="filtering">
	    <form>
		  Search: <input type="text" name="iSearch" id="iSearch" />
		  <button type="submit" id="LoadRecordsButton">Refresh records</button> <button type="button" onClick="window.location.href = window.location.href">Clear</button> 
	    </form>
	</div>
	
<br>
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

