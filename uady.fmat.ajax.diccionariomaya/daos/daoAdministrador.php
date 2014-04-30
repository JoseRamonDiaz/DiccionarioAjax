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

    return $administrador;

  } catch (Exception $e) {
    
    return false;
  }
    
  }

?>