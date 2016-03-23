<?php
	$user = 'root';
	$password = '';
	$db = 'product';
	$host = '127.0.0.1';

	$link = mysqli_init();
if ( !mysqli_real_connect($link, $host, $user, $password, $db) ) {
    echo "Error!";
    trigger_error('connect failed', E_USER_ERROR);
}
?>