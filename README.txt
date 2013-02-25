Created by:
Carlos Gil
Electrical and Engineering 
Carnegie Mellon University
cgil@andrew.cmu.edu
www.gilventures.com

Public version of a few projects as source code demos:
-These are samples not complete projects and may not be up-to-date with current versions of these projects.

Tweezy:
Tweezy the twitter rapper! Search for a popular hashtag and Tweezy will scrub twitter and make a a rap song on the fly. The propblem with Tweezy right now comes from the difficulty of forming meaningful rhyming lyrics from a slow twitter stream. This can be fixed by storing a few thousands Tweets ahead beforehand, running and preemtively indexing them agaisnt a rhyming dictionary. Updates to come.  

evolution:
The start of an evolution simulator.
I began writting this just for fun to test a few different algorithms. There are large blobs that are prey
and a bunch of tiny oodles that hunt and eat the blobs. If I keep working on this in the future I'll try
making a sustainable online environment or shift focus to creating a cool screensaver.

eatMeme:
Eatmeme tries to create funny memes out of tweets on the fly.
This website allows users to search for a twitter hashtag or a phrase. We then take that input and parse it to form
twitter queries. I take the top twitter results and remove what I consider to be bad content and then query the
resulting phrase against a popular meme generator website. I take the best match to the phrase and form a meme  
with the text overlay on top of the image.
Mostly written in Javascript using JQuery and a PHP backend. 

livecrowd:
Crowdsourcing of video feeds for 3d representation of events based on location and orientation of camera feed.
Uses an Android app to track user GPS location and Ustream API to keep
position live video feeds around an event based on location.
-Android_GPS_APP: An Android application that runs as a service, created to
upload your gps coordinates to our livecrowd database while using our app.


friendscope:
Application that publicly display all user's Facebook Friends and allows you to view private pictures regardless of friendship status.
This utilizes a gap in Facebook's privacy policy and the Facebook API to grab
all application user's friend's and keep active access tokens for later use.
Other information is also available.
The demo for this version is "OFF" and not available for public use due to privacy concerns, play with it at your own disclosure.

Blobs:
Ongoing browser based evolution simulator.
This is the initial demo as a proof of concept.
Click to add Blobs, blobs have an outer radius of "vision".
Blobs of the same color group together and move away from other
colored Blobs.
Created in Processing and translatted using Processing.js.


Contacts:
Contacts is a project created within a week. 
Contacts is an RFID reader designed to be held as a wristwatch.
Two people wearing these stylish watches can exchange contact information,
emails, or any other information with the shake of a hand.
This involves the use of an RFID reader module, RFID tags, and Zigbee module for
wifi capabilities on an integrated circuit board.
These different components talk via Arduino and are processed via Processing.
We hope to demo this later on in the year as an actual watch and using 
high frequency readers and an online database.

events:
One of my earliest projects.
Takes in event information from Twitter and Yahoo Query Language feeds
and maps these events onto a Google map. Gives the event a radius
based on popularity and how many people are talking about that event.
Also is supposed to look up new events based on both your location and 
user added events. 
This uses Google map API, Twitter API, YQL, and Jquery, sitting ontop of PHP.
Very easly project that has several bugs overall. I scrapped this project 
until I had a more interesting use for it in the future.

Demo's of these and other projects as well as my blog can be found at:
http://www.gilventures.com
