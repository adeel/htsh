<?php
function htsh_exit() {
	$_SESSION['htsh'] = array();
	session_destroy();
	return array('result'=>'Thank you for using htsh. I hope you have a nice day.', 'logged_out' => true);
}
?>