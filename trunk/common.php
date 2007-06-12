<?php
define('ROOT', dirname(__FILE__));
define('BIN', ROOT . '/bin');

if (!@include('config.php')) {
	die('please make a config.php file (based on config.php.default)');
}

function random($length) {
	$r = '';
	$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '+', '=', '[', ']', '{', '}', '|', '\'', '"', ':', ';', ',', '.', '<', '>', '/', '?', '`', '~');
	for ($i=0; $i<$length; $i++) {
		$r .= $chars[rand(0, count($chars))];
	}
	return $r;
}
?>
