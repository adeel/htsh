<?php
function htsh_ls($args) {
	if (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => "Usage: ls [DIRECTORY]\nLists files in DIRECTORY or current directory if not specified.");
	}
	$counter = 0;
	if (isset($args['params'][0])) {
		if (!is_dir($args['params'][0]) || !chdir($args['params'][0])) {
			return array('result' => "Error: I can't do that (does that directory even exist?).");
		}
	}
	if (in_array('-a', $args['options'])) {
		$files = glob('{,.}*', GLOB_BRACE);
	} else {
		$files = glob('*');
	}
	if (count($files) == 0) return array('result' => '');
	foreach ($files as $file) {
		$counter++;
		if (is_dir($file)) {
			$file .= '/';
			$file = '<span style="color:#cdea89">' . $file . '</span>';
		} else {
			$file = '<span style="color:#aabdfd">' . $file . '</span>';
		}
		$output .= $file . "\t";
		if (($counter % 6) == 5) {
			$output .= "\n";
		}
	}
	chdir($_SESSION['htsh']['cwd']);
	return array('result' => $output);
}
?>
