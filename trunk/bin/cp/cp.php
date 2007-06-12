<?php
function htsh_cp($args) {
	if (count($args['params']) == 2) {
		if (@copy($args['params'][0], $args['params'][1])) {
			return array('result' => '');
		} else {
			return array('result' => 'Copy failed.');
		}
	} elseif (isset($args['options'][0]) && (($args['options'][0] == '-h') || ($args['options'][0] == '--help'))) {
		return array('result' => 'Usage: cp SOURCE DEST');
	} else {
		return array('result' => 'cp --help for help');
	}
}
?>