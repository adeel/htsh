<?php
function htsh_unzip($args) {
	if (count($args['params']) == 1) {
		// uses PclZip (http://phpconcept.net)
		require_once 'pclzip/pclzip.lib.php';
		$zip = new PclZip($args['params'][0]);
		$contents = $zip->extract($args['params'][0]);
		if (!$contents) {
			return array('result' => 'Error: Could not extract the archive. ' . $zip->errorInfo());
		} else {
			foreach ($contents as $content) {
				$output .= "{$content['stored_filename']}\n";
			}
			return array('result' => $output);
		}
	} elseif (in_array('-h', $args['options']) || in_array('--help', $args['options'])) {
		return array('result' => 'Usage: unzip ARCHIVE-NAME');
	} else {
		return array('result' => 'unzip --help for help');
	}
}
?>