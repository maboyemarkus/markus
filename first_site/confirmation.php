<?php
	include ("db_utils.php");

	if (isset($_GET))
	{
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";
		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			exit (header("Location: index.php"));

		$login = sanitize_string($_GET['log']);
		$key = sanitize_string($_GET['key']);

		$sql = "SELECT user_key
			FROM " . $db_table .
			" WHERE user_name='" . $login . "'";
		if (($result = mysqli_query($conn, $sql)))
		{
			while (($row = mysqli_fetch_row($result)))
			{
				if ($row[0] == $key)
				{
					$sql = "UPDATE " . $db_table .
						" SET user_token='1'" .
						" WHERE user_name='" . $login . "'";
					mysqli_query($conn, $sql);
				}
			}
			mysqli_free_result($result);
		}
		mysqli_close($conn);	
	}
	exit (header("Location: index.php"));
