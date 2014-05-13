<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    header("Content-Type: text/html; charset=UTF-8");
    
    require_once '../daos/daoCategoria.php';
    
    //Capturar datos de la categoria nueva
    $nombreCategoria=$_POST["nombre"];
    $abreviatura=$_POST["abreviatura"];

    // llamar a la funciónn del dao que guarda la categoria
    $categoria = guardarCategoria($nombreCategoria, $abreviatura);
 
    // si la categoria se guardó ...
    if ($categoria != false) {
        echo "Una nueva categoria ha sido creada.";
    } else {
        echo "Error: No se guardaron los datos.";
    }   

?>
