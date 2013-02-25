function findRhymes(_term, _rhyme, _count) {
	if (typeof findRhymes.rhymeArray == 'undefined') {
		findRhymes.baseWord = _rhyme;
		findRhymes.rhymeArray = null;
	}
	//remove RT
	_rhyme = _rhyme.replace(/#/g, "");
	var url = "http://rhymebrain.com/talk?function=getRhymes&word=".concat(_rhyme);
	findRhymes.rhymeArray = [];
	ajax_simple_get(url, "", false, function (_responseText)
		{
			var response = jQuery.parseJSON(_responseText);
			findRhymes.baseWord = _rhyme;
			findRhymes.rhymeArray = response;
			//Next Step
			collectTweets(_term, _rhyme, _count);
			
		});
	
}

function getRhymingWords(_term, _rhyme, _count) {
	findRhymes(_term, _rhyme, _count);
}


function findRhymingTweet(rhyme, subject) {
	findRhymes(rhyme);
	var tweetOut = null;
	
	for (i = 0; i < findRhymes.rhymeArray.length; i++) {
		
		fetchNewTweets(subject.concat(" ").concat(rhyme));
		
		for ( t = 0; t < tweetArray.length; t++) {
			var curTweet = tweetArray[t];
			
			var parts = curTweet.split(" ");
			idx = jQuery.inArray(rhyme, parts);
			if ((idx < 5 && parts.length > 5) || idx == -1) continue;
			
			tweetOut = parts[0];
			for ( j = 1; j < idx; j++)
				tweetOut.concat(" ").concat(parts[j]);
			break;
		}
		
		if (tweetOut != null)
			return tweetOut;
	}
	return "whoops";

}