<?php

require_once '../daos/daoCategoria.php';

//Capturar datos de la categoria nueva
$nombreCategoria='Sustantivo';
$abreviatura='S.';

// llamar a la función del dao que guarda la categoria
$categoria = guardarCategoria($nombreCategoria, $abreviatura);

// si la categoria se guardó ...
if ($categoria != false) {
  echo $categoria->categoria_id;

  //Ejemplo de cómo actualizar la categoria recién creada
  $categoria->nombre='Verbo';
  $categoria->abreviatura='V.';

  $categoria_actualizada = actualizarCategoria($categoria);

  if ($categoria_actualizada !=false)
  	echo $categoria_actualizada->abreviatura;
  else echo "Ocurrió un error!!";

  // ejemplo de cómo eliminar la categoria anteriormente creada y actualizada
  if (eliminarCategoria($categoria))
  	echo "se eliminó";
  else
  	echo "no se eliminó";

} // si no se guardó ...
else 
	echo "Ocurrió un error";


//ejemplo de cómo obtener una categoria específica
$categoria_buscada_por_id = obtenerCategoriaPorId(15);

if ($categoria_buscada_por_id!=false) {

  echo $categoria_buscada_por_id->nombre;
  
  // una vez obtenida la categoría podemos actualizarla o eliminarla

  //ejemplo de actualización
  $categoria->nombre='Adverbio';
  $categoria->abreviatura='Adv.';

  $categoria_actualizada2 = actualizarCategoria($categoria);

  if ($categoria_actualizada2 !=false)
  	echo $categoria_actualizada->abreviatura;
  else echo "Ocurrió un error!!";

}
else 
	echo "error en la búsqueda";


$lista_categorias = obtenerTodasCategorias();

foreach ($lista_categorias as $record) {
  echo $record->categoria_id;
  echo $record->nombre;
  echo $record->abreviatura;
}


?>