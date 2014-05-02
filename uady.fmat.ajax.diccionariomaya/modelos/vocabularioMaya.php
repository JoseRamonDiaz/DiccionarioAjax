<?php

require_once 'idiorm/idiorm.php';
require_once 'paris/paris.php';

class VocabularioMaya extends Model {

  public static $_table = 'maya';

  public static $_id_column = 'maya_id';
  public static $_maya_column = 'texto_maya';
  public static $_audio_column = 'nombre_audio';
  public static $_categoria_column = 'categoria_id';

  public function traducciones() {
    return $this->has_many_through('VocabularioEspaniol');
  }

  public function categoria() {
  	return $this->belongs_to('Categoria');
  }

}

class VocabularioMayaVocabularioEspaniol extends Model {

  public static $_table = 'espaniol_maya';

  public static $_id_espaniol_column = 'espaniol_id';
  public static $_id_maya_column = 'maya_id';

}

?>