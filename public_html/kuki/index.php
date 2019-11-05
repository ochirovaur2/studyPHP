<?php
	
	setcookie("customerId", "1234", time() + 60 * 60 * 24);
	$_COOKIE["customerId"] = "test";
	echo $_COOKIE["customerId"];

?>

