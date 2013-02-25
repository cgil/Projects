$( document ).ready(function(){

	$("#thought_input").keydown(function(e){
		if (e.which == 13){
			//console.log(getURLParameter('demo'));
			if (getURLParameter('demo') == 'true'){
				demoPrep();
				return;
			}
			//alert("maybe doing stuff...");
			
			//var randDegrees = Math.round(Math.random()*40)-20;
			//demoPrep();
			
			//Put loading text
			$("#thought_div").css("visibility","hidden");
	    	$("#speech_div").css("visibility","visible");
			$("#speech_output").html('<p>'+'Loading sick '+ $("#thought_input").val() +' rhymes...'+'</p>');
			//start rapping
			rap($("#thought_input").val(), 'NULL', maxCount);
			/*
			$("#thought_div").css("visibility","hidden");
			$("#speech_div").css("visibility","visible");
			$("#speech_output").html("<p>NOW I'M RAPPING!<\p>");
			$("#speech_output").css('transform','rotate('+randDegrees+'deg)');
			*/
			//done();
		}
	});
	
	function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
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
		rapLoop(0);
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
			setTimeout(function(){rapLoop(count+1);}, 2000);
		}
	}
	
	
	
	
});