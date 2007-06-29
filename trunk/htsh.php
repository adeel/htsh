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

class htsh {
	function __construct() {
		@chdir($_SESSION['htsh']['cwd']);
	}
	function query($query) {
		$query = trim($query);
		if (($query_split = explode(' ', $query)) && ($command = $query_split[0])) {
			if (file_exists(BIN . "/{$command}/{$command}.php")) {
				require_once(BIN . "/{$command}/{$command}.php");
				$args = array_slice($query_split, 1);
				$result = @call_user_func('htsh_' . $command, $this->arg_filter($args));
				if (!$result) $result = array('error' => "I can't execute that function.");
			} else {
				$result = array('result' => "I don't understand.");
			}
		} else {
			$result = array('result' => "I don't understand.");
		}
		$result['cwd'] = getcwd();
		$result['username'] = $_SESSION['htsh']['user']['username'];
		return json_encode($result);
	}
	function complete($partial) {
		$return = '';
		// is it a command name or a file name?
		$query_split = explode(' ', $partial);
		$command = $query_split[0];
		if (strlen($partial) > strlen($command)) {
			// it is a file name
			$query_split[0] = trim($command);
			$index = count($query_split) - 1;
			$files = glob($query_split[$index] . '*');
			if (empty($files)) $return = $partial;
			else {
				$query_split[$index] = $files[0];
				if (is_dir($files[0])) $return = trim(implode(' ', $query_split)) . '/';
				else $return = trim(implode(' ', $query_split)) . ' ';
			}
		} else {
			// it is a command name
			$commands = glob(BIN . "/{$command}*");
			if (empty($commands)) $return = $partial;
			else {
				$command = str_replace(BIN . '/', '', $commands[0]);
				$return = $command . ' ';
			}
		}
		return json_encode(array('result' => $return));
	}
	function arg_filter($args) {
		// separate options and parameters
		$options = array();
		$params = array();
		foreach ($args as $arg) {
			if (substr($arg, 0, 1) == '-') {
				// it's an option
				$options[] = $arg;
			} else {
				// it's a parameter
				$params[] = $arg;
			}
		}
		return array('options' => $options, 'params' => $params);
	}
}
?>
