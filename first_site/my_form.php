<style>
	form { width: 100%; height: 100%; }
	fieldset div { padding: 2%; }
	fieldset button { padding: 2%; width: 40%; }

	form fieldset {
		border: 2px solid black;
		margin: 20px;
		padding: 10px;
		text-align: center;
	}

	fieldset legend {
		width: 50%;
		border: 2px solid black;
		border-radius: 10px;
	}

	#captcha {
		background-color: pink;
		width: 50%;
		height: 40px;
		margin: 0% auto 0% auto;
		border: 2px solid black;
		border-radius: 5px;
	}

</style>

<?php
	session_start();

	function	random_string($input, $length)
	{
		$input_length = strlen($input);
		$str = '';
		for($i = 0; $i < $length; $i++)
			$str[$i] = $input[mt_rand(0, $input_length - 1)];
		return ($str);
	}
?>

<form method="post">
	<fieldset>
		<legend> <?php echo $_SESSION['register'] == 1 ? 'Register' : 'Login'; ?> </legend>
		<br />
		<div><input type="text" id="name" name="user_name" placeholder="username" /></div>
		<div><input type="password" id="password" name="user_password" placeholder="password" /></div>

	<?php if ($_SESSION['register'] == 1) { ?>	
		<div><input type="email" id="email" name="user_email" placeholder="email" /></div>
		<div><input type="tel" id="phone" name="user_phone" placeholder="phone" pattern="[0-9]{10}" /></div>
	<?php }
		else {
			$captcha = random_string("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 6);
	?>
			<p> ------------------------------ </p>
			<input type="hidden" id="vcaptcha" name="captcha" value="<?=$captcha?>" />
			<div id="captcha"><?=$captcha?></div>
			<div><input type="text" id="ucaptcha" name="user_captcha" placeholder="captcha" /></div>
	<?php } ?>
		<br />
		<button type="submit" formaction="connect.php" id="connect"> Connect </button>
		<button type="submit" formaction="register.php" id="register"> Register </button>
	</fieldset>
</form>
