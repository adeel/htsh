<?php
/**
 * htsh: http shell
 * Copyright (C) 2007 Adeel Khan <adeel@mathideas.org>
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

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
