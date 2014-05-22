<?php
	header("Content-Type: text/html; charset=UTF-8");
        include '../conexion.php';

	$id_espaniol = $_GET['id_espaniol'];
	$id_maya = $_GET['id_maya'];
	
	$link = mysqli_connect($host, $user, $password, $database);

	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}

	$query = "INSERT INTO espaniol_maya (espaniol_id, maya_id) VALUES ( $id_espaniol, $id_maya )";
	
	if(!$result = mysqli_query($link, $query)){
		$msg = "Error en la BD: ". mysqli_error($link);
		mysqli_close($link);
		die( json_encode( array( false, $msg)));
	}
	
	echo json_encode( array( true, "Se ha agregado la entrada al diccionario.") );
?>