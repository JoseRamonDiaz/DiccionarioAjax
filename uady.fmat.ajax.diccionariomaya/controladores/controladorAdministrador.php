<?php

require_once '../daos/daoAdministrador.php';

$apodo='admin';
$password='admin';

$usuario_valido = autenticar($apodo, $password);

if ($usuario_valido != false) {
  echo $usuario_valido->email;
}
else echo "No fue posible validar al usuario.";

?>