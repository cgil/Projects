<?php
	session_start(); 
?>

<?php 
	if(isset($_SESSION['id']))
	{
		session_destroy();
	}
	
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=loginPage.php">';  
?>