<?php
	$row["id"] = 73;
	$salt = "dsadasdsadasda123e1e33rd21DDDSDFVCE";
	echo md5(md5($row["id"])."password")
?>