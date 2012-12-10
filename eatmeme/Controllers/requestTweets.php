<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"]);
//Track visitors on the page
require_once('Controllers/siteAnalytics.php');
trackVisitors();
/******************************************************************************/

require_once("Common/curl_download.php");

function formURL($_term, $_rpp, $_pageNum)
{
	$baseUrl = "http://search.twitter.com/search.json?q=".$_term;
	
	$pageArg = "&page=1";
	if ($_pageNum != NULL)
	{
		$pageArg = "&page=".$_pageNum;
	}
	
	$rppArg = "&rpp=10";
	if ($_rpp != NULL)
	{
		$rppArg = "&rpp=".$_rpp;
	}
	
	$entitiesArg = "&include_entities=true";
	
	$url = $baseUrl.$pageArg.$rppArg.$entitiesArg;
	
	return $url;
}

$searchTerm = $_REQUEST["q"];
$rpp = $_REQUEST["rpp"];
$pageNum = $_REQUEST["pageNum"];

$url = formURL($searchTerm, $rpp, $pageNum);

$rawResults = json_decode((curl_download($url)));

echo json_encode($rawResults->results);

?>