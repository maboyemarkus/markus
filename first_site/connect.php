<?php
	include ("db_utils.php");
	session_start();

	if (!isset($_SESSION['register']) && isset($_POST))
	{
		if ($_POST['captcha'] != $_POST['user_captcha'] || check_form($_POST))
		{
			$_SESSION['error_form'] = 1;
			unset($_SESSION['user_name']);
			unset($_SESSION['connect']);
			unset($_SESSION['register']);
			exit (header("Location: index.php"));
		}
		else
			unset($_SESSION['error_form']);
		$userconn = db_checkuser($_POST['user_name'], $_POST['user_password']);
		if ($userconn == 0 && db_checktoken($_POST['user_name']) == 0)
		{
			// connected
			$_SESSION['user_name'] = $_POST['user_name'];
			$_SESSION['connect'] = 1;
		}
		else if ($userconn == -1)
		{
			// user not found
			unset($_SESSION['user_name']);
			unset($_SESSION['connect']);
		}
		else if ($userconn == -2)
		{
			// wrong password
			unset($_SESSION['user_name']);
			unset($_SESSION['connect']);
		}
	}
	unset($_SESSION['register']);
	exit (header("Location: index.php"));
