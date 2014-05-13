<?php

    header("Content-Type: text/plain");
    
    require_once '../daos/daoAdministrador.php';
    
    //get information
    $apodo = $_POST["username"];
    $password = $_POST["password"];

    $usuario_valido = autenticar($apodo, $password);

    if ($usuario_valido != false) {
        $sInfo = "exito";
    }
    else $sInfo = "Credenciales inv&acute;lidas";

    echo $sInfo;
    
?>