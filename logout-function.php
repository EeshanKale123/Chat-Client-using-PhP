<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['email'])) {
	unset($_COOKIE['username']);
	unset($_COOKIE['email']);
	setcookie('username', null, -1, '/');
    setcookie('email', null, -1, '/');
	header('Location: /chatapp/login.php');
} else {
	header('Location: /chatapp/login.php');
}


?>
