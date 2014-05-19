<?php
	include '../conexion.php';

	$idioma = $_GET['idioma'];

    $link = mysqli_connect($host, $user, $password, $database);

	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}
	
	if ($idioma == "es") {    
		$query = "SELECT espaniol_id, texto_espaniol FROM espaniol ORDER BY texto_espaniol";
	}
	else{
		$query = "SELECT maya_id, texto_maya FROM maya ORDER BY texto_maya";
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