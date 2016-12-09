<?php include('_masterHeader.php');?>



<div class="col-xs-12 text-center">
    <h2>Select Students for Session</h2>
</div>
<br>
<?php
if ((isset($_REQUEST['studentid'])) && (!empty($_REQUEST['studentid'])))
{
    $studentid= $_REQUEST['studentid'];
}
?>

<!--- icon from https://www.iconfinder.com/icons/285641/id_user_icon#size=128--->


	<script type="text/javascript">
	
		var studentid = "<?php echo $studentid; ?>";

		$(document).ready(function () {

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Select Students for Session',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'EmailAddress ASC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=gettutoredlist&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&iSearch=' + iSearch + '&StudentId='  + studentid        ,
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
							    url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=addLocation&',
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


				},
				fields: {

					SessionId : {
						key: true,
						create: false,
						edit: false,
						list: false,
						width:'20%'
					},
					ClassSession: {
						title: 'Session Name'						
					},
					
					//SessionStartTime: {
//						title: 'FROM',
//						display: function (data) {
//							try {
//							  return dateFormat(data.record.SessionStartTime, "yyyy-mm-dd h:MM TT");
//							}
//							catch (exception) {
//								//var today = new Date();
//								//return dateFormat( today, "yyyy-mm-dd h:MM TT");	
//								return null;
//							}
//						
//					    },
//					
//					SessionEndTime: {
//						title: 'TO',
//						display: function (data) {
//							try {
//							  return dateFormat(data.record.SessionEndTime, "yyyy-mm-dd h:MM TT");
//							}
//							catch (exception) {
//								//var today = new Date();
//								//return dateFormat( today, "yyyy-mm-dd h:MM TT");	
//								return null;
//							}
//						
//					    },
						   

					Status: {
						title: 'Status' 				
					}
				}
			});

			//$('#TableContainer').jtable('load');

			//Re-load records when user click 'load records' button.
			$('#LoadRecordsButton').click(function (e) {
				e.preventDefault();
				$('#TableContainer').jtable('load', {
				    iSearch: $('#iSearch').val(),
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
	
<br />
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>


