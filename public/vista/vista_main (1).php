<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="public/css/common.css" />
    <link rel="stylesheet" href="public/css/login.css" />
    <link rel="stylesheet" href="public/css/create.css" />
    <link rel="stylesheet" href="public/css/search.css" />
    <link rel="stylesheet" href="public/css/pagination.css" />
    <link rel="stylesheet" href="public/css/grabarmaterial.css" />
    <script src="public/js/constants.js"></script>
    <script src="public/js/login.js"></script>
    <script src="public/js/create.js"></script>
    <script src="public/js/search.js"></script>
    <script src="public/js/grabarmaterial.js"></script>

</head>

<body>
    <?php
    require "public/templates/welcomeloginlogout.php";
    echo $dataLogin;
    ?>
    <?php
    require "public/templates/login.php";
    ?>
    <?php
    require "public/templates/create.php";

    ?>
    <?php
    require "public/templates/search.php";

    ?>

    <?php
    require "public/templates/grabarmaterial.php";

    ?>

    <div class="logo-container">
        <img src="public/img/-adidas-logo.jpg" alt="Logo 1" class="logo">
        <img src="public/img/-nike-logo.jpg" alt="Logo 2" class="logo">
        <img src="public/img/-puma-logo.jpg" alt="Logo 1" class="logo">
        <img src="public/img/all-starslogo.jpg" alt="Logo 2" class="logo">
    </div>



  
    </div>

    <h2>SNEKRS</h2>




    <div class="list-container">
        <?php
        echo $layerSnekrs;
        $layerSnekrs = isset($layerSnekrs) ? $layerSnekrs : ''; 
        $layerPageSnekrs = isset($layerPageSnekrs) ? $layerPageSnekrs : ''; 

        ?>
    </div>
    <div class="pagination">
        <?php
        echo $layerPageSnekrs;
        ?>
    </div>


    <footer style="background-color: #222; color: white; text-align: center; padding: 10px 0;">
        Derechos de autor &copy; <?php echo date("Y"); ?> Tu Empresa. Todos los derechos reservados.
    </footer>
</body>

</html>