
<?php include('_masterHeader.php');





?>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    
<script>
$('document').ready(function()
{ 

   /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   user_email: {
            required: true,
            email: true
            },
    },
       messages:
    {
            password:{
                      required: "please enter your password"
                     },
            user_email: "please enter your email address",
       },
    submitHandler: submitForm 
       });  
//    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();




   $.ajax({
    
   type : 'POST',
   url  : 'login_process.php',
   data : data,
   beforeSend: function()
   { 
	    $("#error").fadeOut();
	    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
   },
   success :  function(response)
		{      
		//console.log(response);	
		     if(response==1){
			   
				$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In Admin ...');
				setTimeout(' window.location.href = "index.php"; ',2000);
				return true;
	    		}
			else if(response==2){
			   
			$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In Tutor ...');
			setTimeout(' window.location.href = "index.php"; ',2000);
							return true;
	    		}
			else if(response==3){
			   
			$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In Student ...');
			setTimeout(' window.location.href = "index.php"; ',2000);
							return true;
	    		}
	     else{
				$("#error").fadeIn(1000, function(){      
			    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
			     $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
		   });
	     }
     }
   });
    return false;
  }
    /* login submit */
});
</script>

<style>
input[type="text"], input[type="password"] {
    border: 1px solid #CBC7C5;
    border-radius: 3px 3px 3px 3px;
    float: left;
    height: 33px;
    padding: 1px 1px 1px 3px;
    width: 250px;
}
label {font-size:13px;}
.logind { padding:50px; background:white; border: 2px solid  #4A4A4A; margin-left:auto; margin-right:auto; width: 400px; margin-top:30px; }
table td { padding:3px;}
.err {color:red;}
</style>
<div class="logind">


     
        
       <form class="form-signin" method="post" id="login-form">
       
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
        
<table>
				  <tr>

<td>
        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" value="admin@admin.com" />
        <span id="check-e"></span>
</td>
</tr>
   <tr> <td>     

        <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="12345" />

</td>
</tr>
   <tr> <td> 

	  <input type="checkbox" name="isadmin" id="isadmin" /> <label for="isadmin"> Login As Admin</label>

</td>
</tr>
   <tr> <td> 
      <hr />
        

            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   </button> 
 
 </td>
</tr>
 </table>
      
      </form>



</div>





<?php /*?>
<script>
	$(document).ready(function(){
		$("#add_err").css('display', 'none', 'important');
		
		$('#LoadRecordsButton').click(function (e) {
			  username=$("#tuser").val();
			  password=$("#tpassword").val();
			  isadmin=$("#isadmin").prop("checked");
			  $.ajax({
			   type: "POST",
			   url: "http://lamp.cse.fau.edu/~jherna65/apiTest/?action=getuser&EmailAddress=" + username + "&Password=" + password + "&isAdmin=" + isadmin,
			dataType: 'json',
			   success: function(data){    
			   try
			   {
console.log(data);
return;
				if(data[0].Record.isAdmin=='true')    {
				 	alert('yeeeeeeee');
				}
				else    {
				  throw "Error Occurred" ;
				}
			   }
			   catch (ex)
			   {
				   $("#add_err").css('display', 'inline', 'important');
				   $("#add_err").html("<img src='images/alert.png' />Wrong username or password!");
			   }
			   },
			   beforeSend:function()
			   {
				$("#add_err").css('display', 'inline', 'important');
				$("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
			   }
			  });
			return false;
		});
	});
</script>    

<style>
input[type="text"], input[type="password"] {
    border: 1px solid #CBC7C5;
    border-radius: 3px 3px 3px 3px;
    float: left;
    height: 33px;
    padding: 1px 1px 1px 3px;
    width: 250px;
}
label {font-size:13px;}
.logind { padding:50px; background:white; border: 2px solid  #4A4A4A; margin-left:auto; margin-right:auto; width: 400px; margin-top:30px; }
table td { padding:3px;}
.err {color:red;}
</style>

<div style="clear:both"></div>

<div class="logind">

	<div class="err" id="add_err"></div>
		<form>
			<table>
				  <tr>
					<td>Username:</td>
					<td><input style="width: 150px;" type="text" name="tuser" id="tuser" value="admin@admin.com" /></td>
				  </tr>
				  <tr>
					<td>Password:</td>
					<td><input style="width: 150px;" type="password" name="tpassword" id="tpassword" value="12345" /></td>
				  </tr>
				  <tr>
					<td></td>
					<td><input type="checkbox" name="isadmin" id="isadmin" /> <label for="isadmin"> Login As Admin</label></td>
				  </tr>
				  <tr>
					<td colspan="2" align="right" valign="bottom">
					     <button type="submit" id="LoadRecordsButton">Login</button> <button type="button" onClick="window.location.href = window.location.href">Clear</button>
					</td>
				  </tr>
			    </table>
		   </form>	
	</div>
</div>
<?php */?>


<?php include('_masterFooter.php');?>



