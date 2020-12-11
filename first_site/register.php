<?php
	include ("db_utils.php");
	session_start();

	function	send_email($login, $email)
	{
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return ;
		$key = md5(microtime(TRUE) * 100000);
		$sql = "UPDATE " . $db_table .
			" SET user_key='" . $key . "'" .
			" WHERE user_email='" . $email . "'";
		mysqli_query($conn, $sql);
		mysqli_close($conn);

		$destinataire = $email;
		$sujet = "Activer votre compte" ;
		$entete = "From: inscription@votresite.com" ;
		$message = 'Bienvenue sur VotreSite,
 			Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
			ou copier/coller dans votre navigateur Internet.
			http://localhost:8888/my_site/confirmation.php?log='.urlencode($login).'&key='.urlencode($key).'
 			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';

		mail($destinataire, $sujet, $message, $entete) ;
	}

	if ($_SESSION['register'] == 1 && isset($_POST))
	{
		if (check_form($_POST))
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
		if ($userconn == 0 || $userconn == -2)
		{
			// user already in database
			exit (header("Location: index.php"));
		}
		else
		{
			$db_name = "db_mysite";
			$db_table = "table_mysite";
			$db_server = "localhost";
			$db_username = "root";
			$db_userpassword = "root";
		
			if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
				exit (header("Location: index.php"));
			$sql = "INSERT INTO " . $db_table . " (
				user_name,
				user_password,
				user_email,
				user_phone,
				user_token
				) VALUES ("
				. "'" . $_POST["user_name"] . "',"
				. "'" . md5($_POST["user_password"]) . "',"
				. "'" . $_POST["user_email"] . "',"
				. "'" . $_POST["user_phone"] . "',"
				. "'0'"
				. ")";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			unset($_SESSION['register']);
			send_email($_POST['user_name'], $_POST['user_email']);
			exit (header("Location: index.php"));
		}
	}
	$_SESSION['register'] = 1;
	exit (header("Location: index.php"));
