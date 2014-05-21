<?php
include 'conexion.php';
require_once '../modelos/administrador.php';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $password);

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
			return true;
        }
        
        return false;
        
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
* Localiza al usuario por su nombre
*/
function findByUsername($username) {

    try{
        $administrador = Model::factory('Administrador')
        ->where_equal('username', $username)
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
* Localiza al usuario por id
*/
function findById($id) {

    try{
        $administrador = Model::factory('Administrador')
        ->where_equal('administrador_id', $id)
        ->find_one();
        
        if ($administrador){
            return $administrador;
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
function editarContrasenia($id, $password){
    
    try{
        $administrador = findById($id);
        
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

/**
* Editar nombre de usuario del administrador
*/
function editarNombreUsuario($id, $username){
    
    try{
        $administrador = findById($id);
        
        if ($administrador){
            $administrador-> username = $username;
            $administrador-> save();
        
            return true;
            
        } else {
            return false;
        }
        
    } catch (Exception $e) {
    
        return false;    
    }
  
}

/**
* Editar email del administrador
*/
function editarEmail($id, $email){
    
    try{
        $administrador = findById($id);
        
        if ($administrador){
            $administrador-> email = $email;
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