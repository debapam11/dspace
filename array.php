<?php

$stud= array(array('Mark',10,15),array('Jon',34,67),array('Doe',69,90));


for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){

			echo $stud[$i][$j]; echo "&nbsp";
	}
	echo "<br>";
}

?>