<?php include('_masterHeader.php');?>




<!--- icon from https://www.iconfinder.com/icons/285641/id_user_icon#size=128--->

<style>
<?php /*?>span.stars, span.stars span {
    display: block;
    background: url(images/stars.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}

span.stars span {
    background-position: 0 0;
    border:1px solid blue
}
$.fn.stars = function() {
		    return $(this).each(function() {
			  // Get the value
			  var val = parseFloat($(this).html());
			  // Make sure that the value is in 0 - 5 range, multiply to get width
			  var size = Math.max(0, (Math.min(5, val))) * 16;
			  // Create stars holder
			  var $span = $('<span />').width(size);
			  // Replace the numerical value with stars
			  $(this).html($span);
		    });
		}
		
$('span.stars').stars();<?php */?>

.stars-container {
  position: relative;
  display: inline-block;
  color: transparent;
  font-size: 20px;
}

.stars-container:before {
  position: absolute;
  top: 0;
  left: 0;
  content: '★★★★★';
  color: lightgray;
  font-size: 20px;
}

.stars-container:after {
  position: absolute;
  top: 0;
  left: 0;
  content: '★★★★★';
  color: #FFBE00;
  overflow: hidden;
  font-size: 20px;
}

.stars-0:after { width: 0%; }
.stars-1:after { width: 20%; }
.stars-2:after { width: 40%; }
.stars-3:after { width: 60%; }
.stars-4:after { width: 80%; }
.stars-5:after { width: 100%; }

</style>




	<script type="text/javascript">
	
		//https://stackoverflow.com/questions/1987524/turn-a-number-into-star-rating-display-using-jquery-and-css/1987545#1987545
		


		$(document).ready(function () {
		    //Prepare jTable
			$('#TableContainer').jtable({
				title: 'Tutor Classes',
				paging: true, //Enable paging
				pageSize: 10, //Set page size (default: 10)
				sorting: true, //Enable sorting
				defaultSorting: 'AverageRating DESC', //Set default sorting
				actions: {
					
					listAction: function (postData, jtParams) {
					    return $.Deferred(function ($dfd) {
						  $.ajax({
							 url: 'http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getprofiles&jtStartIndex=' + jtParams.jtStartIndex + '&jtPageSize=' + jtParams.jtPageSize + '&jtSorting=' + jtParams.jtSorting + '&iSearch=' + iSearch   + '&isRating=' + isRating            , //
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

					StudentName: {
						title: 'Tutor Name',
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
					TotalStudentsTutored: {
						title: 'Number students tutored',
						create: false,
						edit: false,
						list: true
					},
					TotalStudentsRatedTutor: {
						title: 'Number students rated this tutor',
						create: false,
						edit: false,
						list: true
					},
					AverageRating: {
						title: 'Average Rating',
						
						display: function (data) {
							try {
								var score = 0;
								if (data.record.AverageRating)
								 score = data.record.AverageRating;
								//return '<span class="stars">' + score + '</span>';
								return '<div><span class="stars-container stars-' + score + '">★★★★★</span></div>'
							}
							catch (ex)
							{
							 return '';	
							}
							
						    }
						
					},
					 StudentId: {
						title: 'View Profile',
						
						display: function (data) {
							try {
								return '<a href="/~jherna65/tutorProfile.php?studentid='+data.record.StudentId+'"><img src="/~jherna65/images/user-id-32.png" width="32" height="32" alt=""/></a>';
							}
							catch (ex)
							{
							 return '';	
							}
							
						    }
						
					}
				},

				
			});

			//$('#TableContainer').jtable('load');

			//Re-load records when user click 'load records' button.
			$('#LoadRecordsButton').click(function (e) {
				e.preventDefault();
				$('#TableContainer').jtable('load', {
				    //FirstName: $('#FirstName').val(),
				    //LastName: $('#LastName').val(),
				    iSearch: $('#iSearch').val(),
				    isRating: $('#isRating').val()
				});
			});
			
			//Load all records when page is first shown
			$('#LoadRecordsButton').click();

			
				

		});

	</script>

<div class="col-xs-12 text-center">
    <h2 id="Tutor Profiles"></h2>
</div>
<br>


<div style="width:80%; margin-left:auto; margin-right:auto;">

	<div class="filtering">
	    <form>
	    	Search: <input type="text" name="iSearch" id="iSearch" />
		 Min Rating: 
		  <select id="isRating" name="isRating">
			<option selected="selected" value="-1">Show All</option>
			<option value="0">No Stars</option>
			<option value="1">1 Star</option>
			<option value="2">2 Stars</option>
			<option value="3">3 Stars</option>
			<option value="4">4 Stars</option>
			<option value="5">5 Stars</option>
		  </select>
		 <button type="submit" id="LoadRecordsButton">Search</button> <button type="button" onClick="window.location.href = window.location.href">Clear</button>
	    </form>
	</div>
	
<ul>
</ul>
	<div id="TableContainer" />

</div>


<?php include('_masterFooter.php');?>

