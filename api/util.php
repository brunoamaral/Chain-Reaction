<?php
function generateToken($len) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($p = 0; $p < $len; $p++) {
		$i = mt_rand(0, strlen($characters) - 1);
        $string = $string.$characters{$i};
    }
    return $string;
}
?>