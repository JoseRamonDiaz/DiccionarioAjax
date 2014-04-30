<?php

class VocabularioEspaniol extends Model {

  public static $_table = 'espaniol';

  public static $_id_column = 'espaniol_id';
  public static $_espaniol_column = 'texto_espaniol';
  public static $_categoria_column = 'categoria_id';

  public function traducciones() {
    return $this->has_many_through('VocabularioMaya');
  }

  public function categoria() {
  	return $this->belongs_to('Categoria');
  }

}

class VocabularioEspaniolVocabularioMaya extends Model {

  public static $_table = 'espaniol_maya';

  public static $_id_espaniol_column = 'espaniol_id';
  public static $_id_maya_column = 'maya_id';

}

?>