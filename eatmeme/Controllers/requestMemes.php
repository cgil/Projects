<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"]);
//Track visitors on the page
require_once('Controllers/siteAnalytics.php');
trackVisitors();
/******************************************************************************/

require_once("Common/curl_download.php");

//Form the URL
function formURL($term, $pageSize)
{
	$baseMemeGeneratorURL = "http://version1.api.memegenerator.net/Generators_Search?q=";
	$memeGeneratorSearchOptions = "&pageIndex=0&pageSize=".$pageSize;
	$memeURL = $baseMemeGeneratorURL . $term . $memeGeneratorSearchOptions;
	return $memeURL;
}

//Get the top Image from the memeGenerator response
function getMemeInfo($generatorValues)
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

			if ($meme->instancesCount > $topInstancesCount)
			{
				$topInstancesCount = $meme->instancesCount;
				$topImageURL = $meme->imageUrl;
				
			}	
		}
		$topMemeInfo[0] = $topInstancesCount;
		$topMemeInfo[1] = $topImageURL;
	
		return $topMemeInfo;
		
	}
	else //Error in response or empty
	{
		error_log("No memes found for keyword", 0);
		return NULL;
	}
}

function getMeme($keyword, $pageSize)
{
	//Get memeGenerator values
	$searchURL = formURL($keyword, $pageSize);
	$generatorValues = json_decode((curl_download($searchURL)));
	$memeInfo = getMemeInfo($generatorValues);
	
	return $memeInfo;
	
}

//Get memes array
$requestTerms = $_REQUEST["terms"];
$pageSize = $_REQUEST["pageSize"];

$terms = explode(" ", $requestTerms);
$memes = array();

foreach ($terms as $term)
{
	$memeInfo = getMeme($term, $pageSize);
	if ($memeInfo[1] != NULL)
	{
		array_push($memes,$memeInfo);
	}
}

echo json_encode($memes);

?>