var $window = $(window);

$(document).ready(function() {

	// lazyload_iframe: <iframe id='myiframe' src="" data-src="myurl" loading="auto" width="100%" height="450" frameBorder="0"></iframe>
	// var	isLoaded = false;

	// $(window).scroll(function() {
	// 	var	height = $(window).scrollTop();
	// 	if (height  > 500) {
	// 		if (!isLoaded) {
	// 			var iframe = $("#myiframe");
	// 			iframe.attr("src", iframe.data("src"));
	// 			isLoaded = true;
	// 		}
	// 	}
	// });

	$(document).on('click', '.scrollTo', function(e) {
		e.preventDefault();
		var ref = $(this).attr('href');
	
		if ($(ref).size() == 0)
			return ;
		$('html, body').animate({ scrollTop: $(ref).offset().top }, 800);
	});
	
	$window.on('scroll', window_scrolled);
	$window.on('resize', window_resized);
	$window.trigger('resize');
		
	var hash = window.location.hash;
	if (typeof(hash) != 'undefined' && hash.length > 0) {
		setTimeout(function() { $('a[href="' + hash + '"]').click(); }, 400);
	}
		
	$(document).on('click', '#formulaire input', function() {
		if ($(this).attr('type') != "checkbox" && $(this).attr('type') != "radio")
			$(this).closest('.form-group').find('.control-label').addClass('activated');
	});
	$(document).on('keypress', '#formulaire input', function() {
		if ($(this).attr('type') != "checkbox" && $(this).attr('type') != "radio")
			$(this).closest('.form-group').find('.control-label').addClass('activated');
	});
	$(document).on('change', '#formulaire input', function() {
		if ($(this).attr('type') != "checkbox" && $(this).attr('type') != "radio")
			$(this).closest('.form-group').find('.control-label').addClass('activated');
	});

	$(document).on('blur', '#formulaire input', function() {
		var	form = $('#formulaire');
		var	parent = $('#main');
		var	scroll_top = $window.scrollTop();
		var	y_min = parent.offset().top;
		var	y_max = parent.offset().top + parent.outerHeight() - form.outerHeight();

		if ($(this).val() == "")
			$(this).closest('.form-group').find('.control-label').removeClass('activated');
		form.removeClass('fixit');
		if (scroll_top < y_min || scroll_top > y_max || $window.innerWidth() < 769)
			return ;
		form.css({
			position: 'absolute',
			top: scroll_top - parent.offset().top,
			left: parent[0].clientWidth - form[0].clientWidth,
		});
		
	});
	$(document).on('click', '#formulaire', function() {
		var	parent = $('#main');
		var	scroll_top = $window.scrollTop();
		var	y_min = parent.offset().top;
		var	y_max = parent.offset().top + parent.outerHeight() - $(this).outerHeight();

		$(this).hasClass('fixit') ? $(this).removeClass('fixit') : $(this).addClass('fixit');
		if (scroll_top < y_min || scroll_top > y_max || $window.innerWidth() < 769)
			return ;
		$(this).css({
			position: 'absolute',
			top: scroll_top - parent.offset().top,
			left: parent[0].clientWidth - $(this)[0].clientWidth,
		});
	});

	$("input[name='code_postal']").autocomplete({
		source: form_path + "form/utils/villes.php",
		delay: 0,
		minLength: 2,
		select: function(event, ui) {
			$('input[name="code_postal"]').val(ui.item.code_postal);
			$('input[name="ville"]').val(ui.item.ville);
			$(this).closest('form').find('.form-group#code_postal .control-label').addClass('activated');
			$(this).closest('form').find('.form-group#ville .control-label').addClass('activated');
			return (false);
		}
	});
	$("input[name='ville']").autocomplete({
		source: form_path + "form/utils/villes.php",
		delay: 0,
		minLength: 2,
		select: function(event, ui) {
			$('input[name="code_postal"]').val(ui.item.code_postal);
			$('input[name="ville"]').val(ui.item.ville);
			$(this).closest('form').find('.form-group#code_postal .control-label').addClass('activated');
			$(this).closest('form').find('.form-group#ville .control-label').addClass('activated');
			return (false);
		}
	});	
});

function	window_scrolled ()
{	
	refresh_sticky ($('#formulaire'), $('#main'), $('#residence'));
	refresh_cta ($('#form_cta'), $('#formulaire'));
}

function	window_resized ()
{
	form = $('#formulaire');
	if ($window.innerWidth() > 768) {
		form.removeClass('fixit');
		form.addClass('sticky');
		refresh_sticky (form, $('#main'), $('#residence'));
	}
	else {
		form.removeClass('sticky');
		form.addClass('fixit');
		form.css({
			position: 'relative',
			top: 0,
			left: 0,
		});
		refresh_cta ($('#form_cta'), form);
	}
}

function	refresh_cta (cta, target)
{
	if (cta.size() == 0 || target.size() == 0)
		return ;
	if ($window.scrollTop() < target.offset().top - target.outerHeight() / 2
		|| $window.scrollTop() > target.offset().top + target.outerHeight() / 2)
		cta.css('opacity', 1);
	else
		cta.css('opacity', 0);
}

