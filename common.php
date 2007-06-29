<?php
/**
 * htsh: http shell
 * Copyright (C) 2007 Adeel Khan <adeel@mathideas.org>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

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

if (!function_exists('json_encode')) {
	function json_encode($value) {
		@require_once('json/FastJSON.class.php');
		return FastJSON::encode($value);
	}
}

function error($error) {
	exit(json_encode(array('error' => $error)));
}
?>
