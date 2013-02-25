function getSoundURL(text, _term, _rhyme, _count) {
	var baseURL = "Common/curl_download.php";
	var fullURL = baseURL;
	var mp3URL = null;
	var url = "http://tts-api.com/tts.mp3?q=".concat(text).concat("&return_url=1");
	jQuery.post(baseURL, {qString : url },function (_responseText)
		{
			mp3URL = _responseText;
			console.log(mp3URL);
			sound = new Audio(mp3URL);
			$(sound).load( function ()
			{
     			//loadingDone(); // not being called ;(
			});
			storeLine(sound,text, _term, _rhyme, _count);
		});
	return mp3URL;
}

function done(){
		//soundArray_fake[];
		/*rapArray 	= ["IM RAPPING GUYS",
									"I'M REALLY RAPPING!!",
									"SING ALONG WITH ME OR SOME BULLSHIT",
									"JUST KIDDING, THIS IS A TEST. YOU WOULD BE LAME TO SING ALONG WITH THIS"];
		*/
		var randDegrees;
		$("#thought_div").css("visibility","hidden");
	    $("#speech_div").css("visibility","visible");
		
		/*sound = new Audio("../02-j-kwon-tipsy_(instrumental).mp3");
			$(sound).load( function ()
			{
     			//loadingDone(); // not being called ;(
			});*/
		(tipsy).play();
		for (var i=0; i < 4; i++){
			rapLoop(0);
		}
		//setTimeout(function() {rapLoop(count); } , 1000);
		/*
		for (var i=0; i < rapArray.length; i++){
			$("#speech_output").html('<p>'+rapArray[i]+'</p>');
			randDegrees = Math.round(Math.random()*40)-20;
			$("#speech_output").css('transform','rotate('+randDegrees+'deg)');
			//TODO: Make audio play
			*/
		}
	
	function rapLoop (count){
		if (count < rapArray.length){
			//console.log(rapArray);
			$("#speech_output").html('<p>'+rapArray[count]+'</p>');
			//$("#speech_output").txt(rapArray[count);
			randDegrees = Math.round(Math.random()*40)-20;
			$("#speech_output").css('transform','rotate('+randDegrees+'deg)');
			$("#speech_bubble").css('transform','rotate('+randDegrees+'deg)');
			soundArray[count].play();
			$(soundArray[count]).bind("ended", function(){displayRap(count)});
			//setTimeout(function(){rapLoop(count+1);}, 2000);
		}
	}
	
	
	
	function displayRap(count){
		rapLoop(count+1);
	}

function storeLine(sound, text, _term, _rhyme, _count) {
	if(text != null) 
	{
		soundArray.push(sound);
		rapArray.push(text);
	}
	
	if (_count > 0)
		rap(_term, _rhyme, _count);
	else
		done();
}

function demoPrep() {
	soundArray = [];
	rapArray = ["I'm in walmart with no shoes on",
				"Goin till the break o' dawn",
				"just dropped the f bomb in front of my mom",
				"yolo",
				"I dyed a strand of my hair red",
				"I don't care about my street cred",
				"Gonna smoke three weeds before bed",
				"yolo",
				"Just parked in a handicap spot",
				"That must have been 12 jagers I forgot",
				"At least I'll have beer in my hand if I get shot"];
				
	urlArray = ["http://media.tts-api.com/54742d7a55dba7468c2625cb467ca8073d593bba.mp3",
				"http://media.tts-api.com/e509fd984ed0c0a8b657d3c641ec0a8d210efd71.mp3",
				"http://media.tts-api.com/e465bf24979976a9eeb552b4b72d3eeefdd3d942.mp3",
				"http://media.tts-api.com/9d25f3b6ab8cfba5d2d68dc8d062988534a63e87.mp3",
				"http://media.tts-api.com/27880ea64282e3ccd2f99bce5e566894e8b8267c.mp3",
				"http://media.tts-api.com/1338a3e07752efdd6eebc224195b506ca4830f63.mp3",
				"http://media.tts-api.com/1c5ce203185d255ad9c0d4a08eb1d1cbbee10829.mp3",
				"http://media.tts-api.com/9d25f3b6ab8cfba5d2d68dc8d062988534a63e87.mp3",
				"http://media.tts-api.com/5ada5a3c373396363ff57c1cbe70ac8ac9e42523.mp3",
				"http://media.tts-api.com/3f33b3ba8885363248022aaccfaa7ec30b44c889.mp3",
				"http://media.tts-api.com/dffc9d53b6cfefdc2241d14d08c2c8fddc338030.mp3"];
				
	for (i = 0; i < urlArray.length; i++) {
		sound = new Audio(urlArray[i]);
		$(sound).load( function ()
		{
     		//loadingDone(); // not being called ;(
		});
		soundArray.push(sound);
	}
	done();
}