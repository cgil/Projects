//returns a formed url to pass to the php file that curls
function createTweetQuery(_term, _rpp, _pageNum)
{
	var baseUrl = "Controllers/requestTweets.php?q=".concat(_term);
	
	var rppArg = "&rpp=10";
	if (_rpp != null)
	{
		rppArg = "&rpp=".concat(_rpp);
	}
	
	var pageArg = "pageNum=1";
	if (_pageNum != null)
	{
		pageArg = "&pageNum=".concat(_pageNum);
	}
	
	var fullUrl = baseUrl.concat(pageArg).concat(rppArg);
	return fullUrl;
}

//returns one new tweet from the tweet queue and repopulates if necessary
function getOneNewTweet(searchParam)
{
	//alert(searchParam);
	var newTweets = getOneNewTweet.tweetQueue;
	if ( typeof getOneNewTweet.tweetQueue == 'undefined' ) {
        // It has not... perform the initilization
        getOneNewTweet.tweetQueue = [];
        getOneNewTweet.prevParam = searchParam;
    }
    
    //if a new search term comes in, reset the queue
    if (getOneNewTweet.prevParam != searchParam)
    {
    	getOneNewTweet.tweetQueue = [];
        getOneNewTweet.prevParam = searchParam;
    }
	
	//if the queue is empty
	if (getOneNewTweet.tweetQueue.length == 0)
	{
		fetchNewTweets(searchParam);
	}

	var returnTweet = getOneNewTweet.tweetQueue.pop();
	
	//fetch as soon as you run out to keep things speedy
	if (getOneNewTweet.tweetQueue.length == 0)
	{
		fetchNewTweets(searchParam);
	}
	
	return returnTweet;
}

//fetches a set of new tweets and appends them to getOneNewTweets queue
function fetchNewTweets(searchParam)
{
	if ( typeof fetchNewTweets.pageNum == 'undefined' ) 
	{
        // first time through, perform the initilization
        fetchNewTweets.pageNum = 1;
        fetchNewTweets.prevParam = searchParam;
    }
    
    //if its a new query, restart pageNum
    if (searchParam != fetchNewTweets.prevParam)
    {
    	fetchNewTweets.pageNum = 1;
    }
    
    var url = createTweetQuery(searchParam, null, fetchNewTweets.pageNum);
    ajax_simple_get(url, "", false, function (_responseText)
		{
			var tweetArray = jQuery.parseJSON(_responseText);
			if (tweetArray != null)
			{
				for (index in tweetArray)
				{
					getOneNewTweet.tweetQueue.unshift(tweetArray[index]);
				}
			}
		});
		
	fetchNewTweets.pageNum++;
}