<?php
	 $link = mysqli_connect("shareddb-p.hosting.stackcp.net","myusers-313135b32e", "chita1945", "myusers-313135b32e");
	if(mysqli_connect_error()) {
      die ("Connection failed");
    }
	$query = "SELECT * FROM `users` WHERE `email` = 'say@mail.ru'";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);
	echo $row["email"];
?>