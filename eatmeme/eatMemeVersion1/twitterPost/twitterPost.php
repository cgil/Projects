<?php
// Use Matt Harris' OAuth library to make the connection
// This lives at: https://github.com/themattharris/tmhOAuth
require_once('tmhOAuth/tmhOAuth.php');

function post_tweet($tweet_text, $inReplyToID) {

  // Set the authorization values
  // In keeping with the OAuth tradition of maximum confusion, 
  // the names of some of these values are different from the Twitter Dev interface
  // user_token is called Access Token on the Dev site
  // user_secret is called Access Token Secret on the Dev site
  // The values here have asterisks to hide the true contents 
  // You need to use the actual values from Twitter
  $connection = new tmhOAuth(array(
    'consumer_key' => 'Sk2EpqoByU9g013EIbIhAA',
    'consumer_secret' => 'bTMmzKGpWMTBsLoQ65RXn7XKEAivpIgJ6penFtSNWA',
    'user_token' => '636121902-0wlN0qJ02omhRarzeMMhfWQbzubFNvAiqmWaG6Ep',
    'user_secret' => 'JuEVrzeuBLkyofUZzXZbVnEMuvMs691euNfTKUVA',
  )); 
  
  // Make the API call
  $connection->request('POST', 
    $connection->url('1/statuses/update'), 
    array('status' => $tweet_text));
  
  return $connection->response['code'];
}
?>