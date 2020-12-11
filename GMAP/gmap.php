<script type="text/javascript">
	let	gmap;
	let	gmap_center;
	let	gmap_query_radius = 1000;
	let	gmap_zoom = 12;
	let	gmap_markers = {
		/** Commerces */
		'gmap_bakery': [],
		'gmap_store': [],
		'gmap_hair_care': [],
		'gmap_restaurant': [],
		'gmap_supermarket': [],
		/** Écoles */
		'gmap_primary_school': [],
		'gmap_secondary_school': [],
		'gmap_university': [],
		'gmap_school': [],
		/** Services */
		'gmap_bank': [],
		'gmap_police': [],
		'gmap_city_hall': [],
		'gmap_post_office': [],
		/** Loisirs */
		'gmap_library': [],
		'gmap_movie_theater': [],
		'gmap_museum': [],
		'gmap_park': [],
		'gmap_gym': [],
		/** Santé */
		'gmap_dentist': [],
		'gmap_doctor': [],
		'gmap_hospital': [],
		'gmap_pharmacy': [],
		'gmap_veterinary_care': [],
		/** Transports */
		'gmap_airport': [],
		'gmap_bus_station': [],
		'gmap_train_station': [],
		'gmap_subway_station': [],
		'gmap_parking': [],
	};

	function	get_map(target_id) {
		gmap_center = { lat: <?=$config['map.markers'][0][2]?>, lng: <?=$config['map.markers'][0][3]?> };
		gmap = new google.maps.Map(document.getElementById(target_id), {
			center: gmap_center,
			zoom: gmap_zoom,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [{ "stylers": [{ "saturation": 10 }, { "gamma": 0 }] }]
		});
	}

	function	init_map(target_id) {
		get_map(target_id);
		<?php for ($i = 0, $len = count($config['map.markers']); $i < $len; $i++) { ?>
				var marker<?=$i;?> = new google.maps.Marker({
					position: new google.maps.LatLng(<?=$config['map.markers'][$i][2];?>, <?=$config['map.markers'][$i][3];?>),
					title: "<?=$config['map.markers'][$i][0];?>",
					icon: "<?=$config['map.markers'][$i][1];?>",
					anchor: new google.maps.Point(123, 55),
					map: gmap
				});
				marker<?=$i;?>.setMap(gmap);
		<?php } ?>
	}

	/** ----------------------------------------------------------- */

	function	create_marker(places, target_id) {
		for (let i = 0, place; (place = places[i]); i++) {
			const	image = {
				url: place.icon,
				size: new	google.maps.Size(71, 71),
				origin: new	google.maps.Point(0, 0),
				anchor: new	google.maps.Point(17, 34),
				scaledSize: new	google.maps.Size(25, 25),
			};
			let	marker = new	google.maps.Marker({
    			map: gmap,
    			icon: image,
    			title: place.name,
    			position: place.geometry.location,
			});
			gmap_markers[target_id].push(marker);
		}
	}

	function	clear_markers(target_id) {
		for (let i = 0; i < gmap_markers[target_id].length; i++)
			gmap_markers[target_id][i].setMap(null);
		gmap_markers[target_id].length = 0;
	}

	function	nearby_search(target_id, target_type) {
		if ($('#' + target_id).is(':checked'))
		{
			service = new google.maps.places.PlacesService(gmap);
			service.nearbySearch(
    			{ location: gmap_center, radius: gmap_query_radius, type: target_type },
    			(results, status) => {
					if (status !== "OK")
						return ;
					create_marker(results, target_id);
				}
			);
    	}
		else
			clear_markers(target_id);
	}

	/** ----------------------------------------------------------- */

	$(document).ready (function(){

		init_map('gmap');

		/** Commerces ---------- */
		$('#gmap_bakery').on("change", function() {
			nearby_search("gmap_bakery", "bakery");
		});
		$('#gmap_store').on("change", function() {
			nearby_search("gmap_store", "store");
		});
		$('#gmap_hair_care').on("change", function() {
			nearby_search("gmap_hair_care", "hair_care");
		});
		$('#gmap_restaurant').on("change", function() {
			nearby_search("gmap_restaurant", "restaurant");
		});
		$('#gmap_supermarket').on("change", function() {
			nearby_search("gmap_supermarket", "supermarket");
		});
		/** -------------------- */

		/** Écoles ---------- */
		$('#gmap_primary_school').on("change", function() {
			nearby_search("gmap_primary_school", "primary_school");
		});
		$('#gmap_secondary_school').on("change", function() {
			nearby_search("gmap_secondary_school", "secondary_school");
		});
		$('#gmap_university').on("change", function() {
			nearby_search("gmap_university", "university");
		});
		$('#gmap_school').on("change", function() {
			nearby_search("gmap_school", "school");
		});
		/** -------------------- */

		/** Services ---------- */
		$('#gmap_bank').on("change", function() {
			nearby_search("gmap_bank", "bank");
		});
		$('#gmap_police').on("change", function() {
			nearby_search("gmap_police", "police");
		});
		$('#gmap_city_hall').on("change", function() {
			nearby_search("gmap_city_hall", "city_hall");
		});
		$('#gmap_post_office').on("change", function() {
			nearby_search("gmap_post_office", "post_office");
		});
		/** -------------------- */

		/** Loisirs ---------- */
		$('#gmap_library').on("change", function() {
			nearby_search("gmap_library", "library");
		});
		$('#gmap_movie_theater').on("change", function() {
			nearby_search("gmap_movie_theater", "movie_theater");
		});
		$('#gmap_museum').on("change", function() {
			nearby_search("gmap_museum", "museum");
		});
		$('#gmap_park').on("change", function() {
			nearby_search("gmap_park", "park");
		});
		$('#gmap_gym').on("change", function() {
			nearby_search("gmap_gym", "gym");
		});
		/** -------------------- */

		/** Santé ---------- */
		$('#gmap_dentist').on("change", function() {
			nearby_search("gmap_dentist", "dentist");
		});
		$('#gmap_doctor').on("change", function() {
			nearby_search("gmap_doctor", "doctor");
		});
		$('#gmap_hospital').on("change", function() {
			nearby_search("gmap_hospital", "hospital");
		});
		$('#gmap_pharmacy').on("change", function() {
			nearby_search("gmap_pharmacy", "pharmacy");
		});
		$('#gmap_veterinary_care').on("change", function() {
			nearby_search("gmap_veterinary_care", "veterinary_care");
		});
		/** -------------------- */

		/** Transports ---------- */
		$('#gmap_airport').on("change", function() {
			nearby_search("gmap_airport", "airport");
		});
		$('#gmap_bus_station').on("change", function() {
			nearby_search("gmap_bus_station", "bus_station");
		});
		$('#gmap_train_station').on("change", function() {
			nearby_search("gmap_train_station", "train_station");
		});
		$('#gmap_subway_station').on("change", function() {
			nearby_search("gmap_subway_station", "subway_station");
		});
		$('#gmap_parking').on("change", function() {
			nearby_search("gmap_parking", "parking");
		});
		/** -------------------- */
	});
</script>
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2DM5JLy-qYpVyAyhkifQcDaEdElLzOY0&libraries=places">
</script>
