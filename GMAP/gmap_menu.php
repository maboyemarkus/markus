<!DOCTYPE html>

	<style>
		#gmap_menu { display: none !important; }

		#gmap_menu span { display: none; }
		#gmap_menu li { width: 46px; height: 23px; }

		#gmap_menu {
			position: relative;
			top: 3%;
			left: 37%;
			z-index: 52;
		}
		#gmap_menu ul {
			position: absolute;
			list-style: none;
			margin-top: 2%;
		}
		#gmap_menu li {
			float: left;
			border-left: 1px solid #F2F2F2;
		}

		#gmap_menu li ul { box-shadow: -1px 1px 5px lightgrey; }

		#gmap_menu li div { text-align: center !important; }
		#gmap_menu li:first-child { border-left: none; }
		#gmap_menu li:hover,
		#gmap_menu .btn:hover {
			background-color: #F2F2F2;
		}

		#gmap_menu div img { width: 20px; height: 20px; }

		#gmap_menu .btn {
			width: 100%;
			padding-top: 0.5vw;
			background-color: #FFFFFF;
			color: black;
			border-radius: 0;
			text-align: left;
		}

		#gmap {
			z-index: 50;
			display: block;
			width: 100%;
			height: 100%;
			position: relative;
			top: 0;
			left: 0;
		}

		@media (max-width: 800px) {
			#gmap_menu {
				position: absolute;
				left: 3%;
				top: 20%;
				z-index: 100;
			}
		}

	</style>
	<div id='gmap_menu'>
    	<ul>
    	    <li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/commerces.svg'/>
					<span> Commerces </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_bakery"> Boulangeries </label>
					<label class='btn'><input type="checkbox" id="gmap_store"> Boutiques </label>
					<label class='btn'><input type="checkbox" id="gmap_hair_care"> Coiffeurs </label>
					<label class='btn'><input type="checkbox" id="gmap_restaurant"> Restaurants </label>
					<label class='btn'><input type="checkbox" id="gmap_supermarket"> Supermarchés </label>
				</div>
    	    </li>
    	    <li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/school.svg'/>
					<span> Écoles </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_primary_school"> Écoles primaires </label>
					<label class='btn'><input type="checkbox" id="gmap_secondary_school"> Collèges </label>
					<label class='btn'><input type="checkbox" id="gmap_university"> Universités </label>
					<label class='btn'><input type="checkbox" id="gmap_school"> Écoles </label>
				</div>
			</li>
			<li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/services.svg'/>
					<span> Services </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_bank"> Banques </label>
					<label class='btn'><input type="checkbox" id="gmap_police"> Commissariats </label>
					<label class='btn'><input type="checkbox" id="gmap_city_hall"> Mairies </label>
					<label class='btn'><input type="checkbox" id="gmap_post_office"> Postes </label>
				</div>
			</li>
			<li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/loisirs.svg'/>
					<span> Loisirs </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_library"> Bibliothèques </label>
					<label class='btn'><input type="checkbox" id="gmap_movie_theater"> Cinémas </label>
					<label class='btn'><input type="checkbox" id="gmap_museum"> Musés </label>
					<label class='btn'><input type="checkbox" id="gmap_park"> Parcs </label>
					<label class='btn'><input type="checkbox" id="gmap_gym"> Salles de sport </label>
				</div>
			</li>
			<li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/health.svg'/>
					<span> Santé </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_dentist"> Dentistes </label>
					<label class='btn'><input type="checkbox" id="gmap_doctor"> Docteurs </label>
					<label class='btn'><input type="checkbox" id="gmap_hospital"> Hôpitaux </label>
					<label class='btn'><input type="checkbox" id="gmap_pharmacy"> Pharmacies </label>
					<label class='btn'><input type="checkbox" id="gmap_veterinary_care"> Vétérinaires </label>
				</div>
			</li>
			<li class="dropdown">
				<div class='btn dropdown-toggle' data-toggle="dropdown">
					<img src='GMAP/gmap_logo/transports.svg'/>
					<span> Transports </span>
				</div>
    	        <div class="dropdown-menu">
					<label class='btn'><input type="checkbox" id="gmap_airport"> Aéroports </label>
					<label class='btn'><input type="checkbox" id="gmap_bus_station"> Bus </label>
					<label class='btn'><input type="checkbox" id="gmap_train_station"> Gares </label>
					<label class='btn'><input type="checkbox" id="gmap_subway_station"> Métros </label>
					<label class='btn'><input type="checkbox" id="gmap_parking"> Parkings </label>
				</div>
			</li>
		</ul>
	</div>
	<div id='gmap'></div>
	<?php include ("GMAP/gmap.php"); ?>
