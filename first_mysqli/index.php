<!DOCTYPE html>

<?php
	include ("db_functions.php");
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> index.php </title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style>
			:root {
				--bg_color: coral;
				--txt_color: blue;
  				--padding: 15px;
			}
			@keyframes my_animation {
				0%   { background-color: var(--bg_color); left: 0px; top: 0px; }
				25%  { background-color: yellow; left: 200px; top: 0px; }
				50%  { background-color: blue; left: 200px; top: 200px; }
				75%  { background-color: green; left: 0px; top: 200px; }
				100% { background-color: purple; left: 0px; top: 0px; }
			}

			.test:hover { transform: rotate(180deg); }
			.bonjour {
				position: absolute;
				margin: 20% 0 0 80%;
				text-align: center;
				padding-top: 90px;
				border-radius: 100%;
				width: 200px;
				height: 200px;
				background-color: var(--bg_color);
			}
			.bonjour:hover {
				animation-name: my_animation;
				animation-duration: 5s;
				animation-iteration-count: infinite;
				animation-timing-function: linear;
				animation-direction: alternate;
				transform: rotate(360deg);
				<?php // animation: my_animation 5s linear infinite; ?>
			}
		</style>
	</head>
	<body style="background: url('img/avatar_man.png') no-repeat right top scroll; background-size: 200px 200px;">
		<div class="bonjour" style="transition: transform 5s; resize: both; overflow: auto;"> BONJOUR </div>
		<?php
			db_init();
			if ($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$_SERVER['REQUEST_METHOD'] = NULL;
				db_push();
			}
			include ("db_form.php");
		?>
	</body>
	<br />
	<footer>
		<p id="update" style="position: absolute; top: 0; right: 15px;"></p>

		<div style="position: absolute; top: 0; left: 15px;">
			<p> Count: <output id="count"></output> </p>
			<button onclick="worker_start()"> Start Worker </button>
			<button onclick="worker_stop()"> Stop Worker </button>
			<br /><br />
			<button onclick="get_location()"> Get your geolocation </button>
			<p id="location"></p>
		</div>

		<button class="btn btn-info test" data-toggle="collapse" data-target="#display_carousel" style="transition: transform 2s;"> Display the carousel </button>
		<div id="display_carousel" class="collapse" style="position: relative; top: 10px; left: 10px;">
			<iframe src="carousel.php" width="250" height="250" frameborder="0" allowfullscreen></iframe>
		</div>
	</footer>
	<br><br><br><br><br><br><br><br><br><br><br><br>
</html>

<script>
	// geolocation
	var	pos = document.getElementById("location");

	function	get_location()
	{
  		if (navigator.geolocation)
    		navigator.geolocation.watchPosition(showPosition);
  		else
    		pos.innerHTML = "Geolocation is not supported on this browser.";
	}
    
	function	showPosition(position)
	{
    	pos.innerHTML = "POS: " + position.coords.latitude + ", " + position.coords.longitude;
	}

	// webworker count
	var	w;

	function	worker_start()
	{
		if (typeof(Worker) !== "undefined")
		{
			if (typeof(w) == "undefined")
	      		w = new Worker("workers.js");
	    	w.onmessage = function(event) {
	    		document.getElementById("count").innerHTML = event.data;
	    	};
		}
		else
	    	document.getElementById("count").innerHTML = "Web Workers are not supported on this browser.";
	}

	function	worker_stop()
	{
		w.terminate();
		w = undefined;
	}

	// server updates
	var	source;

	if (typeof(EventSource) !== "undefined")
	{
		source = new EventSource("updates.php");
		source.onmessage = function(event) {
			document.getElementById("update").innerHTML = event.data + "<br>";
		};
	}
	else
		document.getElementById("update").innerHTML = "Server-sent events are not supported on this browser.";
		  
</script>
