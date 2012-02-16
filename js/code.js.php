
// Global variables
var canvas_element;
var canvas;
var canvas_width, canvas_height;
var balls = [];
var level;
var interval_id;
var clicked = false;
var progress = 0;
var token = generateToken(32);
var clickedx = 0;
var clickedy = 0;
var instant = 0;

$(document).ready(function(){
	if (!document.createElement("canvas").getContext) {
		jAlert("Sorry, you can't play this game because your browser doesn't support HTML5's <b>canvas</b> feature.");
	}else {		
		// Get a canvas and a drawing context
		canvas_element = document.getElementById("world");
		canvas = canvas_element.getContext("2d");

		// Initialize with the width and height of the canvas
		canvas_width = canvas_element.width;
		canvas_height = canvas_element.height;

		// Click handler for #instructions
		$('#instructions').click(showInstructions);
		// Click handler for instructions' close button
		$('#closeinstructions').click(closeInstructions);
		
		// Click handler for the canvas
		$('#world').click(clickedCanvas);
		
		// Start game
		startGame();
	}
});

function generateToken(size){
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var randomstring = '';
	for (var i = 0; i < size; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function showInstructions(){
	$('#bgoverlay').fadeIn(100, function(){
		$('#instructionsdiv').fadeIn(100);
	});
}

function closeInstructions(){
	$('#instructionsdiv').fadeOut(100, function(){
		$('#bgoverlay').fadeOut(100);
	});
}

function clickedCanvas(e){
	if(!clicked){
		// Get the actual x and y of the canvas position
		var x;
		var y;
		if (e.pageX || e.pageY) { 
			x = e.pageX;
			y = e.pageY;
		} else { 
			x = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft; 
			y = e.clientY + document.body.scrollTop + document.documentElement.scrollTop; 
		} 
		x -= canvas_element.offsetLeft;
		y -= canvas_element.offsetTop;

		clickedx = x;
		clickedy = y;

		// Calculate which ball was clicked, if any
		for(var i in balls){
			var cx = balls[i].x;
			var cy = balls[i].y;
			if(Math.pow(x - cx, 2) + Math.pow(y - cy, 2) < Math.pow(balls[i].radius, 2)){
				// If this was the ball clicked, set to explode
				balls[i].exploding = true;
				clicked = true;
				return;
			}
		}
	}
}

function setInitialLevel(){
	return 1;
}

function startGame(){
	level_nr = setInitialLevel();
	startLevel(level_nr);
}

function startLevel(level_nr){
	// Reset level
	progress = 0;
	clicked = false;
		
	// Prepare and load new level
	loadLevel(level_nr);
	$('#levelval').html(level_nr);	
}

function loadLevel(level_nr){
	msgCanvas("Loading level...");
	$.ajax({
		type: "GET",
		url: "api/getlevel.php",
		data: "level=" + level_nr,
		success: prepareLevel,
		error: function(req, msg){
			msgCanvas("Could not load level. Please, refresh the browser.");
		}
	});
}

function msgCanvas(msg){
	$("canvas").drawText({
	  fillStyle: "#ddd",
	  strokeStyle: "#555",
	  strokeWidth: 5,
	  x: 10, y: 15,
	  text: msg,
	  align: "left",
	  baseline: "middle",
	  font: "normal 12pt Verdana, sans-serif"
	});
}

function prepareLevel(msg){
	// If there's an animation going on, stop it
	clearInterval(interval_id);
	// Reset the timer
	instant = 0;
	try{
		var data = jQuery.parseJSON(msg);
		if(data.error != null){
			jAlert("Could not load level. Click OK to try again.", "ERROR", function(){
				startLevel(parseInt($('#levelval').html()));
			});
		}else{
			level = null;
			level = new levelinfo(data.level.info.balls, data.level.info.goal, data.level.info.radius, data.level.info.interval, data.level.info.alpha, data.level.info.arate, data.level.info.rrate);
			balls = [];
			for(var i in data.level.balls){
				// Randomly determine circle's color
				var color_r = Math.round(Math.random() * (256-128) + 128);
				var color_g = Math.round(Math.random() * (256-128) + 128);
				var color_b = Math.round(Math.random() * (256-128) + 128);
				balls.push(new ball(data.level.balls[i].x, data.level.balls[i].y, data.level.balls[i].dx, data.level.balls[i].dy, color_r, color_g, color_b, level.ball_radius, level.alpha));
			}
			// Set a timer to fire the "gameLoop" method every INTERVAL milliseconds
			interval_id = setInterval("gameLoop()", level.interval);
		}
	}catch(exc){
		jAlert("Could not load level. Click OK to try again.", "ERROR", function(){
			startLevel(parseInt($('#levelval').html()));
		});
	}
}

function gameLoop() {
	// Clear entire canvas
	canvas.clearRect(0, 0, canvas_width, canvas_height);
	// Process all balls
	for(var i in balls){
		if(balls[i].exploding)
			processExplodingBall(i);
		else{
			processBall(balls[i], i);
		}
	}
	// Paint the current progress
	paintProgress();
	
	if(clicked){
		// Check if the chain reaction has stopped
		if(allDone()){
			// Stop animation
			clearInterval(interval_id);			

			// Check if goal was reached
			if(progress >= level.nr_goal_balls){
				nextLevel();
			}else{
				jAlert("Sorry, but you didn't reach the goal. Please, try again.", "FAIL", function(){
					// Relaunch level
					startLevel(parseInt($('#levelval').html())); 
				});
			}
		}
	}else{
		instant++;
	}
}

function nextLevel(){
	jAlert("Congratulations! You've reached the goal for this level. Proceed to the next level.", "WIN", function(){
		startLevel(parseInt($('#levelval').html()) + 1);
	});
}

function allDone(){
	// For each exploding ball, check if exploding has stopped
	for(var i in balls){
		if(balls[i].exploding)
			if(!balls[i].done)
				return false;
	}
	return true;
}

function paintProgress(){
	progress = getProgress();
	$('#goalval').removeClass();
	$('#goalval').addClass('val');
	if(progress < level.nr_goal_balls)
		$('#goalval').addClass('notgoal');
	else
		$('#goalval').addClass('goal');
	
	$('#goalval').html(Math.round(progress / level.nr_balls * 100) + "% / " + Math.round(level.nr_goal_balls / level.nr_balls * 100) + "%");
}

function getProgress(){
	var c = 0;
	// Count the number of exploding balls
	for(var i in balls)
		if(balls[i].exploding)
			c++;
	return c;
}

function processExplodingBall(ball_id){
	var ball = balls[ball_id];

	// If the ball is invisible, the exploding process has ended
	if(ball.alpha <= 0){
		ball.done = true;
	}else{
		// Increase radius according to defined rates
		ball.radius = ball.radius + level.radius_explosion_rate;
		// Increase alpha according to defined rates
		ball.alpha = fpcorrect(ball.alpha - level.alpha_explosion_rate);
		if(ball.alpha <= 0){
			ball.alpha = 0;
			ball.done = true;
		}else{
			// Check for collisions
			processCollisions(ball);
			// Redraw the circle with new properties
			$("canvas").drawArc({
			  // Exploding balls are painted red
			  fillStyle: "rgba(200, 100, 100, " + ball.alpha + ")",
			  // Alternative: painted with their own color
			  //fillStyle: "rgba(" + ball.color_r + ", " + ball.color_g + ", " + ball.color_b + ", " + ball.alpha + ")",
			  x: ball.x, y: ball.y,
			  radius: ball.radius
			});
		}
	}
}

function processCollisions(ball){
	// For each ball, check if it collided with 'ball'
	for(var i in balls){
		if(!balls[i].exploding){
			if(collided(ball.x, ball.y, ball.radius, balls[i].x, balls[i].y, balls[i].radius)){
				// If collided, then initiate explosion
				balls[i].exploding = true;
			}
		}
	}
}

function collided(x1, y1, r1, x2, y2, r2){
	// Check if ball 1 (with coordinates x1,y1 and radius r1) has collided with ball 2 (with coordinates x2,y2 and radius r2)
    var a = r1 + r2;
    var dx = Math.round(x1) - Math.round(x2);
    var dy = Math.round(y1) - Math.round(y2);
    //var dx = x1 - x2;
    //var dy = y1 - y2;
    return a * a > dx * dx + dy * dy;
}

function processBall(ball, i){
	// Compute the circle's new horizontal position
	var x = ball.x + ball.dx;

	// If it has hit bounds, go in the opposite direction
	if (x < ball.radius || x > (canvas_width - ball.radius)) {
		x = ball.x - ball.dx;
		ball.dx = -ball.dx;
	}

	// Compute the circle's new horizontal position
	var y = ball.y + ball.dy;

	// If it has hit bounds, go in the opposite direction
	if (y < ball.radius || y > (canvas_height - ball.radius)) {
		y = ball.y - ball.dy;
		ball.dy = -ball.dy;
	}

	// Set ball's new position
	ball.x = fpcorrect(x);
	ball.y = fpcorrect(y);
	
	// Redraw the circle in its new position
	$("canvas").drawArc({
	  fillStyle: "rgba(" + ball.color_r + ", " + ball.color_g + ", " + ball.color_b + ", " + ball.alpha + ")",
	  x: ball.x, y: ball.y,
	  radius: ball.radius
	});
}

function fpcorrect(n){
	return parseFloat((n).toPrecision(12));
}