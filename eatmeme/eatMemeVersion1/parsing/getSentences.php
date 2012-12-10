<?php

//Simple text parser into sentences

function getSentences($text)
{	
	if ($text != NULL)
	{
		//Add a period to end of sentence if not already there
		$lastChar = $text[strlen($text)-1];
		if (($lastChar != '.') && ($lastChar != '!') && ($lastChar != '?' ))
		{
			$text[strlen($text)] = '.';
		}
		
		//Parse that text store to: $sentences array
		preg_match_all('~.*?[?.!]~s',$text,$sentences);
		return $sentences[0];
	}
	else
	{
		return NULL;	
	}

}


?>