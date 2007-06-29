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

error_reporting(E_ALL | E_STRICT);

if (($_REQUEST['username'] == $config['username']) && ($_REQUEST['password'] == $config['password'])) {
	@chdir($config['homedir']);
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	session_start();
	$save = array(
		'user' => array('username' => $config['username']),
		'cwd' => getcwd(),
	);
	$_SESSION['htsh'] = $save;
	print json_encode(array(
		'cwd' => getcwd(),
		'username' => $config['username'],
		'PHPSESSID' => htmlspecialchars(session_id())
	));
	exit;
} else {
	error('Invalid username/password combination.');
}
?>