<?php
	require "mod003_logica (1).php";

	function mod004_getSnekrs($pageActual, $elementsPerPage) {
		$arDataSnekrs = mod003_getSnekrs($pageActual, $elementsPerPage);
		$listSnekrs = "";
	
		foreach ($arDataSnekrs as $snekrs) {
			$listSnekrs .= "<p>";
			$listSnekrs .= "<img src='public/img/{$snekrs["nameImage"]}' alt='{$snekrs["nameModel"]}' class='sneaker-image'>";
			$listSnekrs .= "<p class='sneaker-name'>{$snekrs["nameModel"]}</p>";
			$listSnekrs .= "<p class='sneaker-price'>{$snekrs["price"]}</p>";
			$listSnekrs .= "</p>";
		}
		
	
		return $listSnekrs;
	}
	
	
	
	function mod004_getLayerPaginationSnekrs($pageActual, $elementsPerPage, $numPages) {
		$totalPages = mod003_getPagesSnekrs($elementsPerPage);
		$layerPageSnekrs = "<div class='pageSnekrs'>";
		if ($pageActual === "1") {
			$layerPageSnekrs .= "<span>Ant</span>";
		} else {
			$pagePrev = $pageActual - 1;
			$layerPageSnekrs .= "<a href='main (1).php?pageActual=$pagePrev'><span>Ant</span></a>";
		}
	
		if ($pageActual === $totalPages) {
			$layerPageSnekrs .= "<span>Sig</span>";
		} else {
			$pageNext = $pageActual + 1;
			$layerPageSnekrs .= "<a href='main (1).php?pageActual=$pageNext'><span>Sig</span></a>";
		}
	
		$layerPageSnekrs .= "</div>";
	
		$numPagesHalf = floor($numPages / 2);
		$data1 = $totalPages - $pageActual - $numPagesHalf;
	
		$data2 = ($data1 < 0) ? $data1 * -1 : 0;
		if ($numPages % 2 === 0) {
			$iInitial = ($pageActual - $numPagesHalf - $data2 + 1) < 1 ? 1 : ($pageActual - $numPagesHalf - $data2 + 1);
		} else {
			$iInitial = ($pageActual - $numPagesHalf - $data2) < 1 ? 1 : ($pageActual - $numPagesHalf - $data2);
		}
	
		for ($i = $iInitial; $i < $iInitial + $numPages; $i++) {
			$layerPageSnekrs .= "<a href='main (1).php?pageActual=$i'><span>$i</span></a>";
		}
		return $layerPageSnekrs;
	}

	function mod004_getDetailSnekrs( $idmodelo ) {
		$arDetailSnekrs = mod003_getDetailSnekrs( $idmodelo );
		if ( isset( $arDetailSnekrs[ "codError" ] ) ) {
			// La query no retorna datos.
			$layerDetailSnekrs = "<p class='error'>Lo sentimos no hay resultados, ¿no habras tocado la URL?.</p>";
		} else {
			// Si retorna
			$layerDetailSnekrs = "<div data-idmodelo='$idmodelo ' class='modelo'>";

			$layerDetailSnekrs.= "<h1>{$arDetailSnekrs[ "nameModel" ]}</h1>";
			$layerDetailSnekrs.= "<div class='imageSnekrs'>";
			$layerDetailSnekrs.= "<public/img src='{$arDetailSnekrs[ "imageSnekrs" ]}' class='width100' >";
			$layerDetailSnekrs.= "</div>";
			$layerDetailSnekrs .= "<p class='moreinformation'>Ver más</p>";
			$layerDetailSnekrs .= "</div>";
		}

		return $layerDetailSnekrs;
	}
	
	function mod004_sesetMaterials($nommmaterial, $idmaterial) {
    $arRetorno = mod003_setMaterials($nommmaterial, $idmaterial);
    $layerMessage = "";  

    if (!empty($arRetorno)) {
        $layerMessage = "<p>Material dada de alta correctamente.</p>";
        $layerMessage .= "<a href='main.php'><p>volver a formulario división</p></a>";
    } else {
        $layerMessage = "<p>Error al dar de alta la material.</p>";
    }

    return $layerMessage;
}

	function mod004_setLogin($email, $password) {
		$isValidUser = mod003_setLogin($email, $password);
	
		return $isValidUser;
	}
	

	
	function mod004_setCostumer($nomcliente, $telefono, $email, $password) {
		$idUser = mod003_setCostumer($nomcliente, $telefono, $email, $password);
		if ($idUser > 0) {
			$layerMessage = "<p>Registrado correctamente.</p>";
			$layerMessage .= "<a href='main.php'><p>volver a formulario división</p></a>";
		
	
		return $layerMessage;
	}
	}
	function mod004_logout() {
		mod003_logout();
	}
