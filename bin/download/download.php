<?php
function htsh_download($args) {
	if (count($args['params']) == 1) {
		if (!is_file($args['params'][0]) || !file_get_contents($args['params'][0])) {
			return array('result' => 'Could not open file.');
		} else {
			$file = addslashes($args['params'][0]);
			$sid = session_id();
			return array('javascript' => true, 'result' => "window.open('bin/download/download.php?file={$file}&PHPSESSID={$sid}');");
		}
	} elseif (isset($args['options'][0]) && (($args['options'][0] == '-h') || ($args['options'][0] == '--help'))) {
		return array('result' => "Usage: download FILE\nSends FILE to your browser.");
	} else {
		return array('result' => 'download --help for help');
	}
}

if (isset($_GET['file'])) {
	session_start();
	if (!isset($_SESSION['htsh']['user'])) exit;
	chdir($_SESSION['htsh']['cwd']);
	$file = $_GET['file'];
	if (!file_exists($file)) die('file does not exist');
	header('Content-Type: ' . mime_content_type($file));
	header('Content-Disposition: attachment; filename="' . $file . '"');
	header('Content-Length: ' . filesize($file));
	if (!readfile($file)) {
		die('could not open');
	}
}
?>