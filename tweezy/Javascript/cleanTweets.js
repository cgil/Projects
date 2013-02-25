//Clean the tweet by parsing out unwanted things such as replys or hashtags
function cleanTweet(_rawTweet)
{
	var escape_chars = Array("\"","/", "\\", "'", "@");
	var safeTweet = _rawTweet;
	
	//Remove @user replys
	safeTweet = safeTweet.replace(/@[^\s]*/g, "");
	
	//Remove #hashtags and words
	safeTweet = safeTweet.replace(/#[^\s]*/g, "");
	
	//Remove URLs
	safeTweet = safeTweet.replace(/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/g, "");
	
	//Remove unsafe characters not in the whitelist below
	safeTweet = safeTweet.replace(/[^A-Za-z-_0-9 ]/g, "")
	
	//remove extra whitespace
	safeTweet = safeTweet.replace(/\s+/g, " ");
	
	//remove RT
	safeTweet = safeTweet.replace(/RT /g, " ");
	
	//trim that whitespace
	safeTweet = safeTweet.trim();
	
	//lowercase
	safeTweet = safeTweet.toLowerCase();
	
	return safeTweet;
}

function checkLength(_tweet) 
{
	if (_tweet.length > 70 || _tweet.length < 5) {
		return false;	
	}
	else {
		return true;	
	}
	
}

function cleanTweets() 
{
	if (tweetArray != null )
	{
		var tempArray = [];
		for (index in tweetArray)
		{
			var tempTweet = cleanTweet(tweetArray[index]);
			if (tempTweet != null && checkLength(tempTweet) && tempTweet != "" && tempTweet != " ")
			{
				tempArray.push(tempTweet);
			}
			
		}	
		tweetArray = tempArray;
	}
	
}