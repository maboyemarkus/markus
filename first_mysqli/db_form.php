<form action="index.php" method="post" class="container" style="width: 40%;" autocomplete="on">
	<section class="container p-3 my-3 bg-dark text-white border border-secondary">
		<fieldset>
			<legend style="border-left: 6px inset red; padding: 1%; border-radius: 5px;"> User data </legend>
			<br>
			<div class="input-group">
      			<div class="input-group-prepend">
					<div class="input-group-text">
						<input type="radio" id="man" name="user_title" value="man" required>
					</div>
      			</div>
				<input type="text" class="form-control" placeholder="Man" disabled>
				<div class="input-group-prepend">
					<div class="input-group-text">
						<input type="radio" id="woman" name="user_title" value="woman" required>
					</div>
      			</div>
				<input type="text" class="form-control" placeholder="Woman" disabled>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
				  	<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your name" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
				</div>
				<input list="browser" type="text" class="form-control" name="user_name" placeholder="name" required>
				<datalist id="browser">
					<option value="Pierre">
					<option value="Paul">
					<option value="Jacques">
					<option value="Toto">
				</datalist>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
				  	<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your last name" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
      			</div>
				<input type="text" class="form-control" name="user_lastname" placeholder="last name" required>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
				  	<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your email" class="mylink">
					<span class="input-group-text"> @ </span>
					</a>
      			</div>
				<input type="email" class="form-control" name="user_email" placeholder="email" required>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
					<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your phone number" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
      			</div>
				<input type="tel" class="form-control" name="user_phone" placeholder="phone number" pattern="[0-9]{10}" required>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
					<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your password" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
      			</div>
				<input type="password" class="form-control" name="user_password" placeholder="password" required>
			</div>
		</fieldset>
	</section>
	<section class="container-sm p-3 my-3 bg-dark text-white border border-secondary">
		<fieldset>
			<legend style="border-left: 6px inset red; padding: 1%; border-radius: 5px;"> Payment data </legend>
			<br>
			<div class="form-group">
				<a href="#" data-toggle="tooltip" data-placement="left" title="Select your card type" class="mylink">
				<select class="form-control"  id="card" name="user_card" required>
					<option value="visa"> Visa </option>
					<option value="mc"> Mastercard </option>
					<option value="ae"> American Express </option>
				</select>
				</a>
			</div>
			<div class="input-group">
      			<div class="input-group-prepend">
					<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your card number" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
      			</div>
				<input type="text" class="form-control" name="user_cardnumber" placeholder="card number" disabled>
			</div><br>
			<div class="input-group">
      			<div class="input-group-prepend">
					<a href="#" data-toggle="tooltip" data-placement="left" title="Enter your card expiration date" class="mylink">
					<span class="input-group-text"> > </span>
					</a>
      			</div>
				<input type="date" class="form-control" name="user_cardexpiration" min="2020-09-01" max="2030-01-01"required>
			</div>
			<br>
			<button type="submit" formenctype="application/x-www-form-urlencoded" class="btn btn-primary"> Envoyer le formulaire </button>
		</fieldset>
	</section>
	<div class="bg-dark fixed-bottom">
		<nav class="navbar navbar-expand" data-spy="affix" data-offset-top="42">
			<ul class="nav navbar-nav">
				<div class="btn-group">
					<a href="db_display.php" class="btn btn-info"> Afficher la database </a>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"> Delete database </button>
				</div>
			</ul>
		</nav>
	</div>
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
						<a href="index.php" class="btn btn-success"> No </a>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});
</script>
