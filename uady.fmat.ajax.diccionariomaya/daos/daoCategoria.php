<?php
include 'conexion.php';
require_once '../modelos/categoria.php';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $password);

/**
* Guardar una nueva categoria
*
* @return Categoria $categoria si la transacción de guardar fue exitosa
* @return boolean false si falló el sistema al guardar la categoría
* @param string $nombre nombre de la nueva categoria
* @param string $abreviatura abreviatura del nombre de la nueva categoria
*/
function guardarCategoria($nombre, $abreviatura) {

  try{

    $categoria = Model::factory('Categoria')->create();
    $categoria->nombre = $nombre;
    $categoria->abreviatura = $abreviatura;

    $categoria->save();

    return $categoria;

  } catch (Exception $e) {
    
    return false;
  }

}


/**
* Actualizar una categoria
*
* @return objeto $categoria si la transacción fue exitosa
* @return boolean false si falló el sistema al guardar la categoría
* @param Categoria $categoria categoria que será actualizada
*/
function actualizarCategoria($categoria) {

  try{

    $categoria->save();

    return $categoria;

  } catch (Exception $e) {
    
    return false;
  }

}

/**
* Eliminar una categoria
*
* @return boolean true si la transacción fue exitosa
* @return boolean false si falló el sistema al eliminar la categoría
* @param Categoria $categoria categoria que será eliminada de la base de datos
*/
function eliminarCategoria($categoria) {

  try{

    $categoria->delete();

    return true;

  } catch (Exception $e) {
    
    return false;
  }

}

/**
* Obtener una categoria por ID
*
* @return Categoria $categoria si se halló la categoría
* @return boolean false si falló el sistema en la transacción
* @param int $id_categoria ID de la categoria que se desea obtener
*/
function obtenerCategoriaPorId($id_categoria) {

  try{

    $categoria = Model::factory('Categoria')->find_one($id_categoria);
    
    if ($categoria !=false)
      return $categoria;
    else 
      return false;

  } catch (Exception $e) {
    
    return false;
  }

}

function obtenerTodasCategorias (){

  $categorias = Model::factory('Categoria')->find_many();

  return $categorias;
}

?>