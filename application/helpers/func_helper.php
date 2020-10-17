<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('recursive_array_search'))
{
	function recursive_array_search($needle, $haystack, $currentKey = '') {
		foreach($haystack as $key=>$value) {
			if (is_array($value)) {
				$nextKey = recursive_array_search($needle,$value, $currentKey . '[' . $key . ']');
				if ($nextKey) {
					return $nextKey;
				}
			}
			else if($value==$needle) {
				return is_numeric($key) ? $currentKey . '[' .$key . ']' : $currentKey;
			}
		}
		return false;
	}
}


?>