function	refresh_sticky (target, parent, left)
{
	if (!target.hasClass('sticky') || target.hasClass('fixit'))
		return ;
	var	scroll_top = $window.scrollTop();
	var	y_min = parent.offset().top;
	var	y_max = (parent.offset().top + parent.outerHeight()) - target.outerHeight();

	// ----- position: absolute; -----
	// if (scroll_top >= y_min )
	// 	target.css('top', (scroll_top >= y_max ? y_max : scroll_top) - y_min);
	// else
	// 	target.css('top', 0);

	// ----- position: fixed; -----
	// if (scroll_top < y_min)
	// 	target.css({
	// 		top: y_min - scroll_top,
	// 	});
	// else
	// 	target.css({
	// 		top: 0,
	// 	});
	// if (scroll_top > y_max)
	// 	target.css({
	// 		top: y_max - scroll_top,
	// 	});

	if (scroll_top < y_min)
		target.css({
			position: 'absolute',
			top: 0,
			left: parent[0].clientWidth - target[0].clientWidth,
		});
	else
		target.css({
			position: 'fixed',
			top: 0,
			left: (left[0].clientWidth + left.offset().left + 15) + 'px', // 15px is boostrap container padding by default
		});
	if (scroll_top > y_max)
		target.css({
			position: 'absolute',
			top: y_max - y_min,
			left: parent[0].clientWidth - target[0].clientWidth,
		});
}

$(document).on('click', '.form-group', function() {
	if ($(this).find("input").size() > 0)
		$(this).find("input").focus();
});

$(document).on('click', 'input[name=optin1]', function() {
	var $form = $(this).closest('form');

	if (!$form.hasClass('etape2'))
		$form.addClass('etape2');
	$('#formulaire').removeClass('fixit');
	window_scrolled();
	$('#formulaire').addClass('fixit');
});

function	showError (msg)
{
	if (typeof(timer_error) != 'undefined')
		clearTimeout(timer_error);
	if ($("#error-message").size() == 0)
		$('<div id="error-message"></div>').appendTo('body');
	$("#error-message").css({
		'position': 'fixed',
		'left': '0px',
		'bottom': '0px',
		'right': '0px',
		'padding': '20px',
		'background': 'red',
		'color': '#fff',
		'text-align': 'center',
		'z-index': 9999,
		'transition': 'all 0.5s ease'
	});
	$("#error-message").html(msg);
	$("#error-message").click(function() {
		$("#error-message").css('bottom', '-100px');
	});
	setTimeout(function() { $("#error-message").css('bottom', '0px'); }, 100);
	timer_error = setTimeout(function() { $("#error-message").css('bottom', '-100px'); }, 6000);
}

$(document).on('submit', 'form', function(e) {
	var $form = $(this);

	checkForm($form, true);
	if (!form_error) {
		if (typeof($form.attr('data-target')) != "undefined") {
			e.preventDefault();
			var $target = $('#' + $form.attr('data-target'));
			var lead = new FormData($form[0]);
			$.ajax({
				url: $form.attr('action'),
				type: 'POST',
				data: lead,
				dataType: 'html',
				cache: false,
				contentType: false,
				processData: false,
	    		success: function(data) {
	    			if (data.length > 0)
	    	  			$target.html(data);
	    		},
	    		error: function(e) {
					console.log(e.message);
	    		}
			});
		}
	}
	else {
		e.preventDefault();
		showError(form_error);
		form_error = undefined;
	}
});

function	isAsciiString(string)
{
	var	regex = /^[A-Za-z -]{2,}$/;

	return (regex.test(string));
}

function	isCodePostale(code_postal)
{
	var	regex = /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/;

	return (regex.test(code_postal));
}

function	isEmail(email)
{
	var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	return (regex.test(email));
}

function	isPhone(phone)
{
	var	regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
	var	regex = /^[\+]?[0-9]{10,11}$/;

	return (regex.test(phone));
}

function	isRobot(form)
{
	form.find(".form_token").each(function() {
		if ($(this).val() != form_token)
			form_error = "Merci de saisir l'ensemble des champs requis.";
	});
	form.find(".token").each(function() {
		if ($(this).val().length)
			form_error = "Erreur inconnue.";
	});
	if (server === undefined)
		form_error = "Erreur inconnue.";
}

function	isValidInput(input)
{
	var value;

	if (input.attr("type") == "radio")
		value = $("input[name='" + input.attr("name") + "']:checked").val()
	else
		value = input.val();
	if (value === undefined || value == "") {
		form_error = "Merci de saisir l'ensemble des champs requis.";
		return (false);
	}
	if (input.attr("name") == "email") {
		if (isEmail(input.val()))
			return (true);
		form_error = "Merci de saisir un Email valide.";
		return (false);
	}
	if (input.attr("name") == "telephone") {
		if (isPhone(input.val()))
			return (true);
		form_error = "Merci de saisir un téléphone valide.";
		return (false);
	}
	if (input.attr("name") == "code_postal") {
		if (isCodePostale(input.val()))
			return (true);
		form_error = "Merci de saisir un code postale valide.";
		return (false);
	}
	if (input.attr("name") == "nom"
		|| input.attr("name") == "prenom"
		|| input.attr("name") == "ville") {
		if (isAsciiString(input.val()))
			return (true);
		form_error = "Le champ " + input.attr("name") + " est invalide.";
		return (false);
	}
	return (true);
}

function	checkForm(form, showErrors)
{
	if (typeof(showErrors) == "undefined")
		showErrors = false;
	form.find(".form-group").removeClass("error");
	form.find(".required").each(function() {
		if (isValidInput($(this)) == false) {
			if (showErrors)
				$(this).closest(".form-group").addClass("error");
		}
	});
	isRobot(form)
}
