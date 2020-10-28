<?php

/**
 * Helper class to work with string
 */

// check whether a string starts with the target substring
function starts_with($haystack, $needle)
{
	return substr($haystack, 0, strlen($needle))===$needle;
}

// check whether a string ends with the target substring
function ends_with($haystack, $needle)
{
	return substr($haystack, -strlen($needle))===$needle;
}
function lang_param($name){
	if(starts_with($name,'lang:')){
		return lang(substr($name,5));
	}else{
		return $name;
	}
}