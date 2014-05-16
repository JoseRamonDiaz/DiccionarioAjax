<?php

require_once '../modelos/administrador.php';

ORM::configure('mysql:host=localhost;dbname=diccionario');
ORM::configure('username', 'root');
ORM::configure('password', 'centenario');

/**
* Valida las credenciales del administrador.
*
* @return Administrador $administrador si las credenciales son válidas
* @return boolean false si una o las dos credenciales no son válidas
*                       o si ocurrió un error con la base de datos
* @param string $username nombre de su cuenta de usuario
* @param string $password constraseña de la cuenta de usuario
*/
function autenticar($username, $password) {

    try{
        $administrador = Model::factory('Administrador')
        ->where_equal('username', $username)
        ->where_equal('password', $password)
        ->find_one();
    
        if($administrador){
            session_start();
            $_SESSION["usuario"] = $username;
        }
        
        return $administrador->id;
        
    } catch (Exception $e) {
    
        return false;    
    }
    
}
  
function validarSesion(){
    session_start();
    if(!isset($_SESSION["usuario"])){
        $destino = "Location:index.html";
        header($destino);
        exit();
    }
}

/**
* Localiza al usuario mediante email
*/
function findByEmail($email) {

    try{
        $administrador = Model::factory('Administrador')
        ->where_equal('email', $email)
        ->find_one();
        
        if ($administrador){
            return $administrador->administrador_id;
        } else {
            return false;
        }
    } catch (Exception $e) {
    
        return false;    
    }
    
}

/**
* Editar contrase�a del administrador
*/
function editarPerdil($id, $password){
    
    try{
        $administrador = Model::factory('Administrador')
        ->where_equal('administrador_id', $id)
        ->find_one();
        
        if ($administrador){
            $administrador-> password = $password;
            $administrador-> save();
        
            return true;
            
        } else {
            return false;
        }
        
    } catch (Exception $e) {
    
        return false;    
    }
    
    
}
?>