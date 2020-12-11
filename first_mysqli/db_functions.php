<?php
	function	db_init()
	{
		$db_name = "db_test";
		$db_table = "db_table";
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
			user_title TINYTEXT,
			user_name TINYTEXT,
			user_lastname TINYTEXT,
			user_email TINYTEXT,
			user_phone TINYTEXT,
			user_password TINYTEXT,
			user_card TINYTEXT,
			user_cardexpiration TINYTEXT,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
	}

	function	db_print()
	{
		$db_name = "db_test";
		$db_table = "db_table";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return ;
		$sql = "SELECT
			id,
			user_title,
			user_name,
			user_lastname,
			user_email,
			user_phone,
			user_password,
			user_card,
			user_cardexpiration
			FROM " . $db_table;
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) > 0)
		{
			while (($row = mysqli_fetch_assoc($result)))
			{
				echo "id: " . $row["id"] . "</br>"
				. "title: " . $row["user_title"] . "</br>"
				. "name: " . $row["user_name"] . "</br>"
				. "lastname: " . $row["user_lastname"] . "</br>"
				. "email: " . $row["user_email"] . "</br>"
				. "phone: " . $row["user_phone"] . "</br>"
				. "password: " . $row["user_password"] . "</br>"
				. "card: " . $row["user_card"] . "</br>"
				. "cardexpiration: " . $row["user_cardexpiration"] . "</br></br>";
			}
		}
		else
			echo "0 results";
		mysqli_close($conn);
	}

	function	db_push()
	{
		$db_name = "db_test";
		$db_table = "db_table";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (!($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			return ;
		$sql = "INSERT INTO " . $db_table . " (
			user_title,
			user_name,
			user_lastname,
			user_email,
			user_phone,
			user_password,
			user_card,
			user_cardexpiration
			) VALUES ("
			. "'" . $_POST["user_title"] . "',"
			. "'" . $_POST["user_name"] . "',"
			. "'" . $_POST["user_lastname"] . "',"
			. "'" . $_POST["user_email"] . "',"
			. "'" . $_POST["user_phone"] . "',"
			. "'" . $_POST["user_password"] . "',"
			. "'" . $_POST["user_card"] . "',"
			. "'" . $_POST["user_cardexpiration"] . "'"
			. ")";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
	}

	function	db_delete()
	{
		$db_name = "db_test";
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
?>
