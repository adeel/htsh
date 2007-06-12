<?php
function htsh_cd($args) {
	if (isset($args['params'][0])) {
		if (is_dir($args['params'][0]) && @chdir($args['params'][0])) {
			$_SESSION['htsh']['cwd'] = getcwd(); //save cwd
			return array('result' => '');
		} else {
			return array('result' => "Error: I can't do that.");
		}
	} else {
		return array('result' => 'cd: usage: cd [dir]');
	}
}
?>