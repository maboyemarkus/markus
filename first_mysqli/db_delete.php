<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title> db_delete.php </title>
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
	<?php
		$db_name = "db_test";
		$db_table = "db_table";
		$db_server = "localhost";
		$db_username = "root";
		$db_userpassword = "root";

		if (($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
		{
			$sql = "DROP DATABASE IF EXISTS " . $db_name;
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			$str = "Database deleted";
		}
		else
			$str = "Database not found";
	?>
		<section class="container p-3 my-3 bg-dark text-white border border-secondary">
			<div class="alert alert-danger"> <?php echo $str ?> </div>
			<div class="btn-group">
				<a href="index.php" class="btn btn-primary"> Retour à l'index </a>
				<a href="db_display.php" class="btn btn-info"> Afficher la database </a>
			</div>
		</section>
	</body>
</html>
