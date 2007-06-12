<?php
function htsh_mv($args) {
	if (isset($args['params'][0]) && isset($args['params'][1])) {
		if (@rename($args['params'][0], $args['params'][1])) {
			return array('result' => '');
		} else {
			return array('result' => 'Move failed.');
		}
	} elseif (isset($args['options'][0]) && (($args['options'][0] == '-h') || ($args['options'][0] == '--help'))) {
		return array('result' => "Usage: mv SOURCE DEST\n  or: mv SOURCE DIRECTORY\nRename SOURCE to DEST, or move SOURCE to DIRECTORY.");
	} else {
		return array('result' =>'mv --help for help');
	}
}
?>