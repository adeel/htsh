<?php
function htsh_chmod($args) {
	if (isset($args['params'][0]) && isset($args['params'][1])) {
		$mode = intval($args['params'][0], 8);
		if (!$mode) return array('result' => 'Invalid mode.');
		foreach (array_slice($args['params'], 1) as $param) { 
			$files = glob($param);
			foreach ($files as $file) {
				if (in_array('-R', $args['options']) || in_array('--recursive', $args['options'])) {
					if (!chmod_r($file, $mode)) {
						return array('result' => "Error: I could not chmod {$file}.");
					}
				}
				if (!chmod($file, $mode)) {
					return array('result' => "Error: I could not chmod {$file}.");
				}
			}
		}
		return array('result' => '');
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "chmod [OPTION]... OCTAL-MODE FILE...\nChange the mode of each FILE to OCTAL-MODE.\n\n  -R, --recursive\tchange files and directories recursively");
	} else {
		return array('result' => 'chmod --help for help');
	}
}

function chmod_r($path, $mode) {
	if (!is_dir($path)) return chmod($path, $mode);

	$dh = opendir($path);
	while ($file = readdir($dh)) {
		if ($file != '.' && $file != '..') {
			$fullpath = $path . '/' . $file;
			if (!is_dir($fullpath)) {
				if (!chmod($fullpath, $mode)) return false;
			} else {
				if (!chmod_r($fullpath, $mode)) return false;
			}
		}
	}

	closedir($dh);

	if (chmod($path, $filemode)) return true;
	else return false;
}
?>