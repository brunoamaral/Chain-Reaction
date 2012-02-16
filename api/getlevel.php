<?php

require_once("levels.php");
require_once("levelinfo.php");

if(empty($_GET['level']) || !is_numeric($_GET['level'])){
	echo json_encode(array("error" => "1"));
}else{
	if($_GET['level'] < 1 || $_GET['level'] > count($levelinfos))
		echo json_encode(array("error" => "2"));
	else{
		$data = array("level" => array("info" => $levelinfos[$_GET['level']], "balls" => $levels[$_GET['level']]));
		echo json_encode($data);
	}
}

?>