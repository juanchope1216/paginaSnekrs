<?php
//session_start();

require_once '../lib/mod003_logica (1).php';


$dataRequest = trim(file_get_contents("php://input"));
$arDataRequest = json_decode($dataRequest, true);

switch ($arDataRequest["action"]) {
    case "getMoreInformationSnekrs":

        $data = mod003_getMoreInformationSnekrs($arDataRequest["idmodelo"]);

        echo json_encode($data);
        break;
    case "login":
        $data = mod003_setLoginHash($arDataRequest["email"], $arDataRequest["password"]);

        echo json_encode($data);
        break;

    case "logout":
        //session_destroy();

        echo json_encode(true);
        break;

    case "setCreate":
        $arRetorno = mod003_setCostumer($arDataRequest["nomcliente"], $arDataRequest["telefono"], $arDataRequest["email"], $arDataRequest["password"]);

        echo json_encode($arRetorno);
        break;
    case "search":
        $searchResults = mod003_setsearchModels($arDataRequest["nommodelo"]);
        // Asume que los resultados se almacenan en $searchResults
        echo json_encode($searchResults);
        break;

    case "setMateriales":
        $arRetorno = mod003_setMaterials($arDataRequest["nommaterial"], $arDataRequest["idmaterial"]);

        echo json_encode($arRetorno);
        break;

    default:
        echo "action probablemente mal escrito.";
}
