<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Chain Reaction (ß)</title>
	<meta name="author" content="António Lopes">
	<link href="js/jquery.alerts.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet/less" type="text/css" href="css/style.less">
	<script src="js/jquery-1.7.min.js"></script>
	<script src="js/jquery.alerts.js"></script>
	<link rel="stylesheet/less" type="text/css" href="css/alert.less">
	<script src="js/less.js" type="text/javascript"></script>
	<script src="js/jcanvas.min.js"></script>
	<script src="js/model.js"></script>
	<script type="text/javascript" src="js/code.js.php"></script>
</head>

<body>
	<!-- Facebook stuff -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=155952067771862";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- ------------- -->
	
	<div id="bgoverlay"></div>

	<div id="instructionsdiv">
		<h1 align="center">How to play</h1>
		<p align="center">Click on one of the balls. Yep, that's it!</p>
		<p>That will trigger a chain reaction that will destroy some (or all) of the balls.
		Your goal is to destroy as many balls as possible.
		If you reach the goal for this level, you'll automatically go through to the next level.</p>
		<p align="center"><button id="closeinstructions">Close</button></p>
	</div>

	<div id="content">
		<div id="title">
			<h1>Chain Reaction<sup>(ß)</sup></h1>
			<p>One shot. Make it count.</p>
		</div>

		<div id="header">
			<div id="level">
				<div class="attr">Level</div>
				<div id="levelval" class="val"></div>
			</div>
			<div id="goal">
				<div class="attr">Goal</div>
				<div id="goalval" class="val notgoal">0/0</div>
			</div>
			<div id="instructions">How to play</div>
		</div>
		
		<canvas id="world" width="600" height="500">
			Looks like your browser doesn't support <b>canvas</b>. Too bad. No <b>Chain Reaction</b> for you.
		</canvas>
	</div>

	<div id="sidebar">
		<div id="creator">Created by <a href="http://antoniolopes.info" target="_blank">António Lopes</a></div>
		<div id="share">
			<!-- Twitter stuff -->
			<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
			<div id="twshare">
			   <a href="https://twitter.com/share" class="twitter-share-button"
			      data-url="http://chainreaction.antoniolopes.info"
			      data-via="tonyvirtual"
			      data-text="I'm addicted to the Chain Reaction game. Give it a try at"
				  data-related="tonyvirtual:Chain Reaction game's creator."
			      data-count="horizontal">Tweet</a>
			</div>
			<!-- ------------------ -->
			<!-- Facebook Buttons -->
			<div id="fbshare" class="fb-like" data-href="http://chainreaction.antoniolopes.info" data-send="true" data-layout="button_count" data-width="100" data-show-faces="false" data-font="lucida grande"></div>
			<!-- ---------------- -->
		</div>
	</div>
	
</body>

</html>
