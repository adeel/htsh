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

session_start() or die('failed to initalize session');

include('common.php');

error_reporting(E_ALL | E_STRICT);

if (!isset($_SESSION['htsh']['user'])) {
	exit(json_encode(array('result' => $_REQUEST['partial'])));
}

require_once('htsh.php');
$server = new htsh;
print $server->complete($_REQUEST['partial']);

//print json_encode(array('result' => 'hi', 'cwd' => getcwd()));
?>