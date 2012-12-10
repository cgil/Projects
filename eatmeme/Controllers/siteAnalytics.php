<?php
require_once('Models/site_analytics.php');

//Returns the clients ip address 
function getClientIPAdress()
{
	$ip; 
	if (getenv("HTTP_CLIENT_IP")) 
	{
		$ip = getenv("HTTP_CLIENT_IP");
	}
	else if (getenv("HTTP_X_FORWARDED_FOR")) 
	{
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	}
	else if (getenv("REMOTE_ADDR")) 
	{
		$ip = getenv("REMOTE_ADDR"); 
	}
	else 
	{
		$ip = NULL;
	}
	
	return $ip; 
}

//Track the users who visit the page
function trackVisitors()
{
	$clientIP = getClientIPAdress();
	
	if (($clientIP != NULL) && !searchForUser($clientIP))
	{
		insertNewVisitor($clientIP);
	}
}

//Returns how many Unique visitors have visited the page
function getTotalUniqueVisitors()
{
	return getVisitorsCount();
}

?>