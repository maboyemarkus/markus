<style>
	table {
		width: 100%;
		text-align: center;
	}

	table, tr, th, td {
		border: 1px solid black;
	}

	button a:hover {
		background-color: red;
		color: white;
	}
	button:hover {
		background-color: red;
	}
	button a {
		color: white !important;
	}
	button {
		background-color: tomato;
		border-radius: 10px;
	}
	tr:hover { background-color: tomato; }
</style>

<div class="connected">
<?php
	session_start();

	$db_name = "db_mysite";
	$db_table = "table_mysite";
	$db_server = "localhost";
	$db_username = "root";
	$db_userpassword = "root";

	if (($conn = mysqli_connect($db_server, $db_username, $db_userpassword, $db_name)))
	{
		$sql = "SELECT
			user_name,
			user_password,
			user_email,
			user_phone
			FROM " . $db_table;
		if (($result = mysqli_query($conn, $sql)))
		{
?>
			<table>
				<thead>
					<tr>
						<th> NAME </th>
						<th> PASSWORD </th>
						<th> EMAIL </th>
						<th> PHONE </th>
					</tr>
				</thead>
				<tbody>
					<?php
					while (($row = mysqli_fetch_row($result)))
					{
						if ($row[0] == $_SESSION['user_name'])
						{
					?>
						<tr>
							<td><?php echo $row[0] ?></td>
							<td><?php echo $row[1] ?></td>
							<td><?php echo $row[2] ?></td>
							<td><?php echo $row[3] ?></td>
						</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
	<?php
			mysqli_free_result($result);
		}
		mysqli_close($conn);
	}
	?>
	<br />
	<button><a href="disconnect.php"> Disconnect </a></button>
	<button><a href="delete_user.php"> Delete account </a></button>
</div>
