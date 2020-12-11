<?php
	session_start();

	if (isset($_SESSION['user_name']))
	{
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			exit (header("Location: index.php"));
		$sql = "DELETE FROM " . $db_table . " WHERE user_name = '" . $_SESSION['user_name'] . "';";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		exit (header("Location: disconnect.php"));
	}
	exit (header("Location: index.php"));
