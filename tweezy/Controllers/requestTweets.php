<?php
/*********************** Include this in every PHP page ***********************/
//Set the directory path to file root
set_include_path($_SERVER["DOCUMENT_ROOT"].'/tweezy');
/******************************************************************************/

require_once("Common/curl_download.php");

function formURL($_term, $_rpp, $_pageNum)
{
	$_term = str_replace("#","%23",$_term);
	$_term = str_replace(" ","%20",$_term);
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
	
	$languageArg = "&lang=en";
	
	$url = $baseUrl.$pageArg.$rppArg.$entitiesArg.$languageArg;
	
	return $url;
}

$searchTerm = $_REQUEST["q"];
$rpp = $_REQUEST["rpp"];
$pageNum = $_REQUEST["pageNum"];

$url = formURL($searchTerm, $rpp, $pageNum);

$rawResults = json_decode((curl_download($url)));

echo json_encode($rawResults->results);

?>