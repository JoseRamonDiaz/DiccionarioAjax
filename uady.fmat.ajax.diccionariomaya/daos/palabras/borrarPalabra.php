<?php
	include 'conexion.php';
	
	$id_palabra = $_GET['id'];
	$idioma = $_GET['idioma'];

    $link = mysqli_connect($host, $user, $password, $database);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

    $query = "";
    if ($idioma == "es") {
        $query = "DELETE FROM espaniol WHERE espaniol_id = $id_palabra";
    } else {
        $query = "DELETE FROM maya WHERE maya_id = $id_palabra";
    }
	
	$respuesta = array();
	
	if($result = mysqli_query($link, $query)){
		$respuesta[0] =  $result;
		$respuesta[1] = $id_palabra;
		if(isset($_GET['nombre_audio']) && $_GET['nombre_audio'] != "null"){
			unlink($_GET['nombre_audio']);
		}
	}
	else{
		$respuesta[0] =  $result;
		$respuesta[1] = mysqli_error($link);
	}
	
	mysqli_close($link);
		
	echo json_encode($respuesta);
?>