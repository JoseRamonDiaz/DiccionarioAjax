<?php

require_once '../daos/daoAdministrador.php';


// ejemplo de cómo autenticar al administrador
$apodo='admin';
$password='admin';

$usuario_valido = autenticar($apodo, $password);

if ($usuario_valido != false) {
  echo $usuario_valido->email;
}
else echo "No fue posible validar al usuario.";



?>