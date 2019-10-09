<!-- How to create a dynamic triangle -->

<?php
	function makeTriangle($n){
		if ($n>10) {
			echo "error";
		} else {
			for($i=1;$i<=$n;$i++) { 
				for($j=1;$j<=$i;$j++) { 
					echo $j. ", ";
				} 
				echo "<br>";
			}
		}
	}
makeTriangle(7);