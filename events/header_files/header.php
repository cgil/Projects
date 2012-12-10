<?php
	session_start(); 
?>

<?php
	/*if(!(isset($_SESSION['id'])))
	{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../logging/loginPage.php">'; 
	}*/
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Nodefy</title>
	<meta name="description" content="Visual social network of trends and hot spots" /> 
    <meta name="keywords" content="social networking, social, network, hot, spot, trends, google, map, google map, social networking site, site, yahoo, yql, twitter, populate, populer, visual, event, events, cool, node, nodes, nodefy, nodefication, location, fun, festivals, fun spot" /> 
    <meta http-equiv="content-language" content="en">
    <link rel="shortcut icon" href="../Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../Images/favicon.ico" type="image/x-icon">
        
	<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
    <!-- Google API -->
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="http://code.google.com/apis/gears/gears_init.js"></script>
    
</head>
<body onLoad="initialize()">
<table class="menutab" border="0" cellpadding="0" cellspacing="0">			
	<tr>
		<td style="padding:0px;margin:0px;border:0px;color:#FFFFFF;background-color:#990000;">
			<table style="border-collapse:collapse;margin:0px auto;border:0px;width:1000px;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:left;">
						<table style="border-collapse:collapse;border:0px;" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="menutab">
									<a class="menubigtab" href="../mapping/init_map.php">Nodefy</a>
								</td>
								<td class="menutab">
									<!--<a class="menutab" href = "">Profile</a>-->
								</td>
								<td class="menutab">
									<a class="menutab" href = "../mapping/init_map.php">Map</a>
								</td>
								<td class="menutab">
									<!--<a class="menutab" href = "">Help</a>-->
								</td>
								<td class="menutab">
									<!--<a class="menutab" href = "">Contact</a>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>							
			</table>
		</td>
	</tr>				
</table>
<div class="main">