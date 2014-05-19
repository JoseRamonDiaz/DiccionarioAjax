<?php
	include 'conexion.php';
	
	$id = $_GET['id'];
	$idioma = $_GET['idioma'];
	

    $link = mysqli_connect($host, $user, $password, $database);
	
	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}
	$query="";
	
	if ($idioma == "es") {
		$query = "SELECT categoria_id, espaniol_id, texto_espaniol FROM espaniol WHERE espaniol_id = $id";
    }
	else{
		$query = "SELECT categoria_id, maya_id, texto_maya, nombre_audio FROM maya WHERE maya_id = $id";
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