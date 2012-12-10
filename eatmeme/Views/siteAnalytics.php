<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"]);
//Track visitors on the page
require_once('Controllers/siteAnalytics.php');
trackVisitors();
/******************************************************************************/
?> 
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>eatMeme</title>
</head>

<body>
	<?php echo getTotalUniqueVisitors(); ?>
</body>
</html>