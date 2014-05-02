<?php

require_once '../modelos/vocabularioMaya.php';

ORM::configure('mysql:host=localhost;dbname=diccionario');
ORM::configure('username', 'root');
ORM::configure('password', 'centenario');

function guardarVocabularioMaya($textoMaya, $rutaAudio, $categoriaId) {

  try {
  	$nueva_entrada_maya = Model::factory('VocabularioMaya')->create();
    $nueva_entrada_maya->texto_maya = $textoMaya;
    $nueva_entrada_maya->nombre_audio = $rutaAudio;
    $nueva_entrada_maya->categoria_id = $categoriaId;
    $nueva_entrada_maya->save();

    return $nueva_entrada_maya;

  } catch (Exception $e) {
  	return false;
  }

}

function agregarTraduccionEspaniol($palabra, $idEspaniol){

 // try {
  	$es_traduccion_de = Model::factory('VocabularioMayaVocabularioEspaniol')->create();
    
    $es_traduccion_de->espaniol_id = $idEspaniol;

    $es_traduccion_de->maya_id = $palabra->maya_id;
    $es_traduccion_de->save(); 

    return true;

  //} catch (Exception $e) {
  //	return false;
  //}

}

