 <?php
    require "mod001_conexion (1).php";

    // Función generalista que ejecuta una query y obtiene y transforma los datos de la query con el array $arAttributes.
    function mod002_executeQuery($strSQL, $arAttributes)
    {
        $link = mod001_conectoBD("normal");

        if ($result = $link->query($strSQL)) {
            if ($result->num_rows !== 0) {
                $arRetorno["status"]["codError"] = "000"; // Con datos.
                $arRetorno["status"]["numRows"] = $result->num_rows;

                $i = 0;
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    /* echo "<pre>";
				var_dump( $row );
				echo "</pre>"; */
                    foreach ($arAttributes as $element) {
                        if (isset($element[2])) {
                            if ($element[2] === "bool") {
                                $arRetorno["data"][$i][$element[1]] = (bool)$row[$element[0]];
                            } else if ($element[2] === "int") {
                                if ($row[$element[0]] !== null) {
                                    $arRetorno["data"][$i][$element[1]] = intval($row[$element[0]]);
                                } else {
                                    $arRetorno["data"][$i][$element[1]] = null;
                                }
                            }
                        } else {
                            $arRetorno["data"][$i][$element[1]] = $row[$element[0]];
                        }
                    }
                    /* echo "<pre>";
				var_dump( $arRetorno[ "data" ][ $i ] );
				echo "</pre>"; */
                    $i++;
                }
            } else {
                $arRetorno["status"]["codError"]    = "001"; // Sin datos.
                $arRetorno["status"]["strSQL"]      = $strSQL;
            }
        } else {
            $arRetorno["status"]["codError"]        = "002"; // Error Query.
            $arRetorno["status"]["strSQL"]          = $strSQL;
        }

        mod001_desconectoBD($link);

        return $arRetorno;
    }
    function mod002_getSnekrs($initialItem, $elementsPerPage)
    {
        $arAttributes = [
            ["idmodelo",    "idModel",               "int"],
            ["nommodelo",   "nameModel"],
            ["nomimagen",   "nameImage"],
            ["precio",      "price"]

        ];

        $strSQL = "SELECT `modelos`.`idmodelo`, `modelos`.`nommodelo`, `imagenes`.`nomimagen` , `colormodelostallas`.`precio`
    FROM `modelos`
    INNER JOIN `imagenes`
     ON `modelos`.`idmodelo` = `imagenes`.`idmodelo`
     INNER JOIN `colormodelostallas`
     ON `colormodelostallas`.`idmodelo`=`modelos`.`idmodelo`
    LIMIT $initialItem, $elementsPerPage";



        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }

    function mod002_getDetailSnekrs($idmodelo)
    {
        $arAttributes = [
            ["idmodelo",    "idModel",          "int"],
            ["nommodelo",   "nameModel"],
            ["nomimagen",   "imageSnekrs"]
        ];

        $strSQL = "SELECT m.`idmodelo`, m.`nommodelo`, IM.`nomimagen`
               FROM modelos m
               INNER JOIN imagenes IM
               ON m.idmodelo = IM.idmodelo 
               where m.idmodelo=$idmodelo";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);


        return $arRetorno;
    }
    function mod002_getNumSnekrs()
    {
        $arAttributes = [
            ["numSnekrs",    "numSnekrs",           "int"]
        ];

        $strSQL = "SELECT COUNT(*) AS `numSnekrs`
            FROM `modelos`";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }
    function mod002_getMoreInformationSnekrs($idmodelo)
    {
        $arAttributes = [
            ["nommarca",    "nameBrand"],
            ["nommodelo",   "nameModel"],
            ["precio",      "price"]

        ];

        $strSQL = "SELECT `nommarca`,`nommodelo`,`precio`
            FROM `modelos` 
            INNER JOIN `marcas`
            ON `modelos`.`idmarca`  = `marcas` . `idmarca`
            INNER JOIN `colormodelostallas`
            ON `modelos`.`idmodelo`  = `colormodelostallas` . `idmodelo`
            WHERE `modelos`.`idmodelo` = $idmodelo";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }


    function mod002_setLogin($email, $password)
    {
        $arAttributes = [
            ["idcliente",    "idCostumer",               "int"],
            ["nomcliente",   "nameCostumer"]
        ];

        $strSQL = "SELECT `idcliente`, `nomcliente`
            FROM `clientes`
            WHERE `email` = '$email' AND `password` = '$password'";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }

    function mod002_getIdUserHash($email)
    {
        $arAttributes = [
            ["idusuariohash",    "idUserHash"],
            ["contrasenahash",    "hashContrasena"],
            ["idusuario",    "idUser",               "int"],
            ["nomusuario",   "nameUser"]
        ];

        $strSQL = "SELECT `idusuariohash`, `contrasenahash`, `idusuario`, `nomusuario`
            FROM `usuarioshash`
            WHERE `email` = '$email'";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);


        return $arRetorno;
    }
    function mod002_setCostumer($nomcliente, $telefono, $email, $password)
    {
        $strSQL =
            "INSERT INTO `clientes` 
				( `idcliente`,`nomcliente`, `telefono`, `email`, `password` )
			   VALUES
				( null, '$nomcliente', '$telefono', '$email', '$password' )";

        $link = mod001_conectoBD("normal");

        if ($link->query($strSQL)) {
            if ($link->affected_rows > 0) {
                $arRetorno["status"]["codError"] = "000";             // Con datos.
                $arRetorno["data"]["idusuario"] = $link->insert_id;
            } else {
                $arRetorno["status"]["codError"] = "001";  // No ha habido inserción
            }
        } else if ($link->errno) {
            $arRetorno["status"]["codError"] = "002";
            $arRetorno["status"]["errno"]    = $link->errno;
            $arRetorno["status"]["deserror"] = $link->error;
            $arRetorno["status"]["strSQL"]   = $strSQL;
        }

        return $arRetorno;
    }

    function mod002_getCostumer()
    {

        $arAttributes = [
            ["idcliente",    "idCostumer"],
            ["email",         "nameEmail"],
            ["telefono",         "phone"],
            ["password",         "password"],
            ["nomcliente",         "nameCostumer"],
        ];

        $strSQL = "SELECT idcliente, email, telefono, nomcliente, password
	from `clientes`";

        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }

    function mod002_setsearchModels($nommodelo)
    {
        $arAttributes = [
            ["idmodelo",    "idModel",               "int"],
            ["nommodelo",   "nameModel"],
            ["nomimagen",   "nameImage"],
            ["precio",      "price"]

        ];

        $strSQL = "SELECT `modelos`.`idmodelo`, `modelos`.`nommodelo`, `imagenes`.`nomimagen`, `colormodelostallas`.`precio`
        FROM `modelos`
        INNER JOIN `imagenes`
         ON `modelos`.`idmodelo` = `imagenes`.`idmodelo`
        INNER JOIN `colormodelostallas`
         ON `colormodelostallas`.`idmodelo` = `modelos`.`idmodelo`
        WHERE `modelos`.`nommodelo` LIKE '%$nommodelo%'";


        // var_dump($strSQL);
        // Ejecuta la consulta SQL y obtiene los resultados
        $arRetorno = mod002_executeQuery($strSQL, $arAttributes);

        return $arRetorno;
    }

    function mod002_setMaterials($nommaterial, $idmaterial)
    {
        $strSQL = "INSERT INTO `materiales` (nommaterial)
                   SELECT '$nommaterial'
                   FROM `modelosmaterial`
                   WHERE `idmaterial` = $idmaterial";

        $link = mod001_conectoBD("normal");
        $arRetorno = array(); // Inicializa el arreglo de retorno

        if ($link->query($strSQL)) {
            if ($link->affected_rows > 0) {
                $arRetorno["status"]["codError"] = "000"; // Con datos.
                $arRetorno["data"]["idmaterial"] = $link->insert_id; // Utiliza idmaterial en lugar de idusuario
                $arRetorno["data"]["nommaterial"] = $nommaterial; // Añade nommaterial
            } else {
                $arRetorno["status"]["codError"] = "001"; // No ha habido inserción
            }
        } else if ($link->errno) {
            $arRetorno["status"]["codError"] = "002";
            $arRetorno["status"]["errno"] = $link->errno;
            $arRetorno["status"]["deserror"] = $link->error;
            $arRetorno["status"]["strSQL"] = $strSQL;
        }

        return $arRetorno;
    }
