<?php
	
	$levelinfos = array(
		1 => new LevelInfo(100, 90, 20, 50, 0.8, 0.02, 1),
		2 => new LevelInfo(100, 95, 20, 50, 0.8, 0.02, 1),
		3 => new LevelInfo(95, 90, 20, 50, 0.8, 0.02, 1),
		4 => new LevelInfo(90, 85, 20, 50, 0.8, 0.02, 1),
		5 => new LevelInfo(85, 80, 20, 50, 0.8, 0.02, 1),
		6 => new LevelInfo(80, 75, 20, 50, 0.8, 0.02, 1),
		7 => new LevelInfo(75, 67, 20, 50, 0.8, 0.02, 1),
		8 => new LevelInfo(70, 63, 20, 50, 0.8, 0.02, 1),
		9 => new LevelInfo(65, 58, 20, 50, 0.8, 0.02, 1),
		10 => new LevelInfo(60, 50, 20, 50, 0.8, 0.02, 1),
		11 => new LevelInfo(55, 42, 20, 50, 0.8, 0.02, 1),
		12 => new LevelInfo(50, 30, 20, 50, 0.8, 0.02, 1),
		13 => new LevelInfo(48, 27, 20, 50, 0.8, 0.02, 1),
		14 => new LevelInfo(45, 22, 20, 50, 0.8, 0.02, 1),
		15 => new LevelInfo(42, 16, 20, 50, 0.8, 0.02, 1),
		16 => new LevelInfo(40, 12, 20, 50, 0.8, 0.02, 1),
		17 => new LevelInfo(38, 12, 20, 50, 0.8, 0.02, 1),
		18 => new LevelInfo(37, 12, 20, 50, 0.8, 0.02, 1),
		19 => new LevelInfo(36, 12, 20, 50, 0.8, 0.02, 1),
		20 => new LevelInfo(35, 12, 20, 50, 0.8, 0.02, 1),
		21 => new LevelInfo(34, 12, 20, 50, 0.8, 0.02, 1),
		22 => new LevelInfo(33, 12, 20, 50, 0.8, 0.02, 1),
		23 => new LevelInfo(32, 12, 20, 50, 0.8, 0.02, 1),
		24 => new LevelInfo(31, 12, 20, 50, 0.8, 0.02, 1),
		25 => new LevelInfo(30, 12, 20, 50, 0.8, 0.02, 1),
		26 => new LevelInfo(29, 12, 20, 50, 0.8, 0.02, 1),
		27 => new LevelInfo(28, 12, 20, 50, 0.8, 0.02, 1),
		28 => new LevelInfo(27, 12, 20, 50, 0.8, 0.02, 1),
		29 => new LevelInfo(26, 12, 20, 50, 0.8, 0.02, 1),
		30 => new LevelInfo(25, 12, 20, 50, 0.8, 0.02, 1),
		31 => new LevelInfo(24, 12, 20, 50, 0.8, 0.02, 1),
		32 => new LevelInfo(23, 12, 20, 50, 0.8, 0.02, 1),
		33 => new LevelInfo(22, 12, 20, 50, 0.8, 0.02, 1),
		34 => new LevelInfo(21, 12, 20, 50, 0.8, 0.02, 1),
		35 => new LevelInfo(20, 12, 20, 50, 0.8, 0.02, 1),
		36 => new LevelInfo(19, 12, 20, 50, 0.8, 0.02, 1),
		37 => new LevelInfo(18, 12, 20, 50, 0.8, 0.02, 1),
		38 => new LevelInfo(17, 12, 20, 50, 0.8, 0.02, 1),
		39 => new LevelInfo(16, 12, 20, 50, 0.8, 0.02, 1),
		40 => new LevelInfo(15, 12, 20, 50, 0.8, 0.02, 1),
		41 => new LevelInfo(14, 12, 20, 50, 0.8, 0.02, 1),
		42 => new LevelInfo(13, 12, 20, 50, 0.8, 0.02, 1)
	);
			
	class LevelInfo{
	    public $balls = 0;
		public $goal = 0;
	    public $radius = 0;
		public $interval = 0;
		public $alpha = 0;
		public $arate = 0; // alpha explosion rate
		public $rrate = 0; // radius explosion rate

		public function __construct() {
			$noa = func_num_args();
			if($noa == 7){
				$this->balls = func_get_arg(0);
				$this->goal = func_get_arg(1);
				$this->radius = func_get_arg(2);
				$this->interval = func_get_arg(3);
				$this->alpha = func_get_arg(4);
				$this->arate = func_get_arg(5);
				$this->rrate = func_get_arg(6);
			}
		}
	}
?>