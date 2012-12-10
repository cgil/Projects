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
<link href="../CSS/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="mainContent">
        <div id="contactInfoContainer">
            <p style="text-align: center; font-size:16px; font-weight:700;">
                <br/><br/><br/>
                This little demo was <br/><br/>
                 Developed by: <br/><br/>
                    Carlos Gil	<br/>
                         &		<br/>
                    Nick Zukoski	<br/><br/>
                    
                    
                    Email us if you liked it or had good laugh, we love your feedback!	<br/><br/>
                        cgil@gilventures.com
            
            </p>
        </div>
    </div>

</body>


</html>

