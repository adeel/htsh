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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<title>htsh</title>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/htsh.js?<?php print time(); ?>"></script>
	<style type="text/css" media="all">@import url(css/htsh.css);</style>
 </head>
 <body>
  <div id="wrapper">
   <div id="header">
	<h1>htsh @ <?php print $_SERVER['HTTP_HOST']; ?></h1>
   </div>
  </div>
 </body>
</html>
