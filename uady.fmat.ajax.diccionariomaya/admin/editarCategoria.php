<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-Type: text/html; charset=UTF-8");
    
    require_once '../daos/daoCategoria.php';
    
    //Capturar id de la categoria
    $id_categoria=$_POST["id"];
    $nombre=$_POST["nombre"];
    $abreviatura=$_POST["abreviatura"];
    
    //Buscar la categoria en la base de datos
    $categoria = obtenerCategoriaPorId($id_categoria);
    
    
    // si la categoria existe se actualiza
    if ($categoria != false) {
        
        $categoria->nombre = $nombre;
        $categoria->abreviatura = $abreviatura;
        $resultado = actualizarCategoria($categoria);
        
        if ($resultado!=false){
            //echo "La categoria se ha modificado.";
            echo json_encode( array( "id"=>$resultado->categoria_id, "nombre"=>$resultado->nombre,"abreviatura"=>$resultado->abreviatura) );
        } else {
            echo "No se pudo modificar la categoria.";
        }
    } else {
        echo "Error: La categoria no existe en la base de datos.";
    }
?>
