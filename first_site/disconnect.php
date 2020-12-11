<?php
	session_start();

	unset($_SESSION['user_name']);
	unset($_SESSION['connect']);
	unset($_SESSION['register']);
	unset($_SESSION['error_form']);
	exit (header("Location: index.php"));
