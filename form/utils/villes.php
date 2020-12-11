<?php
	error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE);
	ini_set ('display_errors', 1);
	$config = array(
		"tools.dbhost" => "localhost",
		"tools.dbport" => 3306,
		"tools.dbname" => "tools",
		"tools.dbuser" => "prod",
		"tools.dbpass" => "Click-Call2014"
	);
	try {
		$pdo_tools = new PDO('mysql:host='.$config['tools.dbhost'].';port='.$config['tools.dbport'].';dbname='.$config['tools.dbname'], $config['tools.dbuser'], $config['tools.dbpass'], array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
	} catch (Exception $e) {
		die();
	}
	$results = array();
	$q = strtoupper(utf8_decode($_GET["term"]));
	$q = strtr($q,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	$query = $pdo_tools->prepare("SELECT * FROM villes WHERE nom LIKE '".strtoupper($q)."%' OR nom LIKE '".str_replace('SAINT', 'ST', strtoupper($q))."%' OR code_postal LIKE '".$q."%' ORDER BY substr(code_postal,3,3) ASC LIMIT 10");
	$query->execute();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		array_push($results, array(
			'ville' => strtoupper($row['nom']),
			'code_postal' => $row['code_postal'],
			'label' => $row['code_postal']." ".strtoupper($row['nom']),
			'value' => $row['code_postal']." ".strtoupper($row['nom'])
		));
	}
	echo json_encode($results);
