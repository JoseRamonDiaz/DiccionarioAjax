<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    header("Content-Type: text/plain");
    
    require_once '../daos/daoCategoria.php';
    
    //Capturar datos de la categoria nueva
    $nombreCategoria=$_POST["nombre"];
    $abreviatura=$_POST["abreviatura"];

    // llamar a la funciónn del dao que guarda la categoria
    $categoria = guardarCategoria($nombreCategoria, $abreviatura);
 
    // si la categoria se guardó ...
    if ($categoria != false) {
        echo "Una nueva categor&iacute;a ha sido creada";
    }    

?>
