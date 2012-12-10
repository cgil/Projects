<?php

require_once("../common/curl_download.php");

//Required input
$searchTerm = "SDCC%20:)";

echo $baseMemeGeneratorURL;

//Form the URL
function formTwitterURL($searchTerm, $sinceId, $page)
{
	$baseTwitterFeedURL = "http://search.twitter.com/search.json?q=";
	if ($sinceId != "")
	{
		$sinceArg = "&since_id=" . $sinceId;
	}
	else
	{
		$sinceArg = "";
	}
	
	if ($page > 0)
	{
		$pageArg = "&page=".$page;
	}
	else
	{
		$pageArg = "";
	}
	$resultsPerPageArg = "&rpp=30";
	$entitiesArg = "&include_entities=true";
	$twitSearchURL = $baseTwitterFeedURL . $searchTerm . $pageArg. $sinceArg. $resultsPerPageArg. $entitiesArg;
	return $twitSearchURL;
}

function getTweetsForTerm($keyword)
{
	$searchURL = formTwitterURL($keyword, "", 1);
	$raw = curl_download($searchURL);
	$generatorValues = json_decode($raw);
	$results = $generatorValues->results;
	return $results;
}

function getNewTweetForTerm($keyword, &$usedTweets)
{
	$foundTweet = null;
	$pageNum = 1;
	while (!$foundTweet && $pageNum < 100)
	{
		$searchURL = formTwitterURL($keyword, "", $pageNum);
		$raw = curl_download($searchURL);
		$generatorValues = json_decode($raw);
		$results = $generatorValues->results;
		foreach ($results as $result)
		{
			if (!in_array($result->id_str, $usedTweets))
			{
				$foundTweet = $result;
				array_unshift($usedTweets, $result->id_str);
			}
		}
		$pageNum++;
	}
	return $foundTweet;
}



?>