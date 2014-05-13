<?php
	include 'conexion.php';
	
	$palabra = $_GET['palabra'];
	$idioma = $_GET['idioma'];

    $link = mysqli_connect($host, $user, $password, $database);

    $query = "";
    if ($idioma == "es") {
        $query = "SELECT texto_espaniol, nombre, espaniol_id FROM espaniol WHERE texto_espaniol = '$palabra' JOIN categoria ON categoria.categoria_id = espaniol.categoria_id";
    } else {
        $query = "SELECT texto_maya, nombre, maya_id FROM maya WHERE texto_maya = '$palabra' JOIN categoria ON categoria.categoria_id = espaniol.categoria_id";
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