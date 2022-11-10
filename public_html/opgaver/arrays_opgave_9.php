<?php
$arrRandNum = [];
for($i = 0; $i < 50; $i++) {
	array_push($arrRandNum,rand(0,9));
}

foreach($arrRandNum as $value) {
	echo $value . " ";
}

$arrTest = range(10,0);
var_dump($arrTest)
?>