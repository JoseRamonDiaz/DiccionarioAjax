<?php

require_once '../daos/daoVocabularioMaya.php';
require_once '../daos/daoCategoria.php';


$textoMaya ='pek';
$rutaAudio = '';
$categoriaId = 1;

$nuevaEntradaMaya = guardarVocabularioMaya($textoMaya, $rutaAudio, $categoriaId);

echo $nuevaEntradaMaya->texto_maya;

if ($nuevaEntradaMaya!=false){

$idEspaniol=2;

$id=$nuevaEntradaMaya->maya_id;

$resultado=agregarTraduccionEspaniol($nuevaEntradaMaya, $idEspaniol);

echo $resultado;

if ($resultado)

echo 'Hay una nueva palabra en el diccionario.';

}else echo 'Problemas';

?>