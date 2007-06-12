<?php
session_start();

include('common.php');

switch($_REQUEST['action']) {
	case 'login':
		if (($_REQUEST['username'] == $config['username']) && ($_REQUEST['password'] == $config['password'])) {
			@chdir($config['homedir']);
			$_SESSION['htsh']['user']['username'] = $config['username'];
			$_SESSION['htsh']['cwd'] = getcwd();
			exit(json_encode(array('cwd' => getcwd(), 'username' => $config['username'])));
		} else {
			error('Invalid username/password combination.');
		}
		break;
	case 'query':
		if (!isset($_SESSION['htsh']['user']['username'])) {
			error('Your session has timed out. You can refresh the page and log in again.');
		}
		require_once('htsh.php');
		$htsh = new htsh;
		print $htsh->query($_REQUEST['query']);
		break;
	case 'complete':
		if (!isset($_SESSION['htsh']['user']['username'])) {
			error('Your session has timed out. You can refresh the page and log in again.');
		}
		require_once('htsh.php');
		$htsh = new htsh;
		print $htsh->complete($_REQUEST['partial']);
		break;
	default:
		error("Something's wrong -- no data was passed. You aren't playing around, are you?");
		break;
}

function error($error) {
	exit(json_encode(array('error' => $error)));
}
?>
