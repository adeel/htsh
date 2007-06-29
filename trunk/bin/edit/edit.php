<?php
function htsh_edit($args) {
	if (isset($args['params'][0])) {
		$file = $args['params'][0];
		if (!file_exists($file)) touch($file);
		$file = addslashes($file);
		ob_start();
?>
var url = 'bin/edit/editor.php?file=<?php print $file; ?>&PHPSESSID=<?php print session_id(); ?>';

$('<div id="modal"></div>').appendTo('body');
if (typeof $('#modal').openModal != 'function') {
	$('<link rel="stylesheet" href="bin/edit/edit.css" />').appendTo('head');
	$.getScript('bin/edit/jquery.dimensions.js');
	$.getScript('bin/edit/jquery.modal.js', function() {
		$('#modal').html('<p><a href="#" class="close">x</a></p><iframe width="795" height="495" src="' + url + '"></iframe>');
		$('#modal').openModal({width : 800, height : 500}).find('.close').click(function() {
			$('#modal').closeModal();
		});
	});
} else {
	$('#modal').html('<p><a href="#" class="close">x</a></p><iframe width="795" height="495" src="' + url + '"></iframe>');
	$('#modal').openModal({width : 800, height : 500}).find('.close').click(function() {
		$('#modal').closeModal();
	});
}
<?php
		$javascript = ob_get_clean();
		return array('javascript' => true, 'result' => $javascript);
	} else {
		return array('result' => "Usage: edit FILE\nOpens a modal window in which you can edit FILE and save it to the server.");
	}
}
?>