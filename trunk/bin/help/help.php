<?php
function htsh_help() {
	$counter = 0;
	$output = "Available commands:\n";
	$commands = glob(BIN . '/*', GLOB_ONLYDIR);
	foreach ($commands as $command) {
		$command = str_replace(BIN . '/', '', $command);
		$output .= $command;
		if (($counter % 5) == 4) {
			$output .= "\n";
		} else {
			$output .= "\t";
		}
		$counter++;
	}
	return array('result' => $output);
}
?>