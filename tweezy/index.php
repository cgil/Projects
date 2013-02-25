<?php

$quote_array	= array ("Tweezus walks.",
						"Tweezy taught you well",
						"I'm my favorite Rapper",
						"That shit cray!",
						"I'm definitely in my zone...",
						"Imma let you finish...");
$Tweezy_quote = $quote_array[rand(0, 5)];

?><head>
<meta charset="UTF-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="Javascript/source.js"></script>
<script type="text/javascript" src="Common/ajax_helper.js"></script>
<script type="text/javascript" src="Javascript/fetchTweet.js"></script>
<script type="text/javascript" src="Javascript/cleanTweets.js"></script>
<script type="text/javascript" src="Javascript/findARhyme.js"></script>
<script type="text/javascript" src="Javascript/brain.js"></script>
<script type="text/javascript" src="Javascript/getSounds.js"></script>
<script type="text/javascript" src="mespeak/mespeak.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">

<script type="text/javascript">
recentMemes = [];
payloadId = 0;
pageSize = 15;
payloadQueue = [];
maxPayloadsPerPage = 5;
twitterQuery = "";
willUpdatePage = false;
usedTweets = [];
usedRhymes = [];
maxCount = 15;

var options = new Object();
options.amplitude = 100;
options.pitch = 50;
options.wordgap = 0;
options.speed = 150;
//meSpeak.loadConfig("mespeak/mespeak_config.json");
//meSpeak.loadVoice("mespeak/voices/en/en-us.json");

soundArray = [];
rapArray = [];

//Get some new tweets
tweetArray = [];

tipsy = new Audio("02-j-kwon-tipsy_(instrumental).mp3");
			$(tipsy).load( function ()
			{
			});
tipsy.volume = .7;

</script>

</head>



<div class="app-container">
	<div class="text-container">
		<h2>Tweezy</h2>
		<h3><? echo "\"".$Tweezy_quote."\""; ?></h3>
	</div>
		<div id="thought_div" class="thought_class">
			<img class = "thought_bubble"src="images/tweezy_thoughts.png" alt="thoughts" width="640px" height="480px">
			<input id="thought_input" class="thought" placeholder="#YOLO"/>
		</div>

	<div id="speech_div" class="speech_class">
		<img class="speech_bubble" src="images/tweezy_speech.png" alt="speech" width="640px" height="480px">
		<p id="speech_output" class="speech" ></p>
	</div>

	<img class="tweezy" src="images/tweezy_bird.png" alt="tweezy" width="640px" height="480px">
<div id="social-share" style="float:right; position:absolute; bottom:0;"></div>
</div>
