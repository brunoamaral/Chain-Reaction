<?php
	require_once('levelinfo.php');
	require_once('ball.php');

	$canvas_width = 600;
	$canvas_height = 500;

	$out = 'require_once("ball.php");<br/><br/>';
	$out .= '$levels = array(<br/>';
	foreach($levelinfos as $level_nr => $li){
		$out .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $level_nr . ' => array(<br/>';
		for($i = 0; $i < $li->balls; $i++){
			// Randomly determine initial position
			$rx = mt_rand($li->radius, $canvas_width - $li->radius * 2);
			$ry = mt_rand($li->radius, $canvas_height - $li->radius * 2);
			// Randomly determine delta directions
			$rdx = mt_rand(-3, 3) / 10;
			$rdy = mt_rand(-3, 3) / 10;
			// Create ball and print its constructor
			$ball = new Ball($rx, $ry, $rdx, $rdy, $li->alpha, $li->radius);
			$out .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ball->getBallConstructor().',<br/>';
		}
		$out .= '&nbsp;&nbsp;&nbsp;&nbsp;),<br/>';
	}
	$out .= ');';
	echo $out;
?>