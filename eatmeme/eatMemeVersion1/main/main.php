<?php

require_once("processTweet.php");
require_once("../twitterFeed/twitterFeed.php");

function mainLoop($searchTerm, &$gridMemes, &$recentlyUsedMemeIDs, &$usedTweets)
{
	if (!$searchTerm)
	{
		$searchTerm = "doofus";
	}
	
	//Bad characters to escape
	$escape_chars = array("\"","/", "\\", "'", "#", "@");


	//Get tweets for a searchterm
	$results = getTweetsForTerm($searchTerm);
	
	//Go through every tweet
	foreach ($results as $tweet)
	{
		if (in_array($tweet->id_str, $usedTweets))
		{
			continue;
		}
		$hashTags = array();
		foreach ($tweet->entities->hashtags as $hashTag)
		{
			array_push($hashTags,$hashTag->text);
		}
		
		array_unshift($usedTweets, $tweet->id_str);
		
		$tweetText = iconv("UTF-8", "ASCII//TRANSLIT", $tweet->text);
		
		//get rid of retweets
		list($origTweeter) = sscanf($tweetText, "RT %s:");
		if ($origTweeter)
		{
			$cutIndex = strlen($origTweeter) + 3;
			$tweetText = substr($tweetText, $cutIndex);
		}
		
		//get rid of @username 
		$atIndex = strpos($tweetText, "@");
		while ($atIndex !== false)
		{
			$endIndex = strpos($tweetText, " ", $atIndex);
			if ($endIndex == false)
			{
				$endIndex = strlen($tweetText);
			}
			$firstPart = substr($tweetText, 0, $atIndex);
			$secondPart = substr($tweetText, $endIndex, (strlen($tweetText) - $endIndex));
			$tweetText = $firstPart.$secondPart;
			$atIndex = strpos($tweetText, "@");
		}
		$escapedTweet = str_replace($escape_chars, "", $tweetText);
		//$noTagsTweet = rtrim( preg_replace('/#[^\s]+\s?/', '', $escapedTweet) );
		$safeTweet = preg_replace('/\b(https?|ftp|file):\/?\/?[-A-Z0-9+&\/%?=~_|$!:,.;]*[A-Z0-9+&\/%=~_|$]/i', '', $escapedTweet);
		
		
		$memeImageUrlTemp = processTweet($safeTweet, $recentlyUsedMemeIDs, $hashTags);
		
		$middle = strrpos(substr($safeTweet, 0, floor(strlen($safeTweet) / 2)), ' ') + 1;
		$firstHalf = substr($safeTweet, 0, $middle);  
		$secondHalf = substr($safeTweet, $middle);  
		
		$memeImageUrl = str_replace("400x","400x400", $memeImageUrlTemp);
		
		$overlayCall = "../memeHandler/memeOverlay.php?url=" . $memeImageUrl."&line1=". $firstHalf . "&line2=" . $secondHalf;
		
		
		$tweetLink = "../twitterPost/retweetImage.php?url=".$memeImageUrl."&line1=".$firstHalf."&line2=".$secondHalf."&tweetId=" . $tweet->id_str."&tweetUser=" . $tweet->from_user;
		$memeImage = "<a onclick=\"memePopup('" . $tweetLink . "','" . $overlayCall ."');\"  return false; href=\"javascript:void(0);\">" 
			. "<img width=\"175\" height=\"190\" src="."\"".$overlayCall."\""."></a>";
			
			
		//Add memes to background grid array
		array_unshift($gridMemes, $memeImage);
		if (count($gridMemes) > 18)
		{
			array_pop($gridMemes);
		}
		//call add image to grid;
		echo "<script type=\"text/javascript\">addToGrid(\"" . addslashes($gridMemes[0]) .  "\");</script>";

	}

}



?>