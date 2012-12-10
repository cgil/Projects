<?php

//Take in a sentence and split on spaces for words


function getWords($sentence)
{
	$words = explode(" ", $sentence);	
	return $words;
}

?>