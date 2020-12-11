<!DOCTYPE html>

<?php include ("back/class.php") ?>

<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> index.php </title>

		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style>
			html { scroll-behavior: smooth; }
		</style>
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "my_db";
			$tablename = "my_table";

			try {
				$conn = new PDO("mysql:host=$servername", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$q = "CREATE DATABASE IF NOT EXISTS " . $dbname;
				$conn->exec($q);
				echo $dbname . " created successfully<br>";
			}
			catch (PDOException $e) {
				echo $q . "<br>" . $e->getMessage();
			}
			$conn = NULL;

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$q = "CREATE TABLE IF NOT EXISTS " . $tablename . "(
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					name TINYTEXT,
					password TINYTEXT,
					email TINYTEXT,
					phone TINYTEXT,
					reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
				)";
				$conn->exec($q);
				echo $tablename . " created successfully<br>";
			}
			catch (PDOException $e) {
				echo $q . "<br>" . $e->getMessage();
			}
			$conn = NULL;

/* ------------------------------------------ */

			$user = new Super_user("test", "test", "test@test.fr", "0123467895");
			$manager = new Users_manager();

			$manager->create($user);
		?>
	</body>
</html>
