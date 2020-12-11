<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title> index.php </title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="myCarousel" class="carousel slide border" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img style="width: 100%;" src="img/avatar_man.png" alt="man">
				</div>
				<div class="carousel-item">
					<img style="width: 100%;" src="img/avatar_woman.png" alt="woman">
				</div>
			</div>
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<!--<img class="images" src="img/avatar_man.png" alt="next">-->
				<span class="carousel-control-prev-icon" style="filter: invert(100%);"></span>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<!--<img class="images" src="img/avatar_woman.png" alt="prev">-->
				<span class="carousel-control-next-icon" style="filter: invert(100%);"></span>
			</a>
		</div>
	</body>
</html>
