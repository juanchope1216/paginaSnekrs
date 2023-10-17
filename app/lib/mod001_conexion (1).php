<?php
function mod001_conectoBD( $rol ) {
    switch ( $rol ) {
        case "normal":  // Cambiar perfil.
            $host       = "localhost";
            $username   = "root";
            $passwd     = "";
            $dbname     = "SNEKRS";
        break;
    }

    $link = new mysqli( $host, $username, $passwd, $dbname );

    if ( $link -> connect_error ) {
        die( 'Error de Conexión (' . $link -> connect_errno . ') ' . $link -> connect_error );
    }

    return $link;
}

function mod001_desconectoBD($link) {
    // Realizar la query de desconexión.
    if ($link) {
        $link->close();
    }
}
