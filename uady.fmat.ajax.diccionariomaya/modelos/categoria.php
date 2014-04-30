<?php

require_once '../../idiorm/idiorm.php';
require_once '../../paris/paris.php';

class Categoria extends Model {

  public static $_table = 'categoria';

  public static $_id_column = 'categoria_id';
  public static $_nombre_column = 'nombre';
  public static $_abreviatura_column = 'abreviatura';

  public function clasifica_espaniol() {
  	return $this->has_many('VocabularioEspaniol');
  }

  public function clasifica_maya() {
  	return $this->has_many('VocabularioMaya');
  }

}

?>