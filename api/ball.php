<?php

class Ball{
    public $x = 0;
	public $y = 0;
    public $dx = 0;
	public $dy = 0;
	public $alpha = 0;
	public $radius = 0;
	public $exploding = false;
	public $done = false;

	public function __construct() {
		$noa = func_num_args();
		if($noa == 6){
			$this->x = func_get_arg(0);
			$this->y = func_get_arg(1);
			$this->dx = func_get_arg(2);
			$this->dy = func_get_arg(3);
			$this->alpha = func_get_arg(4);
			$this->radius = func_get_arg(5);
		}
	}

	public function toString(){
		return "Ball: (" . $this->x . "," . $this->y . ") (" . $this->exploding . "," . $this->done . ") - Alpha: " . $this->alpha . " Radius: " . $this->radius;
	}

    public function getBallConstructor() {
        return "new Ball(" . $this->x . "," . $this->y . ", " . $this->dx . "," . $this->dy . ", ". $this->alpha .", ". $this->radius . ")";
    }
}

?>