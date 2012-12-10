
//Controls the payloads in the infinityScroller page and displays a new meme object on page
function updatePage() 
{ 
	if (twitterQuery != null && twitterQuery != "")
	{
		//get a tweet from the twitter queue
		var tweetObj = getOneNewTweet(twitterQuery);
		if (tweetObj)
		{
			tweetObj.cleanText = cleanTweet(tweetObj.text);
			
			if (tweetObj.cleanText != null)
			{
				
				injectIntoPage(tweetObj,pageSize, recentMemes);
				
			}
			else
			{
				updatePage();
			}
		}
	}

}


//Clean the tweet by parsing out unwanted things such as replys or hashtags
function cleanTweet(_rawTweet)
{
	var escape_chars = Array("\"","/", "\\", "'", "#", "@");
	var safeTweet = _rawTweet;
	
	//Remove @user replys
	safeTweet = safeTweet.replace(/@[^\s]*/g, "");
	
	//Remove URLs
	safeTweet = safeTweet.replace(/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/g, "");
	
	//Remove unsafe characters not in the whitelist below
	safeTweet = safeTweet.replace(/[^A-Za-z-_0-9!.?=,+ ]/g, "")
	
	//remove extra whitespace
	safeTweet = safeTweet.replace(/\s+/g, " ");
	
	//remove RT
	safeTweet = safeTweet.replace(/RT /g, " ");
	
	return safeTweet;
}