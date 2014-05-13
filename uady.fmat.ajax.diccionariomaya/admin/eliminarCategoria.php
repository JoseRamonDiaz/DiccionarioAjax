<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-Type: text/html; charset=UTF-8");
    
    require_once '../daos/daoCategoria.php';
    
    //Capturar id de la categoria
    $id_categoria=$_GET["id"];
    
    //Buscar la categoria en la base de datos
    $categoria = obtenerCategoriaPorId($id_categoria);

    // si la categoria existe se elimina
    if ($categoria != false) {
        $resultado = eliminarCategoria($categoria);
        
        if ($resultado!=false){
            echo "La categoria se ha eliminado.";
        } else {
            echo "La categoria no se pudo eliminar.";
        }
    } else {
        echo "Error: La categoria no existe en la base de datos.";
    }
    
?>
