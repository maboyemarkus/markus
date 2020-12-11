<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title> db_display.php </title>
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			tr:hover { background-color: red !important; }
		</style>
	</head>
	<body>
		<section class="container p-3 my-3 bg-dark text-white border border-secondary">
		<?php
			$db_name = "db_test";
			$db_table = "db_table";
			$db_server = "localhost";
			$db_username = "root";
			$db_userpassword = "root";

			if (($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
			{
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
		?>
					<input class="form-control" id="myInput" type="text" placeholder="Search...">
					<br>
					<table class="table table-dark table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>TITLE</th>
								<th>NAME</th>
								<th>LASTNAME</th>
								<th>EMAIL</th>
								<th>NUMBER</th>
								<th>PASSWORD</th>
								<th>CARD</th>
								<th>EXPIRATION</th>
							</tr>
						</thead>
						<tbody id="myTable">
					<?php
						while (($row = mysqli_fetch_assoc($result)))
						{
					?>
						<tr>
							<td><?php echo $row["id"] ?></td>
							<td>
							<?php
								$title = $row["user_title"] == "man" ? "img/avatar_man.png" : "img/avatar_woman.png";
							?>
								<img class="rounded" src="<?php echo $title ?>" style="width:40px;">
							</td>
							<td><?php echo $row["user_name"] ?></td>
							<td><?php echo $row["user_lastname"] ?></td>
							<td><?php echo $row["user_email"] ?></td>
							<td><?php echo $row["user_phone"] ?></td>
							<td><?php echo $row["user_password"] ?></td>
							<td><?php echo $row["user_card"] ?></td>
							<td><?php echo $row["user_cardexpiration"] ?> </td>
						</tr>
					<?php
						}
					?>
						</tbody>
					</table>
			<?php
				}
				else {
			?>
					<div class="alert alert-info"> <?php echo "Database is empty"; ?></div>
			<?php
				}
				mysqli_close($conn);
			}
			else {
				?><div class="alert alert-danger"> <?php echo "Database not found"; ?></div>
			<?php
				}
			?>
		<div class="btn-group">
			<a href="index.php" class="btn btn-primary"> Retour à l'index </a>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"> Delete database </button>
		</div>
		</section>

		<div class="container">
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Are you sure ? </h4>
							<button type="button" class="close" data-dismiss="modal"> &times; </button>
						</div>
						<div class="modal-body">
							<div class="btn-group btn-block">
								<a href="db_delete.php" class="btn btn-danger"> Yes </a>
								<a href="db_display.php" class="btn btn-success"> No </a>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		$(document).ready(function(){
 			$("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#myTable tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    			});
  			});
		});
	</script>
</html>
