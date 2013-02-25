<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>twitter testbed</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="Common/ajax_helper.js"></script>
<script type="text/javascript" src="Javascript/fetchTweet.js"></script>
<script type="text/javascript" src="Javascript/cleanTweets.js"></script>
<script type="text/javascript" src="Javascript/findARhyme.js"></script>
<script type="text/javascript" src="Javascript/brain.js"></script>
<script type="text/javascript" src="Javascript/getSounds.js"></script>
<script type="text/javascript" src="mespeak/mespeak.js"></script>


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
rapArray = [];
soundArray = [];

var options = new Object();
options.amplitude = 100;
options.pitch = 50;
options.wordgap = 0;
options.speed = 150;
meSpeak.loadConfig("mespeak/mespeak_config.json");
meSpeak.loadVoice("mespeak/voices/en/en-us.json");

//Get some new tweets
tweetArray = [];
rap("#free", null, 15);

//getSoundURL("hello is this working?");
//getSoundURL("hihihihihihihi it works");
</script>
</head>

<body>

<audio controls>
<source id="audioplayer" src="" type="audio/mpeg">
</audio>
</body>
</html>