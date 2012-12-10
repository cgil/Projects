<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"]);
//Track the users who visit the page
require_once("Controllers/siteAnalytics.php");
trackVisitors();
/******************************************************************************/
?> 

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>eatMeme</title>
<meta name="description" content="eatMeme, turn tweets into memes!" />
<meta name="keywords" content="eatmeme, eatMeme, meme, twitter, tweet, stream, funny, jokes, pictures, cheezburger" />
<link href="CSS/main.css" rel="stylesheet" type="text/css">
<link rel="eatmeme icon" href="/Images/me_favicon.ico" >

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="Common/ajax_helper.js" type="text/javascript"></script>
<script src="javascript/fetchMeme.js" type="text/javascript"></script>
<script src="javascript/fetchTweet.js" type="text/javascript"></script>
<script src="javascript/infiniteScrollerLogic.js" type="text/javascript"></script>
<script src="javascript/buttonPress.js" type="text/javascript"></script>
<script type="text/javascript">

recentMemes = [];
payloadId = 0;
pageSize = 15;
payloadQueue = [];
maxPayloadsPerPage = 5;
twitterQuery = "";
willUpdatePage = false;

function loopIt()
{
	if (willUpdatePage)
	{
		setTimeout(updatePage, 4000)
	}
}

$(document).ready(function() {

		$('#searchBox').keydown(function(e) 
		{
				if (e.which == 13) 
				{
					jQuery(this).blur();
					jQuery('#fiestButton').focus().click();
				}
		});
		
		$(document).keydown(function(e)
		{
			//Don't get next meme if inside text area
			var tag = e.target.tagName.toLowerCase();
    		if (e.keyCode == 39 && tag != 'input' && tag != 'textarea') { 
       			nextButtonPressed();
       			return false;
    	}
});

});




</script>
</head>

<body>

<div id="mainContent">
	
    <div id="leftSideBar">
        <div id="searchContainer">
        	<form name="fiestForm" method="get" action="" onSubmit="return false;">
                 <div id="searchBoxContainer">
                    <input type="text" name="searchBox" id="searchBox">
                </div>
                <div id="searchButtonContainer">
                    <input id="fiestButton" name="fiestButton" type="button" onClick="newQueryRequest(this.form)" return false;>
                </div>
                <div id="pauseButtonContainer">
                    <input id="pauseButton" name="pauseButton" type="button" onClick="pauseButtonPressed()" return false;>
            	</div>
                <div id="nextButtonContainer">
                    <input id="nextButton" name="nextButton" type="button" onClick="nextButtonPressed()" return false;>
            	</div>
            </form>
        </div>
        <div id="infoContainer">
        	<img src="Images/eatmeme_info.png" alt="eatMeme">
		</div>
        <div id="contactContainer">
        	<a href="Views/contact.php">Contact Us!</a>
		</div>
        <div id="howToContainer">
        	<a href="Views/howTo.php">What is this?</a>
		</div>
	</div>
    
    <div id="infiniteScroller">
    	<ul id="payloadQueue">            
            
        </ul>
	</div>
    
    <div id="rightSideBar">
	</div>
    
    
</div>


</body>
</html>