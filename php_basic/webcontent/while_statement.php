<?php 
$x = 1; 

while($x <= 5) {
    echo "The number is: $x <br>";
    $x++;
} 

echo "<br>";

while(1){
	
	for($i = 0; $i <= 20; $i++){
		echo "i: ".$i."<br>";
		if($i == 5){
			break 2;
		}
	}
	
	echo "finished";
}

echo "Break out.";
?>