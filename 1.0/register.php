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
        	<td colspan="3" style="text-align:center;padding-top:10px;padding-bottom:20px;">Please register, or <a href="login.php">click here </a>to login !</td>        	
         </tr>
         <tr >
        	<td style="text-align:right;width:35%;">Email</td><td style="text-align:center;">:</td><td style="text-align:left;"><input id="email" type="text" value="" style="border-radius:3px;border: 1px #999 solid;" /></td>    	
         </tr>
         <tr >
            <td style="text-align:right;width:35%;">Password</td><td style="text-align:center;">:</td><td style="text-align:left;"><input id="password" type="password" value="" style="border-radius:3px;border: 1px #999 solid;" /></td> 
         </tr>
         <tr >
            <td style="text-align:right;width:35%;">Confirm Password</td><td style="text-align:center;">:</td><td style="text-align:left;"><input id="confirmpassword" type="password" value="" style="border-radius:3px;border: 1px #999 solid;" /></td> 
         </tr>
         <tr >
            <td style="text-align:right;width:35%;">&nbsp;</td><td style="text-align:center;">&nbsp;</td><td style="text-align:left;"><input id="registersubmit" type="button" value="Submit !" style="cursor:pointer;border-radius:3px;" /></td> 
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
			$('#confirmpassword').focus();
		}
	});
	$('#confirmpassword').keypress(function(e){
		if (e.which == 13){
			$('#registersubmit').click();
		}
	});
	
	$('#registersubmit').click(function(){
		
		var email = $('#email').val();
		var password = $('#password').val();
		var confirmpassword = $('#confirmpassword').val();
		
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
		else if (confirmpassword.trim() == ""){
			alert("Confirm Password must be filled !");
			$('#confirmpassword').focus();
		}			
		else if (password != confirmpassword){
			alert("Confirmation password different with password, please check.");
			$('#password').focus();
		}
		else{
			$.post("registerprocess.php?email="+email+"&password="+password, function(response) {		
				if (response == "register success"){
					alert("Email registered successfully, please try login.");
					window.location.href = "login.php";
				}
				else if (response == "already registered"){
					alert("Email already registered, please try another email.");
				}
				else if (response == "register failed"){
					alert("Failed to register, please try later.");
				}
			});
		}				
		
	});
	
	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}
</script>