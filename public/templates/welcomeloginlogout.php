<?php
    $dataLogin = "<div class='wrapperwelcomelogin'>";
    if (isset($_SESSION['nameUser'])) {
        $dataLogin.= "<p>Hola {$_SESSION['nameUser']}</p>";
        $dataLogin.= "<p><a href='logout.php'>Cerrar Sesion</a></p>";
    } else {
      
    }
    $dataLogin.= "</div>";
    
?>