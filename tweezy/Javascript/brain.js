function rap(_term, _rhyme, _count)
{
	_count--;
	var percent = (((maxCount - _count)/maxCount) * 100).toFixed(2);
	$("#speech_output").html('<p>'+'Mashing sick '+ $("#thought_input").val() +' rhymes... '+ percent +'%'+'</p>');
	if (_rhyme == null)
	{
		_rhyme = _term;	
	}
	getRhymingWords(_term, _rhyme, _count);
}

function collectTweets(_term, _rhyme, _count)
{
	tweetArray = [];
	var tempRhymes = findRhymes.rhymeArray;
	var numRhymes = 5;
	for(i = 0; i < tempRhymes.length && tempRhymes[i].word.length > 2  && i < numRhymes; i++ )
	{
		getGoodTweets(_term, tempRhymes[i].word);
	}
	
	var bestTweet = chooseBestTweet();
	if(bestTweet != null)
	{
		console.log(bestTweet);
		//meSpeak.speak(bestTweet, options);
	}
	lastWord = getLastWord(bestTweet);
	
	getSoundURL(bestTweet, _term, lastWord, _count);
		
}


function chooseBestTweet() 
{
	if ( tweetArray.length > 0 )
	{
		var numRhymes = 2;
		for (i = 0; i < tweetArray.length; i++) {
			if (jQuery.inArray(tweetArray[i], usedTweets) > -1)
				continue;
			var y = tweetArray[i];
			var lastWord = tweetArray[i].split(" ").pop();
			if (jQuery.inArray(lastWord, usedRhymes) > -1) 
				continue;
			
			else {
				if (usedRhymes.length >= numRhymes)
					usedRhymes.shift();
				usedRhymes.push(lastWord);
				usedTweets.push(tweetArray[i]);
				return tweetArray[i];
				}
		}
	}
	else
	{
		return null;	
	}
}

function getLastWord(_tweet)
{
	if(_tweet != null && _tweet.length > 0)
	{
		return _tweet.substring(_tweet.lastIndexOf(" ")+1);
	}
	else
	{
		return null;	
	}
}


function getBestRhymingWord(_rhymingWords)
{
	if(_rhymingWords.length > 0) 
	{
		return _rhymingWords[0].word;
	}
	else 
	{
		return null;	
	}
}


function getGoodTweets(_term, _rhyme)
{
	var truncateTerm = _rhyme;
	if(_rhyme == null)
	{
		_rhyme = "";
		truncateTerm = _term;
	}
	for ( var i = 0; i < 5; i++)
	{
		fetchNewTweets(_term.concat(" "+_rhyme));
		cleanTweets();
		truncateToTerm(truncateTerm);
		if ( tweetArray != null)
		{
			break;	
		}
	}
	
	//Found nothing
	if ( tweetArray == null )
	{
		return false;	
	}
	
	return true;	
	
}

function truncateToTerm(_term)
{
	var tempArray = [];
	for (index in tweetArray)
	{
		var tempTweet = tweetArray[index];
		tempTweet = tempTweet.substring(0, tempTweet.indexOf(_term) + _term.length);
		if ( !(jQuery.inArray(tempTweet, tempArray) > -1) && tempTweet.length > 10)
		{
			tempArray.push(tempTweet);
		}
			
		else if(!(jQuery.inArray(tweetArray[index], tempArray) > -1) && tweetArray[index].length < 70	)
		{
			tempArray.push(tweetArray[index]);
		}
		
	}	
	tweetArray = tempArray;
}
