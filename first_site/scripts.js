$(document).ready(function() {
    var $name = $('#name'),
        $password = $('#password'),
        $email = $('#email'),
		$phone = $('#phone'),
		$ucaptcha = $('#ucaptcha'),
		$vcaptcha = $('#vcaptcha');

	function	format_valid(attr) {
		attr.css({
			borderColor: 'green',
			color: 'green'
		});
	}

	function	format_unvalid(attr) {
		attr.css({
			borderColor: 'red',
			color: 'red'
		});
	}
	
	function	isvalid_captcha(captcha) {
		return (captcha == $vcaptcha.val());
	}

	$ucaptcha.keyup(function() {
		isvalid_captcha($ucaptcha.val()) ? format_valid($(this)) : format_unvalid($(this));
	});

	function	isvalid_name(name) {
		return (name.length > 4);
	}

	$name.keyup(function() {
		isvalid_name($name.val())  ? format_valid($(this)) : format_unvalid($(this));
	});
	
	function	isvalid_password(password) {
		return (password.length > 5);
	}

	$password.keyup(function() {
		isvalid_password($password.val()) ? format_valid($(this)) : format_unvalid($(this));
	});

	function	isvalid_email(email) {
		const	reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return (reg.test(String(email).toLowerCase()));
	}

	$email.keyup(function() {
		isvalid_email($email.val()) ? format_valid($(this)) : format_unvalid($(this));
	});
	
	function	isvalid_phone(phone) {
		const	reg = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
		return (reg.test(String(phone).toLowerCase()));
	}

	$phone.keyup(function() {
		isvalid_phone($phone.val()) ? format_valid($(this)) : format_unvalid($(this));
    });
});
