<?php
	include_once("../header_files/loginHeader.php");
	include_once("../config_database/config.php");
?>

<script type="text/javascript">
function validateFields()
{
	var username=document.registerForm.username.value;
	//var email=document.registerForm.email;
	var password=document.registerForm.password.value;
	var password2=document.registerForm.password2.value;
	var registerErrors=document.getElementById("registerErrors");
	var errors="";
	
	if(username=="") errors += "Username cannot be empty.<br/>";
	//Validate email?
	if(password=="" || password2=="") errors += "Password cannot be empty.<br/>";
	else if(password != password2) errors += "Passwords do not match.<br/>";
	
	registerErrors.innerHTML=errors;
	if(errors !="")
	{
		document.registerForm.password.value="";
		document.registerForm.password2.value="";
	}
	
	return errors=="";
}
</script>

<table style="border-collapse:collapse;border:0px;width:100%;" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center;">
			<span class="title">Register</span>
		</td>
	</tr>					
</table>
<br/>
<form name="registerForm" method="post" action="registerCheck.php" onsubmit="return validateFields()">
	<center>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Email (optional)</td>
				<td><input type="text" name="email"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td>Verify Password</td>
				<td><input type="password" name="password2"/></td>
			</tr>
		</table>
		<div id="registerErrors" style="color: red; "></div>
		<input type="submit"/>
	</center>
</form>

<?php $mysqli->close(); ?>

<?php
	require_once("../header_files/footer.php");
?>