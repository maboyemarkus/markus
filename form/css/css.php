<style>
	/* #formulaire { transition: all 0.1s linear; } */

	#form_formulaire .form_red { color: red; }
	
	#form_formulaire {
		width: 100%;
		height: 100%;
		background: #fff;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
		padding: 30px;
	}

	#form_formulaire .commentary { display: none; visibility: hidden; }

	#form_formulaire h3, #form_formulaire h4 { margin: 0; padding: 0; }
	#form_formulaire h4 { padding-bottom: 10px; }

	#form_formulaire #form_subscribe {
		font-size: 1.2em;
		color: #333;
	}

	#form_formulaire #form_title p:nth-child(2) {
		font-size: 0.65em;
	}
	#form_formulaire #form_title p:nth-child(3) {
		font-size: 0.5em;
		color: grey;
	}
	#form_formulaire #form_title p:nth-child(3) img {
		width: 12px;
		margin-right: 5px;
		margin-top: -2px;
	}

	#form_formulaire .form_mentions {
		color: #a6a6a6;
		font-size: 0.7em;
		text-align: left;
		margin: 20px 0;
	}

	#form_formulaire .form_btn {
		padding: 20px;
		background: red;
		color: #fff;
		border: 0;
		width: 100%;
		font-size: 1.2em;
		transition: transform 0.2s ease;
	}
	#form_formulaire .form_btn:hover { transform: scale(1.1); }

	#form_formulaire .form-group#date input.form-control {
		padding-left: 45px;
		border-radius: 0;
		border: 1px solid #333;
	}
	#form_formulaire #heure select {
		padding-left: 40px;
		border-radius: 0;
		border: 1px solid #333;
	}
	#form_formulaire .form-group#date, #form_formulaire .form-group#heure  { position: relative; }
	#form_formulaire .form-group#date .control:before, 	#form_formulaire .form-group#heure .control:before {
		content: "\e953";
		position: absolute;
		top: 3px; left: 8px;
		font-family: 'icomoon' !important;
		font-size: 20px;
	}
	#form_formulaire .form-group#heure .control:before { content:"\e94e"; }

	#form_formulaire .form-group#nom > .control-label,
	#form_formulaire .form-group#prenom > .control-label,
	#form_formulaire .form-group#code_postal > .control-label,
	#form_formulaire .form-group#ville > .control-label,
	#form_formulaire .form-group#email > .control-label,
	#form_formulaire .form-group#telephone > .control-label,
	#form_formulaire .form-group#date > .control-label {
		position: absolute;
		width: 100%;
		padding-left: 10px;
		display: block;
		pointer-events: none;
	}
	#form_formulaire .form-group#date > .control-label { padding-left: 45px; }
	#form_formulaire .form-group > .control-label { transition: all 0.3s ease; opacity: 1; }
	#form_formulaire .form-group > .control-label.activated { transform: translateY(-15px); opacity: 0 !important; }

	#form_formulaire .form-group.error input, #form_formulaire .form-group.error select { border: solid 1px red !important; }
	#form_formulaire .form-group.error input[type="checkbox"],
	#form_formulaire .form-group.error input[type="radio"] { border: none !important; }
	#form_formulaire .form-group#civilite.error .control, #optin.error .control label { color: red; }

	#form_formulaire .radio-inline input[type='radio'] {
		position: relative;
		width: 25px; height: 20px;
		-moz-appearance: none;
		-webkit-appearance: none;
		margin-top: 0px;
	}
	#form_formulaire .radio-inline input[type='radio']:before {
		content: " ";
		position: absolute;
		left: 0px; top: 5px;
		width: 20px; height: 20px;
		border: solid 1px #666;
	}
	#form_formulaire .radio-inline input[type='radio']:checked:after {
		content: " ";
		position: absolute;
		left: 2px; top: 7px;
		width: 16px; height: 16px;
		background: #666;
	}
	#form_formulaire .form-group.form_change .control-label { display: block; line-height: 1.5em; font-weight: bold; }
	#form_formulaire .form-group .control-label { line-height: 2.5em; font-weight: normal; }
	#form_formulaire .form-group .control input { border: none; border-radius: 0px; }

	#form_formulaire .form-group#typologie,
	#form_formulaire .form-group#callback,
	#form_formulaire .form-group#goal { display: none; }
	#form_formulaire .etape2 .form-group#typologie,
	#form_formulaire .etape2 .form-group#callback,
	#form_formulaire .etape2 .form-group#goal { display: block !important; }

	#form_formulaire .form-group > .control-label { display: none; }
	#form_formulaire .form-group .control > input { border: solid 1px #333; }
	#form_formulaire .form-group { position:relative; }

	/* CTA */
	#form_cta {
		position: fixed;
		left: 0px; right: 0px; bottom: 0px;
		line-height: 20px;
		text-align: center;
		background: red;
		color: #fff;
		font-size: 15px;
		font-weight: bold;
		padding: 10px;
		text-decoration: none;
		transition: all 0.5s ease;
		display: block;
		z-index: 2147483647;
	}
	@media (min-width: 768px) { #form_cta { display: none; } }

</style>
