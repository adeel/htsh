<?php
	session_start();
	if (empty($_SESSION['htsh']['user'])) exit;
	chdir($_SESSION['htsh']['cwd']);
	$file = $_REQUEST['file'];
	if (!isset($file) || !file_exists($file)) die('error');
	if (!is_readable($file) || !is_writable($file)) die('you do not have permission to read/write to this file');
	$languages = array( //map extensions to filetypes
		'c' => 'c',
		'cpp' => 'cpp',
		'c++' => 'cpp',
		'css' => 'css',
		'html' => 'html',
		'htm' => 'html',
		'js' => 'js',
		'pas' => 'pas',
		'php' => 'php',
		'phtml' => 'php',
		'py' => 'python',
		'vb' => 'vb',
		'xml' => 'xml'
	);
?><html>
<head><style type="text/css">
body {
	font-family: 'lucida grande', 'lucida sans unicode', 'lucida sans', 'frutiger linotype', sans-serif;
	text-align: center;
}
textarea {
	font-family: monaco, 'lucida console', 'courier new', 'courier', monospace;
	font-size: 10pt;
	line-height: 1.25em;
	border: 1px solid #000000;
	padding: 3px;
	height: 350px;
	width: 650px;
}
</style>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="interface.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('textarea').EnableTabs();
});
</script>
</head>
<body>
<h1><?php print $file; ?></h1>
<form action="save.php" method="post">
	<input type="hidden" name="file_name" value="<?php print $file; ?>" />
	<textarea name="file_contents"><?php print file_get_contents($file); ?></textarea>
	<p><input type="submit" value="Save" /></p></form>
</body>
</html>
