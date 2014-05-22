<?php

    session_start();
    $usuario = $_POST["usuario"];
    $_SESSION["usuario"] = $usuario;
    echo "$usuario";

?>
