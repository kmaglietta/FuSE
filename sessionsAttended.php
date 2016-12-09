<?php include('_masterHeader.php');?>


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
			
			 $.ajax({
				type: 'POST',
				url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getprofile&StudentId=' + studentid,
				dataType: 'json',
				success: function(response){                    
					//console.log(response);
					//console.log(response.Records[0]);
					
					var $profile = response.Records[0];
					$('#pStudentName').html($profile.StudentName);
					$('#titleName').html($profile.StudentName);
					$('#pTutorSince').html($profile.TutorSince);
					$('#pTotalStudentsTutored').html($profile.TotalStudentsTutored);
					//$('#pAverageRating').html($profile.AverageRating);
					
					var $rating = 0;
					if ($profile.AverageRating)
						rating = $rating;
					
					$("#pAverageRating").rateYo({
					    starWidth: "50px",
					    rating    : $profile.AverageRating,
					    //precision: 2,
					    fullStar: true,
					    readOnly: true,
					    ratedFill: "#f1c40f"
					  });
					
				  },
		
			});

		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Tutor Classes',
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getTutorclasses&StudentId=' + studentid,
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

					Course: {
						//key: true,
						title: 'Course',
						create: false,
						edit: false,
						list: true
					},
					CourseName: {
						title: 'Course Name',
						create: false,
						edit: false,
						list: true
					},
					//TotalRatingSum: {
//						title: 'TotalRatingSum',
//						create: false,
//						edit: false,
//						list: true
//					},
					TotalStudentsRatedTutor: {
						title: 'Number students Rated for this class',
						create: false,
						edit: false,
						list: true
					},
					AverageRating: {
						title: 'Average Rating',
						create: false,
						edit: false,
						list: true
					},
				}
			});

			$('#TableContainer').jtable('load');



			

		});

	</script>

<div class="col-xs-12 text-center">
    <h2 id="titleName"></h2>
</div>
<br>


<div class="MainBodyContent">

	<div style="clear:both;"></div>
<b>Classes Taken</b>		
<br>
	<div id="TableContainer" />

</div>

<?php include('_masterFooter.php');?>

