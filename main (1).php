<?php
session_start();
require "app/lib/mod004_presentacion (1).php";
require "app/config/constans.php"; 

require "public/vista/vista_detailsnekrs.php";


if (isset($_SESSION['nameUser'])) {
    echo "<p>Hola {$_SESSION['nameUser']}</p>";
    echo "<p><a href='logout.php'>Cerrar Sesión</a></p>";
} else {
    
    echo "<button class='button-link'><a href='login.php'>Iniciar Sesión</a></button>";
    echo "<button class='button-link'><a href='create.php'>Registrarse</a></button>"; 
}

if (isset($_GET["pageActual"])) {
    $pageActual = $_GET["pageActual"];
} else {
    $pageActual = "1";
}

$numPages = 3;
$elementsPerPage = 3;

$layerSnekrs = mod004_getSnekrs($pageActual, $elementsPerPage);
$layerPageSnekrs = mod004_getLayerPaginationSnekrs($pageActual, $elementsPerPage, $numPages);

require "public/vista/vista_main (1).php";
?>
