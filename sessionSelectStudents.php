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
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=gettutoredlist&StudentId='  + studentid       ,
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

					Status: {
						title: 'Status' 				
					}
				}
			});

			$('#TableContainer').jtable('load');


		});

	</script>
<div style="width:80%; margin-left:auto; margin-right:auto;">

	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

