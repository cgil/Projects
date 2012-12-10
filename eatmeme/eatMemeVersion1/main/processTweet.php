<?php

require_once("../parsing/getSentences.php");
require_once("../parsing/getWords.php");
require_once("../memeHandler/getMeme.php");

//Process the tweet and get the image for the tweet
function processTweet($tweet, &$recentlyUsedMemeIDs, $hashTags)
{
	
	$sentences = getSentences($tweet);
	
	if ($sentences != NULL)
	{
		$sentences = array_merge($sentences, $hashTags);
		$topSentenceMemeInfo = NULL;

		foreach ($sentences as $sentence) 
		{
			//Get meme for this sentence
			$sentenceMemeInfo = getSentenceMeme($sentence, $recentlyUsedMemeIDs);
			$instanceCount = $sentenceMemeInfo[0];
			if (in_array($sentence, $hashTags))
			{
				$instanceCount *= 40;
			}
			if (($sentenceMemeInfo != NULL) && ($instanceCount > $topSentenceMemeInfo[0]))
			{
				$topSentenceMemeInfo = $sentenceMemeInfo;
			}
		}
		
		if ($topSentenceMemeInfo != NULL)
		  {
			  array_unshift($recentlyUsedMemeIDs, $topSentenceMemeInfo[1]);
			  if (count($recentlyUsedMemeIDs) > 10)
			  {
				  array_pop($recentlyUsedMemeIDs);
			  }
		  }
		  
		//return Image url for meme
		$memeURL = $topSentenceMemeInfo[1];
		
		$resizedImage = resizeImage($memeURL);
		
		return $memeURL;
	}
	else
	{
		return NULL;
	}
}


/***************************Helper Functions******************************************/

//Takes in a sentence and spits back the best meme for that sentence
function getSentenceMeme($sentence, &$recentlyUsedMemeIDs)
{
	$words = getWords($sentence);
	$topMemeInfo = NULL;
	foreach ($words as $keyword)
	{
		//Get the most popular meme
		$memeInfo = getMeme($keyword, $recentlyUsedMemeIDs);
		if (($memeInfo != NULL) && ($memeInfo[0] > $topMemeInfo[0]))
		{
			$topMemeInfo = $memeInfo;	
		}
	}	
		
		if (($topMemeInfo == NULL) && ($tempMemeInfo != NULL))
		{
			$topMemeInfo = $tempMemeInfo;
		}
	
	    
	
	return $topMemeInfo;
}

//Resize the image dimensions
function resizeImage($memeUrl)
{
	$resizedImageUrl =  preg_replace('/400x\//', '400x400/', $memeUrl);
	return $resizedImageUrl;
}



?>