<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    header("Content-Type: text/html; charset=UTF-8");
    
    include_once "../daos/daoAdministrador.php";
    validarSesion();
    
    //Capturar id de la categoria
    $id_user=$_POST["id"];
    $nombre=$_POST["nombre"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    
    try{
        $user = findById($id_user);
        
        if ($user){
            $user-> username = $nombre;
            $user-> password = $password;
            $user-> email = $email;
            $user-> save();
                        
            echo json_encode( array( "id"=>$user->administrador_id, "nombre"=>$user->username,"email"=>$user->email) );
            
        } else {
            echo "Ocurrió un error. Los datos no se modificaron.";
        }
        
    } catch (Exception $e) {
        
        echo "Ocurrió un error. Los datos no se modificaron.";    
    }
   
?>

