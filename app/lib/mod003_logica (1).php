 <?php
	require "mod002_accesoadatos (1).php";


	function mod003_getSnekrs($pageActual, $elementsPerPage)
	{
		


		$arDataSnekrs = mod002_getSnekrs(($pageActual - 1) * $elementsPerPage, $elementsPerPage);


		if ($arDataSnekrs["status"]["codError"] === "000") {
			return $arDataSnekrs["data"];
		} else {
			return $arDataSnekrs["status"];
		}
	}
	function mod003_getDetailSnekrs($idmodelo)
	{
		$arDetailSnekrs = mod002_getDetailSnekrs($idmodelo);

		if ($arDetailSnekrs["status"]["codError"] === "000") {
		
			return $arDetailSnekrs["data"][0];
		} else {
			return $arDetailSnekrs["status"];
		}
	}



	function mod003_getPagesSnekrs($elementsPerPage)
	{
		$arDataNumSnekrs = mod002_getNumSnekrs();

		if ($arDataNumSnekrs["status"]["codError"] === "000") {



			$totalPages = strval(ceil($arDataNumSnekrs["data"][0]["numSnekrs"] / $elementsPerPage));
		}

		return $totalPages;
	}

	function mod003_getMoreInformationSnekrs($idmodelo)
	{
		$arData = mod002_getMoreInformationSnekrs($idmodelo);

		if ($arData["status"]["codError"] === "000") {
			return $arData["data"][0];
		} else {
			return $arData["status"];
		}
	}
	
	function mod003_setLogin($email, $password)
	{
		$dataUser = mod002_setLogin($email, $password);

		if ($dataUser["status"]["codError"] === "000") {
			$_SESSION["idCostumer"] = $dataUser["data"][0]["idCostumer"];
			$_SESSION["nameCostumer"] = $dataUser["data"][0]["nameCostumer"];
			return [
				"result" => true,
				"name"	 => $dataUser["data"][0]["nameCostumer"]
			];
		} else {
			// Gestionar error.
			return [
				"result" => false
			];
		}
	}

	function mod003_setLoginHash($email, $password)
	{
		$dataUser = mod002_getIdUserHash($email);

		if ($dataUser["status"]["codError"] === "000") {
			$idUserHash = $dataUser["data"][0]["idUserHash"];
			$contrasenaHash = $dataUser["data"][0]["hashContrasena"];

			if (password_verify($password . $idUserHash, $contrasenaHash)) {

				$_SESSION["idUser"] = $dataUser["data"][0]["idUser"];
				$_SESSION["nameUser"] = $dataUser["data"][0]["nameUser"];
				return [
					"result" => true,
					"name"	 => $dataUser["data"][0]["nameUser"]
				];
			} else {
				// Gestionar error.
				return [
					"result" => false
				];
			}
		} else {
			
			return [
				"result" => false
			];
		}
	}
	function mod003_setCostumer($nomcliente, $telefono, $email, $password)
	{
		$arRetorno = mod002_setCostumer($nomcliente, $telefono, $email, $password);
		if ($arRetorno["status"]["codError"] === "000") {
			
			return $arRetorno["data"];
		} else {
			
		}
	}

	function mod003_getCostumer()
	{
		$arRetorno = mod002_getCostumer();
		if ($arRetorno["status"]["codError"] === "000") {
			return $arRetorno["data"];
		} else {
			$arRetorno["status"];
		}
	}
	function mod003_setsearchModels($nommodelo)
	{
		$snekrs =  mod002_setsearchModels($nommodelo);
		if ($snekrs["status"]["codError"] === "000") {
			$_SESSION["idModel"] = $snekrs["data"][0]["idModel"];
			$_SESSION["nameModel"] = $snekrs["data"][0]["nameModel"];
			$_SESSION["nameImage"] = $snekrs["data"][0]["nameImage"];

			$resultData = [];
			foreach ($snekrs["data"] as $data) {
				$resultData[] = [
					"nameModel" => $data["nameModel"],
					"price" => $data["price"],
					"nameImage" => $data["nameImage"]
				];
			}

		
			return $resultData;
		} else {
			return false;
		}
	}


	function mod003_logout()
	{
		session_start(); 

		
		$_SESSION = array();

		
		session_destroy();
	}

	function mod003_setMaterials($nommaterial, $idmaterial)
	{
		$arRetorno = mod002_setMaterials($nommaterial, $idmaterial);

		if ($arRetorno["status"]["codError"] === "000") {
			
			$arRetorno["data"]["idmaterial"] = $arRetorno["data"]["idmaterial"]; 
			$arRetorno["data"]["nommaterial"] = $nommaterial;
		} else {
			
		}

		return $arRetorno;
	}
	

