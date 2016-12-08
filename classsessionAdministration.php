<?php include('_masterHeader.php');?>



<style>
	input[name="SessionEndTime"] .ui-datepicker-calendar {display: none;}
</style>
<div class="col-xs-12 text-center">
    <h2>Session Management</h2>
</div> 
<br> 
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Session Management',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'EmailAddress ASC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getClasssession&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&iSearch=' + iSearch + '&isCanceled=' + isCanceled  ,
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
							    url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=addClasssession',
							    type: 'POST',
							    dataType: 'json',
							    data: postData,
							    success: function (data) {
								  $dfd.resolve(data); 
								  $('#TableContainer').jtable('reload');
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
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=updateClasssession',
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
					//, deleteAction: function (postData, jtParams) {
//					    return $.Deferred(function ($dfd) {
//						  $.ajax({
//							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=deleteClasssession',
//							type: 'POST',
//							dataType: 'json',
//							data: postData,
//							success: function (data) {
//							    $dfd.resolve(data); $('#TableContainer').jtable('reload');
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
					SessionId: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					TutorId: {
						title: 'Select Approved Section',
						options: 'apiTest/?action=getTutornames',
						create: true,
						edit: true,
						list: false
					},
					StudentName: {
						title: 'Tutor Name',
						create: false,
						edit: false,
						list: true
					}, 
					
					  
					ClassSession: {
						title: 'Approved for Class',
						create: false,
						edit: false,
						list: true
					}, 
					
					LocationId: {
						title: 'Location',
						options: 'apiTest/?action=getLocationnames',
					},
					
					SessionStartTime: {
						title: 'Session Start',
						format:    'MM-DD-YYYY h:mm A',
						//display: function (data) {
						//	try {
						//	  return dateFormat(data.record.SessionStartTime, "yyyy-mm-dd h:MM TT");
						//	}
						//	catch (exception) {
						//		//var today = new Date();
						//		//return dateFormat( today, "yyyy-mm-dd h:MM TT");	
						//		return null;
						//	}
						//	
						 //   }
						 
					},
					
					SessionEndTime: {
						title: 'Session End',
						display: function (data) {
							try {
							  return dateFormat(data.record.SessionEndTime, "yyyy-mm-dd h:MM TT");
							}
							catch (exception) {
								//var today = new Date();
								//return dateFormat( today, "yyyy-mm-dd h:MM TT");	
								return null;
							}
							
						    }
						
					},
					Canceled: {
						title: 'Canceled?',
						options: { 0 : 'No', 1 : 'Yes' },
						create: false,
						edit: true,
						list: true
						
					},
					CancelReason: {
						title: 'Cancel Reason' ,
						create: false,
						edit: true,
						list: true
					},

					CanceledByTutor: {
						title: 'Canceled By Tutor',
						options: { 0 : 'No', 1 : 'Yes' },
						create: false,
						edit: true,
						list: true
					},
					
					CanceledByAdminId: {
						title: 'Canceled By Admin' ,
						options: 'apiTest/?action=getDirectornames',
						create: false,
						edit: true,
						list: true
						
					},
					DateCanceled: {
						title: 'Date Canceled',
						type: 'date',
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
					,
					Status: {
						title: 'Status',
						create: false,
						edit: false,
						list: true, 
						display: function (data) {
							try
							{
							 return '<div class="' + (data.record.Status).toLowerCase() + '2">' + data.record.Status + '</div>'; 
							}
							catch (ex)
							{
							 return '';	
							}
					     }
					}
					
				}
				,
				formCreated: function (event, data) 
				    {
					 $("#Edit-CanceledByAdminId").prepend("<option value='0' selected='selected'></option>");
					 //
					 
					 
					 var $input_start_time = data.form.find ('input[name="SessionStartTime"]');
					 var $input_end_time = data.form.find ('input[name="SessionEndTime"]');
					 
					 $input_start_time.addClass("date");
					 $input_start_time.addClass("time");
					 
					 $input_end_time.addClass("date");
					 $input_end_time.addClass("time");
					 
					  $input_start_time.addClass("timepicker");
					  $input_end_time.addClass("timepicker");
					 
					 $input_start_time.datetimepicker(
					 	{ 
						 dateFormat: 'yy-mm-dd'
						 , timeFormat: 'hh:mm tt'
						 , maxDate: "+3m"
						 , minDate: "0d"
						 , numberOfMonths: 2
						 , stepMinute: 15
						 , hourMin: 0
						 , hourMax: 23
						  , addSliderAccess: true
						 , sliderAccessArgs: { touchonly: false }
						// , controlType: 'select'
//						, oneLine: true
//						, timeFormat: 'hh:mm tt'
						 , onClose: function(dateText, inst) {
							if ($input_end_time.val() != '') {
								var testStartDate = $input_start_time.datetimepicker('getDate');
								var testEndDate = $input_end_time.datetimepicker('getDate');
								if (testStartDate > testEndDate)
									$input_end_time.datetimepicker('setDate', testStartDate);
							}
							else {
								$input_end_time.val(dateText);
							}
						}
						 , onSelect: function (selectedDateTime){
								$input_end_time.datetimepicker('option', 'minDate', $input_start_time.datetimepicker('getDate') );
								$input_end_time.datetimepicker('option', 'maxDate', $input_start_time.datetimepicker('getDate') );
								//$input_end_time.datetimepicker('option', 'hourMin', $input_start_time.datetimepicker('getDate') );
								//$input_end_time.datetimepicker('option', 'hourMax', $input_start_time.datetimepicker('getDate') );
							}
						});
						
					$input_end_time.datetimepicker(
					 	{ 
						  dateFormat: 'yy-mm-dd'
						 , timeFormat: 'hh:mm tt'
						 , stepMinute: 15
						 //, maxHour: "+3h"
						 //, maxDate: "+3h"
						 , hourMin: 7
						 , hourMax: 23
						 , addSliderAccess: true
						 , sliderAccessArgs: { touchonly: false }
						// , controlType: 'select'
//						, oneLine: true
//						, timeFormat: 'hh:mm tt'
						 , onClose: function(dateText, inst) {
							if ($input_start_time.val() != '') {
								var testStartDate = $input_start_time.datetimepicker('getDate');
								var testEndDate = $input_end_time.datetimepicker('getDate');
								if (testStartDate > testEndDate)
									$input_start_time.datetimepicker('setDate', testEndDate);
							}
							else {
								$input_start_time.val(dateText);
							}
						}
						//, onSelect: function (selectedDateTime){
						//		$input_start_time.datetimepicker('option', 'maxDate', $input_end_time.datetimepicker('getDate') );
						//	}
						});
						
			//			 //Initialize validation logic when a form is created
				//		 data.form.find('input[name="CancelReason"]').addClass('validate[required]');
	    	 	    //            //data.form.find('input[name="EmailAddress"]').addClass('validate[required,custom[email]]');
			   //             //data.form.find('input[name="Password"]').addClass('validate[required]');
			   //            // data.form.find('input[name="BirthDate"]').addClass('validate[required,custom[date]]');
			  //              //data.form.find('input[name="Education"]').addClass('validate[required]');
			//                data.form.validationEngine();
						
		
				    },
				    
			            ////Validate form when it is being submitted
			            //formSubmitting: function (event, data) {
			            //    return data.form.validationEngine('validate');
			            //},
			            ////Dispose validation logic when form is closed
			            //formClosed: function (event, data) {
			            //    data.form.validationEngine('hide');
			            //    data.form.validationEngine('detach');
			            //}
				

			});

			//$('#TableContainer').jtable('load');

			//Re-load records when user click 'load records' button.
			$('#LoadRecordsButton').click(function (e) {
				e.preventDefault();
				$('#TableContainer').jtable('load', {
				    iSearch: $('#iSearch').val(),
				    isCanceled: $('#isCanceled').val()
				});
			});
			
			//$(function(){
//			 $.timepicker.datetimepicker(
//			  	{
//				 	stepMinute: 10 	
//				}
//			  );
//			});
			    
			//Load all records when page is first shown
			$('#LoadRecordsButton').click();

		});

	</script>
	


	
<div style="width:95%; margin-left:auto; margin-right:auto;">

	<div class="filtering">
	    <form>
		  Search: <input type="text" name="iSearch" id="iSearch" />
		  is Canceled: 
		  <select id="isCanceled" name="isCanceled">
			<option selected="selected" value="0">Show All</option>
			<option value="1">Yes</option>
			<option value="2">No</option>
		  </select>
		  <button type="submit" id="LoadRecordsButton">Refresh records</button> <button type="button" onClick="window.location.href = window.location.href">Clear</button> 
	    </form>
	</div>
	
<br>
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

