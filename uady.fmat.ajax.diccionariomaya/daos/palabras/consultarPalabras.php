<?php
	include 'conexion.php';
		
	$idioma = $_GET['idioma'];
	$numPalabras = $_GET['palabras'];
	$pagina = $_GET['pagina'];
	
	$inicio = $pagina * $numPalabras;
	$fin = $numPalabras + 1;
	

    $link = mysqli_connect($host, $user, $password, $database);

    $query = "";
    if ($idioma == "es") {
        $query = "SELECT texto_espaniol, nombre, espaniol_id FROM espaniol JOIN categoria ON categoria.categoria_id = espaniol.categoria_id ORDER BY texto_espaniol LIMIT $inicio, $fin";
    } else {
        $query = "SELECT texto_maya, nombre, maya_id FROM maya JOIN categoria ON categoria.categoria_id = maya.categoria_id ORDER BY texto_maya LIMIT $inicio, $fin";
    }

	$vectorRespuesta = array();
    if($result = mysqli_query($link, $query)){
		
		$i = 0;
		
		while ($resultado = mysqli_fetch_array($result)) {
			$vectorRespuesta[$i++] = $resultado;
		}
	}
	
    mysqli_close($link);
    echo json_encode($vectorRespuesta);
?>