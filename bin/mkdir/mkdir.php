<?php
function htsh_mkdir($args) {
	if (isset($args['params'][0])) {
		foreach ($args['params'] as $dir) {
			if (!mkdir($dir)) {
				return array('result' => "Error: I can't do that.");
			}
		}
		return array('result' => '');
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "Usage: mkdir DIRECTORY...\nCreate the DIRECTORY(ies), if they do not already exist.");
	} else {
		return array('result' => 'mkdir --help for help');
	}
}
?>