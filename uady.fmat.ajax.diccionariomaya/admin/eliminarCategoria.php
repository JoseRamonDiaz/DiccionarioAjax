<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-Type: text/html; charset=UTF-8");
    
    require_once '../daos/daoCategoria.php';
    include_once "../daos/daoAdministrador.php";
    validarSesion();
    
    //Capturar id de la categoria
    $id_categoria=$_GET["id"];
    
    //Buscar la categoria en la base de datos
    $categoria = obtenerCategoriaPorId($id_categoria);

    // si la categoria existe se intenta eliminar
    if ($categoria != false) {
        $resultado = eliminarCategoria($categoria);
        
        if ($resultado!=false){
            //Se eliminó
            echo $resultado;
        } else {
            //"La categoria no se pudo eliminar.";
            echo $resultado;
        }
    } else {
        //"Error: La categoria no existe en la base de datos."
        echo false;
    }
    
?>
