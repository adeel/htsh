<?php session_start(); if (empty($_SESSION['htsh']['user'])) exit; chdir($_SESSION['htsh']['cwd']); ?>
<html>
 <head>
  <style type="text/css">
body {
	text-align: center;
	font-family: 'lucida grande', 'lucida sans unicode', 'lucida sans', 'frutiger linotype', sans-serif;
}
  </style>
 </head>
 <body>
<?php
if (!empty($_FILES['file'])) {
	$file = $_FILES['file'];
	if (is_uploaded_file($file['tmp_name'])) {
		if (!move_uploaded_file($file['tmp_name'], $file['name'])) {
			die('<p><strong>Error:</strong> could not move uploaded file.</p>');
		} else {
			print '<p>The file was uploaded.</p>';
		}
	} else {
		die('<p><strong>Error:</strong> Could not upload file.</p>');
	}
}
?>
  <p>Maximum filesize: <?php print ini_get('upload_max_filesize'); ?></p>
  <form action="modal.php" method="post" enctype="multipart/form-data">
   <input type="hidden" name="max_file_size" value="<?php print ini_get('upload_max_filesize'); ?>" />
   <p><input type="file" name="file" /></p>
   <p><input type="submit" value="Upload" /></p>
  </form>
 </body>
</html>