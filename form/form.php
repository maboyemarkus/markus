<?php
	if (empty($_SESSION['form_token'])) $_SESSION['form_token'] = md5(uniqid());
	// Ne pas oublier de vérifier si dans init.inc.php, à la récupération du form, la value du form_token vaut bien celle en session

	include ("css/css.php");
?>

<!-- ========== Require ========== -->

<!-- <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" media="screen">
<link rel="stylesheet" href="css/bootstrap.min.css" media="screen">

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script> -->

<!-- ==================== -->

<script type="text/javascript">
	var	form_error = "";
	var	form_token = "<?=$_SESSION['form_token']?>";
	var	server = "<?=$_SERVER["HTTP_ORIGIN"]?>";

	// location of form's directory
	var	form_path = "utils/"

	<?php if (!empty($_SESSION['form_token'])) { ?>
		$(document).on('focus', 'input', function(e) {
			var $form = $(this).closest('form');
			$form.find('[name="form_token"]').val('<?=$_SESSION['form_token'];?>');
		});
	<?php } ?>
	$(function() {
		$("#datepicker").datepicker({ minDate: 0, maxDate: "3m" });
	});

	<?php include ("js/form.js"); ?>
</script>

<div id='form_formulaire'>
	<h3 id='form_title'> 
		<p> Eiffage Immobilier <br /> vous présente: <br /><br /> </p>
		<p class='form_red'> LA RÉSIDENCE <?=strtoupper($config['programme']['nom']);?> <br /><br /> </p>
		<p> <img src='utils/form/img/picto_gps_red.png' alt='error'> <?=$config['programme']['ville'];?> (<?=$config['programme']['code_postal'];?>) </p> 
	</h3>
	<hr />
	<h4 id='form_subscribe'> Inscrivez-vous pour télécharger la brochure et bénéficier de nos offres: </h4>

	<?php if (!empty($_SESSION['programme-'.$config['programme']['reference']])) { ?>
		<br /><br />
		<p>
			Merci ! <br />
			Votre demande a bien été prise en compte. <br /><br /><br />
		</p>
		<? if (!empty($config['programme']['url_doc'])) { ?>
			<a href="<?=$config['programme']['url_doc'];?>" target="_blank"> Télécharger la brochure </a>
		<? } ?>
			<br /><br /><br /><br />
			<?php include (dirname(__FILE__).'../conf/tag.confirmation.inc.php'); ?>
	<?php } else { ?>
		<form method="post" action="<?=(!empty($config['base']))?($config['base']):('.');?>/confirmation#form">	
			<input type="hidden" name="webtag" value="<?php echo $config['webTag']; ?>">
			<input type="hidden" name="utm_source" value="<?php echo $config['utm_source']; ?>">
			<input type="hidden" name="utm_medium" value="<?php echo $config['utm_medium']; ?>">
			<input type="hidden" name="utm_campaign" value="<?php echo $config['utm_campaign']; ?>">
			<input type="hidden" name="utm_term" value="<?php echo $config['utm_term']; ?>">
			<input type="hidden" name="utm_content" value="<?php echo $config['utm_content']; ?>">

			<div class="form-group" id="civilite">
				<label class="control-label">Civilité *</label>
				<div class="control">
					<div class="radio-inline">
						<input class="required" type="radio" id="civilite_1" name="civilite" value="Mme" <?php if ($civilite == "Mme") echo "checked"; ?>> 
						<label for="civilite_1"> Mme </label>
					</div>
					<div class="radio-inline">
						<input type="radio" id="civilite_2" name="civilite" value="M." <?php if ($civilite == "M.") echo "checked"; ?>>
						<label for="civilite_2"> M. </label>
					</div>
				</div>
			</div>

			<div class="form-group" id='nom'>
				<label class="control-label"><span class="form_red">*</span> Nom </label>
				<div class="control">
					<input type="text" class="form-control input required" name="nom" value="<?php echo $nom; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id='prenom'>
				<label class="control-label"><span class="form_red">*</span> Prénom </label>
				<div class="control">
					<input type="text" class="form-control input required" name="prenom" value="<?php echo $prenom; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id='code_postal'>
				<label class="control-label"> <span class="form_red">*</span> Code postal </label>
				<div class="control">
					<input type="number" class="form-control input required" name="code_postal" value="<?php echo $code_postal; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id='ville'>
				<label class="control-label"> <span class="form_red">*</span> Ville </label>
				<div class="control">
					<input type="text" class="form-control input required" name="ville" value="<?php echo $ville; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id='email'>
				<label class="control-label"> <span class="form_red">*</span> Email </label>
				<div class="control">
					<input type="email" class="form-control input required" name="email" value="<?php echo $email; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id='telephone'>
				<label class="control-label"> <span class="form_red">*</span> Téléphone </label>
				<div class="control">
					<input type="number" class="form-control input required" name="telephone" value="<?php echo $telephone; ?>" placeholder="">
				</div>
			</div>

			<div class="form-group" id="date">
				<label class="control-label"> <span class="form_red">*</span> Date </label>
				<div class="control">
					<input id="datepicker" type="text" class="form-control input required" name="date" value="<?php echo $date; ?>" placeholder="">
				</div>
			</div>
			<div class="form-group" id="heure">
				<label class="control-label"> <span class="form_red">*</span> Heure </label>
				<div class="control">
					<select name="heure" class="form-control input required">
						<option value="<?php echo $heure; ?>"> <span class="form_red">*</span> Choisissez une heure </option>
						<option value="9h00-10h00"> 9h00 - 10h00</option>
						<option value="10h00-11h00"> 10h00 - 11h00</option>
						<option value="11h00-12h00"> 11h00 - 12h00</option>
						<option value="12h00-13h00"> 12h00 - 13h00</option>
						<option value="13h00-14h00"> 13h00 - 14h00</option>
						<option value="14h00-15h00"> 14h00 - 15h00</option>
						<option value="15h00-16h00"> 15h00 - 16h00</option>
						<option value="16h00-17h00"> 16h00 - 17h00</option>
						<option value="17h00-18h00"> 17h00 - 18h00</option>
					</select>
				</div>
			</div>

			<div class="form-group form_change" id='optin'>
				<label class="control-label"> Je souhaite recevoir des informations de la part d'Eiffage Immobilier<sup class='form_red'>*</sup> : </label>
				<div class="control">
					<div class="radio-inline">
						<input class="required" type="radio" name="optin1" id="optin1_1" value="1" <?php if ($optin1 == "1") echo "checked"; ?>>
						<label for="optin1_1"> Oui </label>
					</div>
					<div class="radio-inline">
						<input type="radio" id="optin1_2" name="optin1" value="0" <?php if ($optin1 == "0") echo "checked"; ?>>
						<label for="optin1_2"> Non </label>
					</div>
				</div>
			</div>

			<div class="form-group form_change" id='goal'>
				<label class="control-label"> Je souhaite acheter pour : </label>
				<div class="control">
					<div class="radio-inline">
						<input type="radio" id="projet_1" name="projet" value="habiter" <?php if ($projet == "habiter") echo "checked"; ?>>
						<label for="projet_1"> Habiter </label>
					</div>
					<div class="radio-inline">
						<input type="radio" id="projet_2" name="projet" value="investir" <?php if ($projet == "investir") echo "checked"; ?>>  
						<label for="projet_2"> Investir </label>
					</div>
				</div>
			</div>

			<div class="form-group form_change" id='typologie'>
				<label class="control-label"> Je recherche un : </label>
				<div class="control">
					<div class="checkbox-inline">
						<input type="checkbox" name="typologies[]" id="typologies_1" value="1P" <?php if (in_array('1P', $typologies)) echo "checked"; ?>> 
						<label for="typologies_1"> Studio </label>
					</div>
					<div class="checkbox-inline">
						<input type="checkbox" name="typologies[]" id="typologies_2" value="2P" <?php if (in_array('2P', $typologies)) echo "checked"; ?>> 
						<label for="typologies_2"> 2P </label>
					</div>
					<div class="checkbox-inline">
						<input type="checkbox" name="typologies[]" id="typologies_3" value="3P" <?php if (in_array('3P', $typologies)) echo "checked"; ?>> 
						<label for="typologies_3"> 3P </label>
					</div>
					<div class="checkbox-inline">
						<input type="checkbox" name="typologies[]" id="typologies_4" value="4P" <?php if (in_array('4P', $typologies)) echo "checked"; ?>> 
						<label for="typologies_4"> 4P </label>
					</div>
					<div class="checkbox-inline">
						<input type="checkbox" name="typologies[]" id="typologies_5" value="5P" <?php if (in_array('5P', $typologies)) echo "checked"; ?>> 
						<label for="typologies_5"> 5P+ </label>
					</div>
				</div>
			</div>

			<div class="form-group form_change" id='callback'>
				<label class="control-label"> Je souhaite être rappelé par un conseiller : </label>
				<div class="control">
					<div class="radio-inline">
						<input type="radio" name="callback" id="callback_1" value="1" <?php if ($callback == "1") echo "checked"; ?>>  
						<label for="callback_1"> Oui </label>
					</div>
					<div class="radio-inline">
						<input type="radio" name="callback" id="callback_2" value="0" <?php if ($callback == "0") echo "checked"; ?>> 
						<label for="callback_2"> Non </label>
					</div>
				</div>
			</div>


			<input class="token" type="hidden" name="content" value="">
			<input class="form_token" type="hidden" name="form_token" value="">

			<label class="commentary"> Commentary </label>
			<input class="commentary token" type="text" name="commentary" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="commentary" value="">



			<p class="form_mentions">
				Eiffage Immobilier collecte et traite vos données afin de répondre à votre demande d’information sur l’opération commerciale en cours. À cet effet, les champs signalés par un astérisque [*] sont obligatoires. En cliquant sur le bouton « Valider » vous donnez votre consentement à cette fin.
			</p>			
			<div class="form-submit">
				<button type="submit" class="form_btn"> VALIDER </button>
			</div>		
			<p class="form_mentions">
				<span class='form_red'>*</span> Champs obligatoires
			</p>			
			<p class="form_mentions">
				Conformément au règlement général sur la protection des données (RGPD) UE 2016/679 modifié du Parlement européen et du Conseil du 27 avril 2016, vous disposez d’un droit d’accès, de rectification ainsi que d’un droit d’opposition sur les données vous concernant que vous pouvez exercer en nous adressant <a target="_blank" href="https://www.eiffage-immobilier.fr/contact/mes-donnees-personnelles">un formulaire de demande en ligne</a> ou par courrier à Eiffage Immobilier, Direction de la communication ECGD, 11, place de l'Europe - CS 50570 - 78140 Vélizy-Villacoublay. Afin que nous puissions satisfaire cette demande, merci de nous faire parvenir les éléments nécessaires à votre identification : copie d'une pièce d'identité, nom, prénom, e-mail et éventuellement votre adresse postale. Rendez-vous sur notre page <a target="_blank" href="https://www.eiffage-immobilier.fr/politique-confidentialite">Politique de confidentialité</a> pour en savoir plus sur la récolte et le traitement de vos données personnelles.
			</p>
		</form>
	<?php } ?>
</div>

<a id="form_cta" class="scrollTo" href="#formulaire"> TÉLÉCHARGER LA BROCHURE ET BÉNÉFICIER DE NOS OFFRES </a>
