function pauseButtonPressed()
{
	willUpdatePage = !willUpdatePage;
	setPauseButtonImage();
}

function nextButtonPressed()
{
	willUpdatePage = false;
	setPauseButtonImage();
	updatePage();	
}

function setPauseButtonImage()
{	
	$(function() {
		if (willUpdatePage)
		{
			$('#pauseButtonContainer input').css('background', 'url(/Images/pause_button.png)'); 
			$('#pauseButtonContainer input').css('background-size', '100%');
			updatePage();
		}
		else
		{
			$('#pauseButtonContainer input').css('background', 'url(/Images/play_button.png)'); 
			$('#pauseButtonContainer input').css('background-size', '100%');
		}
	  
	});	
	
	
}

function newQueryRequest(_form)
{
	if (_form.searchBox.value != null)
	{
		twitterQuery = _form.searchBox.value;
		willUpdatePage = false;
		setPauseButtonImage();
		updatePage();
	}
	return false;
}

//Editing payload began
function editButtonPressed(_payloadID)
{
	//Remove edit button
	$('#edit_'+_payloadID).remove();
	
	//Expand the share container
	var currentHeight = $('#share_'+_payloadID).height();
	$('#share_'+_payloadID).height(currentHeight + 50);
	
	//Add text container add the done button
	$('#share_'+_payloadID).append('<div class="editTextContainer"><textarea rows="3" cols="70" id="newText_' + _payloadID +'" name="newText" /></textarea></div>' +
	'<input class="doneButton" id="done_' + _payloadID +'" name="doneButton" type="button" onClick="doneButtonPressed('+ _payloadID +')" return false;>');
	
	//Get current meme text
	var memeText = getMemeTextForId(_payloadID);
	
	//Append meme text into text area
	$('#newText_'+_payloadID).val(memeText);

	
}

//Get the meme text for the payload with given id
function getMemeTextForId(_payloadID)
{
	var payload = findPayloadById(_payloadID);
	if ( payload.cleanText)
	{
		return payload.cleanText;
	}
	else
	{
		return "";	
	}
	
}

//Done editing payload
function doneButtonPressed(_payloadID)
{
	//Grab textarea value
	var text = $('textarea#newText_'+_payloadID).val();
	
	var oldPayloadObj = findPayloadById(_payloadID);
	
	//Set new cleanText for new payload
	var newPayloadObj = new Object();
	newPayloadObj.cleanText = text;
	
	//Set new cleanText for payload
	newPayloadObj.cleanText = text;
	
	//Hand off the new payload
	preparePayload(newPayloadObj, oldPayloadObj.memeBackground);
	
}

//Find the payload by id
function findPayloadById(_payloadID)
{
	var payload = null;
	var payloadLength = payloadQueue.length;
	
	for (var i =0; i < payloadLength; i++)
	{
		if (payloadQueue[i].id == _payloadID)
		{
			payload = payloadQueue[i];	
		}
		
	}	
	
	return payload;
}