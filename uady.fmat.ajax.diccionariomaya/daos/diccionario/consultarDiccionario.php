<?php
	include '../conexion.php';

	$idioma = $_GET['idioma'];
	$numPalabras = $_GET['palabras'];
	$pagina = $_GET['pagina'];
	
	$inicio = $pagina * $numPalabras;
	$fin = $numPalabras + 1;
	
	$orderby = "texto_maya";

    $link = mysqli_connect($host, $user, $password, $database);

	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}
	
	if ($idioma == "es") {    
		$orderby = "texto_espaniol";
	}
	
	$query = "SELECT nombre, espaniol.espaniol_id, texto_espaniol, maya.maya_id, texto_maya FROM espaniol JOIN categoria ON (categoria.categoria_id = espaniol.categoria_id) JOIN espaniol_maya ON ( espaniol.espaniol_id = espaniol_maya.espaniol_id ) JOIN maya ON ( maya.maya_id = espaniol_maya.maya_id ) ORDER BY $orderby LIMIT $inicio, $fin";
	
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