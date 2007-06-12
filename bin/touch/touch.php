<?php
function htsh_touch($args) {
	if (isset($args['params'][0])) {
		foreach ($args['params'] as $file) {
			if (!touch($file)) {
				return array('result' => "Error: Could not touch {$file}.");
			}
		}
		return array('result' => '');
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "Usage: touch FILE...");
	} else {
		return array('result' => 'touch --help for help');
	}
}
?>