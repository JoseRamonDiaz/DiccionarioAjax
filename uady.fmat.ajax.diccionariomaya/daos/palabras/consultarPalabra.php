<?php
	include '../conexion.php';
	
	$palabra = $_GET['palabra'];
	$idioma = $_GET['idioma'];
	

    $link = mysqli_connect($host, $user, $password, $database);
	
	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}
	$query="";
	$palabra = mysqli_real_escape_string ($link,$palabra);
	if ($idioma == "es") {
		$query = "SELECT nombre, espaniol_id, texto_espaniol FROM espaniol JOIN categoria ON (categoria.categoria_id = espaniol.categoria_id) WHERE texto_espaniol = '$palabra'";
    }
	else{
		$query = "SELECT nombre, maya_id, texto_maya, nombre_audio FROM maya JOIN categoria ON (categoria.categoria_id = maya.categoria_id) WHERE texto_maya = '$palabra'";
	}
	
	$vectorRespuesta = array();
	
    if($result = mysqli_query($link, $query)){
		while ($resultado = mysqli_fetch_assoc($result)) {
			$vectorRespuesta[] = $resultado;
		}
	}
	else{
		$msg = "Error en la consulta a la BD: ". mysqli_error($link);
		mysqli_close($link);
		die( json_encode( array( false, $msg)));
	}
	
    mysqli_close($link);
    echo json_encode( array( true, $vectorRespuesta) );
?>