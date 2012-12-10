<?php

require_once("../common/curl_download.php");

//Form the URL
function formURL($searchTerm)
{
	$baseMemeGeneratorURL = "http://version1.api.memegenerator.net/Generators_Search?q=";
	$memeGeneratorSearchOptions = "&pageIndex=0&pageSize=12";
	$memeURL = $baseMemeGeneratorURL . $searchTerm . $memeGeneratorSearchOptions;
	return $memeURL;
}

//Get the top Image from the memeGenerator response
function getMemeInfo($generatorValues, &$recentlyUsedMemeIDs)
{
	$topImageURL = NULL;
	$topInstancesCount = 0;
	$tempMemeInfo;
	
	//Good response
	if ($generatorValues->success)
	{	
		$result = $generatorValues->result;
		foreach ($result as $meme) 
		{

			if (in_array($meme->imageUrl, $recentlyUsedMemeIDs))
			{
				$tempMemeInfo[0] = $meme->instancesCount;
				$tempMemeInfo[1] = $meme->imageUrl;
				continue;
			}
			else
			{
				if ($meme->instancesCount > $topInstancesCount)
				{
					$topInstancesCount = $meme->instancesCount;
					$topImageURL = $meme->imageUrl;
					
				}	
			}
		}
		$topMemeInfo[0] = $topInstancesCount;
		$topMemeInfo[1] = $topImageURL;
		
		if (($topMemeInfo == NULL) && ($tempMemeInfo != NULL))
		{
			$topMemeInfo = $tempMemeInfo;
		}
		
		return $topMemeInfo;
		
	}
	else //Error in response or empty
	{
		error_log("No memes found for keyword", 0);
		return NULL;
	}
}

function getMeme($keyword, &$recentlyUsedMemeIDs)
{
	//Get memeGenerator values
	$searchURL = formURL($keyword);
	$generatorValues = json_decode((curl_download($searchURL)));
	$memeInfo = getMemeInfo($generatorValues, $recentlyUsedMemeIDs);
	
	return $memeInfo;
	
}


?>