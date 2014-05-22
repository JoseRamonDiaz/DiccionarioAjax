<?php
	header("Content-Type: text/html; charset=UTF-8");
        include '../conexion.php';

	$idioma = $_GET['idioma'];

    $link = mysqli_connect($host, $user, $password, $database);

	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}
	
	if ($idioma == "es") {    
		$query = "SELECT num_consultas, texto_espaniol FROM espaniol WHERE num_consultas > 0 ORDER BY num_consultas DESC LIMIT 0, 10";
	}
	else{
		$query = "SELECT num_consultas, texto_maya FROM maya WHERE num_consultas > 0 ORDER BY num_consultas DESC LIMIT 0, 10";
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