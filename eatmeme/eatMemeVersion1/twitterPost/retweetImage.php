<?php

require_once("twitterPost.php");
require_once("twitPic/TwitPic.php");
require_once("../twitterFeed/twitterFeed.php");
require_once("../memeHandler/memeWrite.php");

$imageUrl = $_GET["url"];
$line1 = $_GET["line1"];
$line2 = $_GET["line2"];
$tweetId = $_GET["tweetId"];
$tweetUser = $_GET["tweetUser"];

try {
//upload image to imgur
$path = "./temp-".$tweetId.".png";
writeImageToFile($imageUrl, $line1, $line2, $path);

// $data is file data
$api_key = "db0a4f71c6667aa30c91729f8bf87222"; // your TwitPic API key (http://dev.twitpic.com/apps)
$consumer_key = "Sk2EpqoByU9g013EIbIhAA"; // your Twitter application consumer key
$consumer_secret = "bTMmzKGpWMTBsLoQ65RXn7XKEAivpIgJ6penFtSNWA"; // your Twitter application consumer secret
$oauth_token = "636121902-0wlN0qJ02omhRarzeMMhfWQbzubFNvAiqmWaG6Ep"; // the user's OAuth token (retrieved after they log into Twitter and auth there)
$oauth_secret = "JuEVrzeuBLkyofUZzXZbVnEMuvMs691euNfTKUVA"; // the user's OAuth secret (also from Twitter login)


$twitpic = new TwitPic($api_key, $consumer_key, $consumer_secret, $oauth_token, $oauth_secret);
$resp = $twitpic->upload(array('media'=>$path, 'message'=>'http://twitter.com/' . $tweetUser . '/status/' . $tweetId));

$picUrl = $resp->url;
unlink($path);

} catch (TwitPicAPIException $e) {

	echo $e->getMessage();

}

echo post_tweet($tweetUser . ": " . $picUrl . "  made by #eatMeme", $tweetId);


?>