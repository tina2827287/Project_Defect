<?php
	$user = 'root';
	$password = 'root';
	$db = 'product';
	$host = 'localhost';

	$link = mysqli_init();
if ( !mysqli_real_connect($link, $host, $user, $password, $db) ) {
    echo "Error!";
    trigger_error('connect failed', E_USER_ERROR);
}
?>