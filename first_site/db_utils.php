<?php
	function	db_init()
	{
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword)))
			return ;
		$sql = "CREATE DATABASE IF NOT EXISTS " . $db_name;
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return ;
		$sql = "CREATE TABLE IF NOT EXISTS " . $db_table . " (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_name TINYTEXT,
			user_password TINYTEXT,
			user_email TINYTEXT,
			user_phone TINYTEXT,
			user_key VARCHAR(32),
			user_token INT,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
	}

	function	db_delete()
	{
		$db_name = "db_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
		{
			$sql = "DROP DATABASE IF EXISTS " . $db_name;
			mysqli_query($conn, $sql);
			mysqli_close($conn);
		}
	}

	function	db_checktoken($login)
	{
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return (-1);
		$sql = "SELECT user_token
			FROM " . $db_table .
			" WHERE user_name='" . $login . "'";
		if (($result = mysqli_query($conn, $sql)))
		{
			while (($row = mysqli_fetch_row($result)))
			{
				return ($row[0] ? 0 : -1);
			}
			mysqli_free_result($result);
		}
		mysqli_close($conn);	
	}

	function	db_checkuser($username, $userpassword) {
		$db_name = "db_mysite";
		$db_table = "table_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return (-1);
		$sql = "SELECT
			user_name,
			user_password
			FROM " . $db_table;
		if (($result = mysqli_query($conn, $sql)))
		{
			while (($row = mysqli_fetch_row($result)))
			{
				if ($username == $row[0])
				{
					mysqli_free_result($result);
					mysqli_close($conn);
					return (md5($userpassword) == $row[1] ? 0 : -2);
				}
			}
			mysqli_free_result($result);
		}
		mysqli_close($conn);
		return (-1);
	}

	function	check_form($post)
	{
		session_start();

		$userconn = db_checkuser($post['user_name'], $post['user_password']);
		foreach ($post as $tmp)
			$tmp = sanitize_string($tmp);
		if ($_SESSION['register'] == 1)
		{
			if ($userconn == 0 || $userconn == -2)
				return (true);
			return (empty($post['user_name']) || empty($post['user_password'])
				|| empty($post['user_email']) || empty($post['user_phone']));
		}
		return ($userconn == -1 || empty($post['user_name']) || empty($post['user_password']));
	}

	function	sanitize_string($str)
	{
		$db_name = "db_mysite";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";
		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return (NULL);
		$str = filter_var(trim($str), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		return (mysqli_real_escape_string($conn, htmlentities($str, ENT_QUOTES | ENT_IGNORE, "UTF-8")));
	}
