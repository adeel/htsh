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

var htshController = {

	counter : 0,

	queries : [],

	historyCounter : 0,

	init : function() {

		var self = this;

		// create shell div
		$('#wrapper').append('<div id="shell"></div>');
		self.shell = $('#shell');

		// listen for clicks on the shell
		self.shell.click(function() {
			self.shell.find('input').focus();
		});

		// listen for key presses (up, down, and tab)
		$(document).keydown(function(e) {

			// get key code
			var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

			switch (key) {
				case 38: // up
					lastQuery = self.queries[self.historyCounter-1];
					if (typeof lastQuery != "undefined") {
						self.historyCounter--;
						self.shell.find('input').val(lastQuery);
					}
					break;
				case 40: // down
					nextQuery = self.queries[self.historyCounter+1];
					if (typeof nextQuery != "undefined") {
						self.historyCounter++;
						self.shell.find('input').val(nextQuery);
					}
					break;
				case 9: // tab
					partial = self.shell.find('input').val();
					// complete partial query (make sure it's a normal input, not a username/password field)
					if (self.shell.find('input').parent().parent().attr('class') == 'row') {
						$.getJSON('complete.php', {partial: partial, PHPSESSID: self.PHPSESSID}, function(json) {
							// replace partial with complete and restore focus
							self.shell.find('input').val(json.result).focus();
						});
					}
			}
			
		});

		// watch input field
		$(document).keypress(function() { self.inputSize(); });

		// license
		self.print("htsh beta 2007.06.11 Copyright (C) 2007 Adeel Khan &lt;http://adeel-khan.homelinux.org&gt;");
		self.print("htsh comes with ABSOLUTELY NO WARRANTY.");
		self.print("This is free software, and you are welcome to redistribute it under certain conditions.");
		self.print("Type `license' for details.");

		// make the user log in
		self.login();
	},

	login : function() {

		var self = this;

		// append username prompt
		self.shell.append('<div id="username"><span class="prompt">Username:</span><form><input type="text" /></a></div>');
		// focus input
		self.shell.find('#username input').focus();

		// when form is submitted
		self.shell.find('#username form').submit(function(e) {

			// do not use normal http post
			e.preventDefault();

			// append password prompt
			self.shell.append('<div id="password"><span class="prompt">Password:</span><form><input type="password" /></a></div>');
			// focus input
			self.shell.find('#password input').focus();

			// when form is submitted
			self.shell.find('#password form').submit(function(e) {

				// do not use normal http post
				e.preventDefault();

				// send ajax request
				$.ajax({
					url : 'login.php',
					type : 'POST',
					dataType : 'json',
					data : {
						username : self.shell.find('#username input').val(),
						password : self.shell.find('#password input').val()
					},
					success : function(j) {

						// if result is not an error
						if (self.check(j)) {

							// set document title
							document.title = j.username + '@' + location.hostname;

							self.PHPSESSID = j.PHPSESSID;
							
							// create prompt
							self.doPrompt(j);

							// replace username/password inputs
							val = self.shell.find('#username input').val();
							self.shell.find('#username input').parent().empty().append(val);
							self.shell.find('#password input').remove();

						} else {

							// select username input
							self.shell.find('#username input').focus().select();
							// remove password input
							self.shell.find('#password').remove();

						}

					}

				});

			});

		});

	},

	doPrompt : function(json) {

		var self = this;

		// increment prompt counter
		self.counter++;
		// reset historyCounter
		self.historyCounter = self.counter;
		
		// prompt text
		prompt = json.username + ':' + json.cwd + '$';
		// append prompt to shell
		self.shell.append('<div class="row" id="' + self.counter + '"><span class="prompt">' + prompt + '</span><form><input type="text" /></form></div>');
		// focus input
		self.shell.find('div#' + self.counter + ' input').focus();
		
		// listen for submit
		self.shell.find('div#' + self.counter + ' form').submit(function(e) {
		
			// do not use normal http post
			e.preventDefault();
			
			// if input field is empty, don't do anything
			if (self.shell.find('div#' + self.counter + ' input').val() == '') return false;
			
			// send ajax request
			$.ajax({

				url : 'query.php',

				type : 'POST',

				dataType : 'json',

				data : {
					query : self.shell.find('div#' + self.counter + ' input').val(),
					PHPSESSID : self.PHPSESSID
				},

				success : function(j) {
				
					// if result is not an error
					if (self.check(j)) {
				
						// if result is not javascript
						if (typeof j.javascript == 'undefined') {
							// print result to shell
							self.print(j.result);
						} else {
							// execute javascript
							eval(j.result);
						}
				
						// get value of query
						val = self.shell.find('input').val();
						// replace input with query
						self.shell.find('input').parent().empty().append(val);
				
						// save query
						self.queries[self.counter] = val;
				
						// check if the user just logged out
						if (j.logged_out == true) {
							self.destruct();
						} else {
							// do another prompt
							self.doPrompt(j);
						}
					
					}
				
				}

			});

		});

	},

	print : function(string) {
		this.shell.append('<div class="result"><pre>' + string + '</pre></div>');
	},

	check : function(json) {

		// make sure json result is not an error
		if (typeof json.error != "undefined") {
			this.shell.append('<div class="error">Error: ' + json.error + '</div>');
			return false;
		} else {
			return true;
		}

	},

	inputSize : function() {
		// increase the size of the input box when the user types more
		this.shell.find('input').attr('size', (this.shell.find('input').val().length + 5)).focus();
	},

	destruct : function() {} // ... 
	
}
$(document).ready(function() { htshController.init(); });
