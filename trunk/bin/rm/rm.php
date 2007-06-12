<?php
function htsh_rm($args) {
	if (isset($args['params'][0])) {
		foreach ($args['params'] as $param) {
			$files = glob($param);
			foreach ($files as $file) {
				if (is_dir($file) && (in_array('-R', $args['options']) || in_array('--recursive', $args['options']))) {
					// recursive
					if (!rm_r($file)) {
						return array('result' => "Error: I could not remove {$file}.");
					} else {
						return array('result' => '');
					}
				}
				if (!unlink($file)) {
					return array('result' => "Error: I could not remove {$file}.");
				}
			}
		}
		return array('result' => '');
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "Usage: rm [OPTION]... FILE...\nRemove (unlink) the FILE(s).\n\n  -R, --recursive\tremove directories and their contents recursively\n\nrm does not remove directories unless the --recursive option is used.\n\nTo remove a file whose name starts with a `-', for example `-foo', use `rm ./-foo'.");
	} else {
		return array('result' => 'rm --help for help');
	}
}

function rm_r($path) {
	if (substr($path, -1, 1) != "/") {
		$path .= "/";
	}
	foreach (glob($path . "*") as $file) {
		if (is_file($file) === true) {
			@unlink($file);
		}
		elseif (is_dir($file) === true) {
			if(rmdir($file) === false) {
				return false;
			}
		}
	}
	if (is_dir($path) === true) {
		if(rmdir($path) === false) {
			return false;
		}
	}
	return true;
}
?>