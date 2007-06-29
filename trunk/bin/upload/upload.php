<?php
function htsh_upload($args) {
	ob_start();
?>
var url = 'bin/upload/modal.php?PHPSESSID=<?php print session_id(); ?>';

$('<div id="modal"></div>').appendTo('body');
if (typeof $('#modal').openModal != 'function') {
	$('<link rel="stylesheet" href="bin/upload/modal.css" />').appendTo('head');
	$.getScript('bin/upload/jquery.dimensions.js');
	$.getScript('bin/upload/jquery.modal.js', function() {
		$('#modal').html('<p><a href="#" class="close">x</a></p><iframe width="495" height="195" src="' + url + '"></iframe>');
		$('#modal').openModal({height : 200}).find('.close').click(function() {
			$('#modal').closeModal();
		});
	});
} else {
	$('#modal').html('<p><a href="#" class="close">x</a></p><iframe width="495" height="195" src="' + url + '"></iframe>');
	$('#modal').openModal({height : 200}).find('.close').click(function() {
		$('#modal').closeModal();
	});
}
<?php
	$javascript = ob_get_clean();
	return array('javascript' => true, 'result' => $javascript);
}
?>