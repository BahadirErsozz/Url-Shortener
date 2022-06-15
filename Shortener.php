<?php   

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{   
    $out = "";
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[(int)fmod($integer, $length)] . $out;
		$integer = (int)floor( $integer / $length );
	}
	return $base[$integer] . $out;
}

?>