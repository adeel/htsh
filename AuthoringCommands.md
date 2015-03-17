It is very easy to write additional commands for htsh. All commands are stored in directories inside the `bin/` folder. For example, the following code is inside `bin/cd/cd.php`:

```
<?php
function htsh_cd($args) {
	if (isset($args['params'][0])) {
		if (is_dir($args['params'][0]) && @chdir($args['params'][0])) {
			$_SESSION['htsh']['cwd'] = getcwd(); //save cwd
			return array('result' => '');
		} else {
			return array('result' => "Error: I can't do that.");
		}
	} else {
		return array('result' => 'cd: usage: cd [dir]');
	}
}
?>
```

This is the function that handles the `cd` command. All functions should be named `htsh_command` where `command` is the name of the command. The function is passed an array  based on the user's input. For example, if the user types `cd a b -c -d e -f g h`, htsh\_cd will be passed the array:

```
Array(
  [options] => Array(
    [0] => c
    [1] => d
    [2] => f
  ),
  [params] => Array(
    [0] => a
    [1] => b
    [2] => e
    [3] => g
    [4] => h
  )
);
```

The function must return an array with the key 'result' containing the text that is to be outputted to the shell. If the key 'javascript' is specified, the value of 'result' will be evaluated by the client as javascript. See the `edit` and `upload` commands in the [svn repository](http://htsh.googlecode.com/svn/trunk/bin/) for two examples of returning javascript.
