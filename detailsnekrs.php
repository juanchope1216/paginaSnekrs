<?php
	require "app/lib/mod004_presentacion (1).php";

	if (isset($_GET["idmodelo"])) {
		$idmodelo = $_GET["idmodelo"];
	} else {
		$idmodelo = 9;
	}
	
	$layerDetailSnekrs = mod004_getDetailSnekrs($idmodelo);

	require "public/vista/vista_detailsnekrs.php";
?>
