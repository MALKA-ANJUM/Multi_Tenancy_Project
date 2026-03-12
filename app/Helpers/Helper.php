<?php 


//String Format Function
function formatString($string){
    $string = trim($string, '/');

    // Replace special characters (., _, -) and slashes with a space
    $string = preg_replace('/[._\-\/]+/', ' ', $string);

    // Capitalize each word
    $formattedString = ucwords($string);

    // Remove the first word
    $formattedString = preg_replace('/^\w+\s/', '', $formattedString);

    return $formattedString;
}

function cleanString($string)
{
    // remove zero-width & non-printable characters
    $string = preg_replace('/[\x00-\x1F\x7F\xA0\x{200B}-\x{200D}\x{FEFF}]/u', '', $string);

    return trim($string);
}