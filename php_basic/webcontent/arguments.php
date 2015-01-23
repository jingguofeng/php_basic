<?php

function add($args){
	$sum = 0;
	//echo sizeof($args);
	for($i = 0; $i < count($args); $i++){
		echo $args[$i]."<br>";
		$sum +=$args[$i];
	}
	return $sum;
}
$myargs = array(1,2,3,4,5);

$h = add($myargs);

echo $h;

?>
