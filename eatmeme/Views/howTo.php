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
                	Search for a twitter hashtag, @person, phrase, or any interesting word then Fiest! <br/>
                    We'll connect you to a tweet stream and form meme's out of those tweets. <br/><br/>
                    Hit next or the right arrow key to get the next meme.<br/>
                    Or press Play to stream memes.<br/><br/>
                    Share with Friends<br/>
                    !
            
            </p>
        </div>
    </div>

</body>


</html>

