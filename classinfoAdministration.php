<?php include('_masterHeader.php');?>

<!--<link href="http://jtable.org/Content/themes/lightcolor/jquery-ui.css" rel="stylesheet" type="text/css" />-->

<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://www.jtable.org/Scripts/jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
<link href="http://www.jtable.org/Content/themes/metroblue/jquery-ui.css" rel="stylesheet" type="text/css" />
-->



<script src="/~jherna65/jquery/jquery-3.1.1.min.js"></script>
<script src="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>


<link href="/~jherna65/jquery/jtable.2.4.0/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
<script src="/~jherna65/jquery/jtable.2.4.0/jquery.jtable.js" type="text/javascript"></script>
<link href="/~jherna65/jquery/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />



<div class="col-xs-12 text-center">
    <h2>Classinfos Administration</h2>
</div>
<br>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Classinfos Administration',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'EmailAddress ASC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'apiTest/?action=getClassinfos&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&FirstName=' + FirstName + '&LastName=' + LastName + '&isTutor=' + isTutor         ,
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
							    url: 'apiTest/?action=addClassinfo&',
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
							 url: 'apiTest/?action=updateClassinfo',
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
//					, deleteAction: function (postData, jtParams) {
//					    return $.Deferred(function ($dfd) {
//						  $.ajax({
//							 url: 'apiTest/?action=deleteClassinfo',
//							type: 'POST',
//							dataType: 'json',
//							data: postData,
//							success: function (data) {
//							    $dfd.resolve(data);
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
					ClassinfoId: {
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
		  <button type="submit" id="LoadRecordsButton">Refresh records</button>
	    </form>
	</div>
	
<ul>
<li>To reset a password do an edit and change the *********, otherwise leave as is</li>
</ul>
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

