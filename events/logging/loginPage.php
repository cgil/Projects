<?php
	require_once("../header_files/loginHeader.php");
	require_once("../config_database/config.php");
?>

<script type="text/javascript">
function validateFields()
{
	var username=document.loginForm.username.value;
	var password=document.loginForm.password.value;
	var registerErrors=document.getElementById("loginErrors");
	var errors="";
	
	if(username=="") errors += "Username cannot be empty.<br/>";
	if(password=="") errors += "Password cannot be empty.<br/>";
	
	registerErrors.innerHTML=errors;
	if(errors !="")
	{
		document.loginForm.password.value="";
	}
	
	return errors=="";
}
</script>

<br/>
<table style="border-collapse:collapse;border:0px;width:100%;" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center;">
			<span class="title">Nodefy</span>
		</td>
	</tr>					
</table>
<br/>
<center>
	<p>Please <a href="registerPage.php">register</a> or login:</p>
</center>
<form name="loginForm" method="post" action="loginCheck.php" onsubmit="return validateFields()">
	<center>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"/></td>
			<tr/>
		</table>
		<div id="loginErrors" style="color: red; "></div>
		<input type="submit" name="Enter" value="Log in"/>
	<center>
</form>

<img src="../Images/nodefy_scaled.jpg" width="634" height="370" alt="scaled_map" />
<?php $mysqli->close(); ?>

<?php
	require_once("../header_files/footer.php");
?>