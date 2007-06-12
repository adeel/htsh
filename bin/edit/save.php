<?php
session_start();
chdir($_SESSION['htsh']['cwd']);
	
if (!isset($_REQUEST['file_contents']) || !isset($_REQUEST['file_name'])) {
	die('invalid request');
}

$filename = $_REQUEST['file_name'];
$contents = $_REQUEST['file_contents'];

if (!file_exists($filename)) die('error');
if (!is_readable($filename) || !is_writable($filename)) die('you do not have permission to read/write to this file');

file_put_contents($filename, stripslashes($contents));

header("Location: editor.php?file={$filename}");
exit;
?>