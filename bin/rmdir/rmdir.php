<?php
function htsh_rmdir($args) {
	if (isset($args['params'][0])) {
		foreach ($args['params'] as $dir) {
			if (!rmdir($dir)) {
				return array('result' => "Error: I could not remove {$dir}.");
			}
		}
		return array('result' => '');
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "Usage: rmdir [OPTION]... DIRECTORY...\nRemove the DIRECTORY(ies), if they are empty.");
	} else {
		return array('result' => 'rmdir --help for help');
	}
}
?>