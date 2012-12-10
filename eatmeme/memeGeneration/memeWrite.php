<?php
function writeImageToFile($imageUrl, $line1, $line2, $path)
{
	try
	{
		$imageSize = getImageSize($imageUrl);
		$imgWidth = $imageSize[0];
		$imgHeight = $imageSize[1];
		// specify the file name - you can use a full path, or "../../" type stuff here
		// if the image is not in the same directory as this code file
		$image = imagecreatefromjpeg($imageUrl);
		
		$edge_offset = 10;
		
		$dimensions1 = array(0,0,0,0);
		$dimensions2 = array(0,0,0,0);
		$maxFontSize = 45;
		
		$line1Size = 10;
		$line2Size = 10;
		
		while ($dimensions1[2] < ($imgWidth - 2*$edge_offset))
		{
			$line1Size++;
			$dimensions1 = imagettfbbox($line1Size, 0, "./font/Impact.ttf", $line1);
		}
		$line1Size--;
		
		while ($dimensions2[2] < ($imgWidth - 2*$edge_offset))
		{
			$line2Size++;
			$dimensions2 = imagettfbbox($line2Size, 0, "./font/Impact.ttf", $line2);
		}
		$line2Size--;
		
		if ($line1Size > $maxFontSize)
		{
			$line1Size = $maxFontSize;
			$dimensions1 = imagettfbbox($line1Size, 0, "./font/Impact.ttf", $line1);
		}
		if ($line2Size > $maxFontSize)
		{
			$line2Size = $maxFontSize;
			$dimensions2 = imagettfbbox($line2Size, 0, "./font/Impact.ttf", $line2);
		}
		
		//echo $line1CharWidth . " 2: " . $line2CharWidth . "<br>";
		// in this case, the color is white, but you can replace the numbers with the RGB values
		// of any color you want
		$color = imagecolorallocate($image, 255,255,255);
		
		// make our drop shadow color
		$black = imagecolorallocate($image, 0,0,0);
		
		//Center the string by calculating surrounding box width
		$width1 = $dimensions1[4] - $dimensions1[6];
		$width2 = $dimensions2[4] - $dimensions2[6];
		
		$fontwidth = imagefontwidth($font);
		$center1 = (imagesx($image)/2) - ($width1/2);
		$center2 = (imagesx($image)/2) - ($width2/2);
		
		
	// Adds the text to the image
		
		// and now we do the overlay - the layers of text start top to bottom, so
		// the drop shadow comes first
		
		ImageTTFText ($image, $line1Size, 0, $center1 , $edge_offset - $dimensions1[7], $black, "./font/Impact.ttf",$line1);
		
		// Now add the actual white text "on top"
		ImageTTFText ($image, $line1Size, 0, $center1 -1, $edge_offset - $dimensions1[7]-1, $color, "./font/Impact.ttf",$line1);
		
		ImageTTFText ($image, $line2Size, 0, $center2, $imgHeight-$edge_offset, $black, "./font/Impact.ttf",$line2);
		
		// Now add the actual white text "on top"
		ImageTTFText ($image, $line2Size, 0, $center2-1, $imgHeight -$edge_offset-1, $color, "./font/Impact.ttf",$line2);
		if ($path)
		{
			$handle = fopen($path, 'w');
			fclose($handle);
			imagejpeg($image, $path, 45);
		}
		else
		{
			if (!headers_sent())
			{
				header("Content-type: image/jpeg");
			}
			imagejpeg($image, NULL, 45);
		}
		
		imagedestroy($image);
	
	}
	catch(Exception $e)
	{
		error_log( 'Caught exception forming meme: ',  $e->getMessage());	
		return NULL;
	}
}


?>