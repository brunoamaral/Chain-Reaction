// Class ball
function ball(x, y, dx, dy, color_r, color_g, color_b, ball_radius, alpha){
	this.x = x;
	this.y = y;
	this.dx = dx;
	this.dy = dy;
	this.color_r = color_r;
	this.color_g = color_g;
	this.color_b = color_b;
	this.radius = ball_radius;
	this.alpha = alpha;
	this.exploding = false;
	this.done = false;
}

// Class level
function levelinfo(nr_balls, nr_goal_balls, ball_radius, interval, alpha, alpha_explosion_rate, radius_explosion_rate){
	this.nr_balls = nr_balls;
	this.nr_goal_balls = nr_goal_balls;
	this.ball_radius = ball_radius;
	this.interval = interval;
	this.alpha = alpha;
	this.alpha_explosion_rate = alpha_explosion_rate;
	this.radius_explosion_rate = radius_explosion_rate;
}