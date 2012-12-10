<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>eatMeme</title>

<link rel="stylesheet" href="../popupjquery/general.css" type="text/css" media="screen" />
<link href="../CSS/browse.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="../common/ajax_helper.js" type="text/javascript"></script>
<script src="../popupjquery/popup.js" type="text/javascript"></script>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script src="../twitterFeed.js" type="text/javascript"></script>
<script type="text/javascript">

function addToGrid(newMeme)
{ 
	var data = "<li class=\"gridImage\">" + newMeme + "</li>";
	$("#gridList").prepend(data);
	
	$('#gridList li:last').remove();
}

function memePopup(tweetLink, memeImage)
{
	//ajax_simple_get(tweetLink);
	
	//centering with css
	centerPopup(memeImage);
	//load popup
	loadPopup();
				
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	
	//submit tweet
	$("#tweet_button").click(function(){
		ajax_simple_get(tweetLink);
	});
	

}

</script>

</head>
<body>
	
	<div class="browsePage_content">
    	<div class="search_content">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        	<div class="searchbox"><input type="text" name="q" id="searchbox"></div>
			<div class="searchbutton">
            		<input id="fiestButton" name="fiestButton" type="submit">
            </div>
        </form>
        </div>
        
        <div class="feed_content">
        </div>
        
        <div id="main_content">
        
        	<div id="memeGrid">
            	<ul id="gridList">
                	<li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>
                    <li class="gridImage"></li>

                </ul>
            </div>
        
        </div>
        
        
       <!-- popup for meme image-->
       <div id="popupContact">
            <a id="popupContactClose"></a>
            <div id="contactArea">
               
            </div>
            <div class="searchbutton">
            		<input id="tweet_button" type="button" name="Tweet" onClick="javascript:void(0);" return false;>
            </div>
            <p id="tweet_label">
            	Press to share with eatMeme stream
            </p>
            
        </div>
        <div id="backgroundPopup"></div>
        
        
    </div>
    
    <?php 
		$phrase = $_POST['q'];
		if ($phrase != NULL)
		{
			require_once("../main/main.php");
			$gridMemes = array("");
			$recentlyUsedMemeIDs = array("");
			$usedTweets = array("");
			
				mainLoop($phrase, $gridMemes, $recentlyUsedMemeIDs, $usedTweets);
			
		}
	?>
    
</body>
</html>
