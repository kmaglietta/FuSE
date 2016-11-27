<?php include('_masterHeader.php');?>




<div class="col-xs-12 text-center">
    <h2>Students Administration</h2>
</div>
<br>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Students Administration',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'EmailAddress ASC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'apiTest/?action=getStudents&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&FirstName=' + FirstName + '&LastName=' + LastName + '&isTutor=' + isTutor         ,
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
							    url: 'apiTest/?action=addStudent&',
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
					, updateAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'apiTest/?action=updateStudent',
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
					, deleteAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'apiTest/?action=deleteStudent',
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
				},
				fields: {
					//``, ``, ``, ``, ``, ``, ``, ``
					StudentId: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					EmailAddress: {
						title: 'Email Address',
						create: true,
						edit: false,
						list: true
						
					},
					Password: {
						title: 'Set Password',
						create: true,
						edit: true,
						list: false
						
					},
					FirstName: {
						title: 'First Name'
						
					},
					LastName: {
						title: 'Last Name'
						
					},
					ContactPhone: {
						title: 'Contact Phone'
						
					},
					isTutor: {
						title: 'Approved Tutor',
						create: false,
						edit: false,
						list: true
						
						
					},
					FavoriteTutorId: {
						title: 'FavoriteTutorId',
						create: false,
						edit: false,
						list: false
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
				    FirstName: $('#FirstName').val(),
				    LastName: $('#LastName').val(),
				    isTutor: $('#isTutor').val()
				});
			});
			
			//Load all records when page is first shown
			$('#LoadRecordsButton').click();

		});

	</script>
<div style="width:80%; margin-left:auto; margin-right:auto;">

	<div class="filtering">
	    <form>
		  First Name: <input type="text" name="FirstName" id="FirstName" />
		  Last Name: <input type="text" name="LastName" id="LastName" />
		  is Tutor: 
		  <select id="isTutor" name="isTutor">
			<option selected="selected" value="0">Show All</option>
			<option value="1">Yes</option>
			<option value="2">No</option>
		  </select>
		 <button type="submit" id="LoadRecordsButton">Refresh records</button> <button type="button" onClick="window.location.href = window.location.href">Clear</button>
	    </form>
	</div>
	
<ul>
<li>To reset a password do an edit and change the *********, otherwise leave as is</li>
</ul>
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

