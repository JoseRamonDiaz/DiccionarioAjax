<?php
	include 'conexion.php';
	
	$espaniol_id = $_GET['id_espaniol'];
	$maya_id = $_GET['id_maya'];

    $link = mysqli_connect($host, $user, $password, $database);
	
	if (mysqli_connect_errno()) {
		$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
		die( json_encode( array( false, $msg)));
	}

    $query = "DELETE FROM espaniol_maya WHERE espaniol_id = $espaniol_id AND maya_id = $maya_id";
	
	if(!($result = mysqli_query($link, $query))){
		$msg = "Error en la consulta a la BD: ". mysqli_error($link);
		mysqli_close($link);
		die( json_encode( array( false, $msg)));
	}

	mysqli_close($link);

	echo json_encode( array( true, "$espaniol_id"."$maya_id") );
?>