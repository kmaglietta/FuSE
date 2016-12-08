

function Processdebuggin($jqXHR, $data)
{
	jsonValue = $.parseJSON( $jqXHR.responseText );
	
	if (jsonValue.debugging)
	{
	  $("#error2").html(
		"<b>json return posted:</b>" + JSON.stringify(jsonValue.objPosted) + '<br>' +
		"<b>json return data:</b>" + JSON.stringify(jsonValue.data) + '<br><br>' +
		"<b>request object:</b></b>" + JSON.stringify($data) + '<br>' +
		"<b>response object:</b>" + JSON.stringify(jsonValue));
	}
}

	var request;
    $(document).ready(function(){
	    $.fn.myfunction = function() {
      alert('hello world');
      return this;
   };
        // click on button submit
        //$("#submit").on('click', function(){
		$("#myform").submit(function(event){

	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();

	    // Abort any pending request
	    if (request) {
	        request.abort();
	    }
	    // setup some local variables
	    var $form = $(this);

	    // Let's select and cache all the fields
	    var $inputs = $form.find("input, select, button, textarea");

	    // Serialize the data in the form
	    var serializedData = $form.serializeArray();

			// convert serilize object to a json object
			var data = {}
			$.each( serializedData, function( i, field ) {
				data[field.name] = field.value;
	    });

	    // Let's disable the inputs for the duration of the Ajax request.
	    $inputs.prop("disabled", true);

	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "apiTest/?action=" + data["action"],
	        type: "post",
		 dataType  : 'json',
	        data: JSON.stringify(data)
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
		  Processdebuggin(jqXHR, data);
		  
		  jsonValue = $.parseJSON( jqXHR.responseText );
		  $("#error").html(jsonValue.data);
	    });

	    // Callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // Log the error to the console
		jsonValue = $.parseJSON( jqXHR.responseText );
		$("#error").html(jsonValue.error.errorMessage);
		Processdebuggin(jqXHR,data);

	    });

	    // Callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // Reenable the inputs
	        $inputs.prop("disabled", false);
	    });

	});


    });
    
    
    
    
    
    