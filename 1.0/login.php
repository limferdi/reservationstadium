<?php 
	date_default_timezone_set("Asia/Jakarta");
	include("config.php");		
?>

<div style="text-align:center;padding: 20px;font-weight: bold;color: #003366;font-size: 21px;">
	Soccer Stadium Online Reservation
</div>

<div style="text-align:center;padding:30px;color: #0033CC">
	<table style="text-align:center;width:40%;margin:auto;" frame="box">
    	 <tr >
        	<td colspan="3" style="text-align:center;padding-top:10px;padding-bottom:20px;">Please login to book, or <a href="register.php">click here </a>to register !</td>        	
         </tr>
         <tr >
        	<td style="text-align:right;width:35%;">Email</td><td style="text-align:center;">:</td><td style="text-align:left;"><input id="email" type="text" value="" style="border-radius:3px;border: 1px #999 solid;" /></td>    	
         </tr>
         <tr >
            <td style="text-align:right;width:35%;">Password</td><td style="text-align:center;">:</td><td style="text-align:left;"><input id="password" type="password" value="" style="border-radius:3px;border: 1px #999 solid;" /></td> 
         </tr>
         <tr >
            <td style="text-align:right;width:35%;">&nbsp;</td><td style="text-align:center;">&nbsp;</td><td style="text-align:left;"><input id="loginsubmit" type="button" value="Login !" style="cursor:pointer;border-radius:3px;" /></td> 
         </tr>
         <tr >
        	<td colspan="3" style="text-align:center;padding-top:10px;padding-bottom:10px;">&nbsp;</td>        	
         </tr>
    </table>
</div>

<script type="text/javascript" src="jquery-2.1.1.js"></script>
<script>
	
	$('#email').focus();
	
	$('#email').keypress(function(e){
		if (e.which == 13){
			$('#password').focus();
		}
	});
	$('#password').keypress(function(e){
		if (e.which == 13){
			$('#loginsubmit').click();
		}
	});
	
	$('#loginsubmit').click(function(){
		
		var email = $('#email').val();
		var password = $('#password').val();
		
		if (email.trim() == ""){
			alert("Email must be filled !");
			$('#email').focus();
		}	
		else if (validateEmail(email) == false){
			alert("Invalid email address !");
			$('#email').focus();
		}
		else if (password.trim() == ""){
			alert("Password must be filled !");
			$('#password').focus();
		}	
		else{
			$.post("loginprocess.php?email="+email+"&password="+password, function(response) {	
					
				if (response.indexOf("success") >= 1){	
					var responsetemp = response.split(",");
					var user_id = responsetemp[1];	
					var user_email = responsetemp[2];	
					localStorage.setItem("user_id", user_id);
					localStorage.setItem("user_email", user_email);	
						
					window.location.href = "index.php";
				}
				else if (response == "Invalid email or password"){
					alert("Invalid email or password !");
				}
				else{
					alert("Login failed, please try later.");
				}
			});
		}				
		
	});
	
	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}
</script>