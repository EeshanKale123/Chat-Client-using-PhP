<?php
include_once 'db_connect.php';
include_once 'chat-functions.php';

if(isset($_COOKIE['email']) && isset($_COOKIE['chatfriendemail'])){
	$myid = $_COOKIE['email'];
	$fid = $_COOKIE['chatfriendemail'];
}

	fetchmessages($myid, $fid, $mysqli);
?>

