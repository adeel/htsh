<?php
function htsh_zip($args) {
	if (count($args['params']) == 2) {
		// uses PclZip (http://phpconcept.net)
		require_once 'pclzip/pclzip.lib.php';
		$zip = new PclZip($args['params'][1]);
		if (!$zip->create($args['params'][0])) {
			return array('result' => 'Error: Could not create the archive:');
		} else {
			return array('result' => '');
		}
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => 'Usage: zip FILE-NAME/DIRECTORY-NAME ARCHIVE-NAME'));
	} else {
		return array('result' => 'zip --help for help');
	}
}
?>