//returns the top (count) memeURLs for the given text and recently used memes
function injectIntoPage(_tweetObj, _count, _recentMemes)
{
	
	var searchTerms = getSearchTermsFromText(_tweetObj.cleanText);
	var requestTerm = concatinateSearchTerms(searchTerms);
	
	if (requestTerm != null)
	{
		var url = createMemeQuery(requestTerm, _count);
		
		ajax_simple_get(url, "", false, function (_responseText)
		{
			var memesArray = jQuery.parseJSON(_responseText);
			if (memesArray[0] != null)
			{
				//Got a good reponse/array with meme info [hits,image url]
				var memeBackground = getBestMeme(memesArray, _recentMemes);			
				preparePayload(_tweetObj, memeBackground);
			}
		
		});
	}
}

//Prepare a payload and push it
function preparePayload(_tweetObj, _memeBackground)
{
	var lines = splitTweetIntoLines(_tweetObj.cleanText);
	var memeUrl = createMemeImageUrl(_memeBackground, lines[0], lines[1]);
	
	_tweetObj.memeBackground = _memeBackground;
	_tweetObj.meme = memeUrl;
	_tweetObj.id = payloadId;
	payloadId++;
	payloadQueue.push(_tweetObj);
	injectNewPayload();
	
}

//Push the new payload into the page
function injectNewPayload()
{
	var inifiniteScrollQueue = $('#infiniteScroller #payloadQueue');
	
	var newPayload = payloadQueue[payloadQueue.length - 1];
	newPayload.meme.replace(/ /g,"+");
	newPayload.meme.replace(/(%20)/g,"+");
	var payloadHtml = '<li id="payload_'+ newPayload.id  +'">' +
                '<div id="payload_' + newPayload.id +'" class="payloadContainer">' +
                    '<div class="tweetContainer">' +
                    '</div>' +
                    '<div class="memeImageContainer">' +
                    	'<img id="image_' + newPayload.id +'" class="memeImage" src="'+ newPayload.meme + '"></img>' +
                    '</div>' +
                    '<div class="shareContainer" id="share_' + newPayload.id +'" >' +
						'<div class="editButtonContainer">' +
                    		'<input class="editButton" id="edit_' + newPayload.id +'" name="editButton" type="button" onClick="editButtonPressed('+ newPayload.id +')" return false;>' +
            			'</div>' +
                    '</div>' +
                '</div>' +
            '</li>';
	var newScrollQueue = payloadHtml + inifiniteScrollQueue.html();
	
	var imageID = 'image_'+ newPayload.id;
	
	//INSTEAD ANIMATE EVERYTHING DOWN TO MAKE SPACE THEN ADD NEW PAYLOAD
	inifiniteScrollQueue.html(newScrollQueue);
	$(".payloadContainer#payload_"+newPayload.id).css("min-height", 540);
	$("#"+imageID).one('load', function() {
 		 loopIt();
	}).each(function() {
  		if(this.complete)
		{
			 $(this).load();
		}
	}).error(function() { updatePage(); });
			
	cleanUpPayloads();

}

//Clean up and remove very old payloads
function cleanUpPayloads()
{
	if (payloadQueue.length > maxPayloadsPerPage)
	{
		var oldPayload = payloadQueue[0]
		$('#payload_'+oldPayload.id).remove();
		payloadQueue.shift();
	}
}

//returns an array of searchable terms from a given sentence
function getSearchTermsFromText(_text)
{
	var lowerCase = _text.toLowerCase();
	var splitArray = lowerCase.split(" ");
	var searchTerms = [];
	
	for (index in splitArray)
	{
		if (splitArray[index].length >= 3)
		{
			searchTerms.push(splitArray[index]);
		}
	}
	
	return searchTerms;
}

//Create a string seperated by + for the search terms array
function concatinateSearchTerms(_searchTerms)
{
	var concatTerms = _searchTerms.join("+");
	return concatTerms;
}

//creates a meme generator API query using the given term and count per page
function createMemeGeneratorQuery(_searchTerm, _count)
{
	var baseUrl = "http://version1.api.memegenerator.net/Generators_Search?q=".concat(_searchTerm);
	var rpp = "&pageSize=".concat(_count);
	var query = baseUrl.concat(rpp);
	return query;
}


//Create the url to query for memes
function createMemeQuery(_requestTerm, _count)
{
	var baseUrl = "Controllers/requestMemes.php?terms=".concat(_requestTerm);
	var rpp = "&pageSize=".concat(_count);
	var url = baseUrl.concat(rpp);	
	return url;
}

//Go through all the memes and select the best one
function getBestMeme(memes, _recentMemes)
{
	var bestInstancesCount = -1;
	var bestMeme = null;
	for (index in memes)
	{
		var curMeme = memes[index];
		//curMeme[1] is the imageUrl curMeme[0] is instanceCount
		if ($.inArray(curMeme[1], _recentMemes))
		{
			//if no best meme has been selected, still use this one
			if (bestMeme == null)
			{
				bestMeme = curMeme;
				bestInstancesCount = -1;
			}
			continue;
		}
		
		if (curMeme[0] > bestInstancesCount)
		{
			bestMeme = curMeme;
			bestInstancesCount = curMeme[0];
		}
	}
	
	_recentMemes.unshift(bestMeme[1]);
	//magic number that decides how many memes to keep track of
	var memesToKeep = 10;
	if (_recentMemes.length > memesToKeep)
	{
		_recentMemes.pop();
	}
	
	return bestMeme[1];
}

//Create top and bottom of meme text
function splitTweetIntoLines(_cleanTweet)
{
	var midPoint = Math.floor(_cleanTweet.length/2);
	var words = _cleanTweet.split(" ");

	var firstLineWords = [];
	var secondLineWords = [];
	var runningCount = 0;
	
	var midIndex = 0;
	//put the index of the word that contains the middle character in midIndex
	while (midIndex < words.length && runningCount < midPoint)
	{
		runningCount += words[midIndex].length;
		midIndex += 1;
	}
	
	for (index = 0; index < words.length; index++)
	{
		if (index < midIndex)
		{
			firstLineWords.push(words[index]);
		}
		else
		{
			secondLineWords.push(words[index]);
		}
	}
	
	var retArray = Array(2);
	retArray[0] = firstLineWords.join(" ");
	retArray[1] = secondLineWords.join(" ");
	if (retArray[0] == "")
	{
		retArray[0] = '+';	
	}
	if (retArray[1] == "")
	{
		retArray[1] = '+';	
	}
	return retArray;
}

function createMemeImageUrl(_backgroundImage, _firstLine, _secondLine)
{
	var baseUrl = "memeGeneration/memeOverlay.php?url=".concat(_backgroundImage);
	var line1Arg = "&line1=".concat(_firstLine);
	var line2Arg = "&line2=".concat(_secondLine);
	
	return baseUrl.concat(line1Arg).concat(line2Arg);
}
