<?php
	function subirAudio($archivo_audio, $maya_id){
		
		if(isset($archivo_audio) && !$archivo_audio['error']){
			$archivos_permitidos = array("audio/mpeg","audio/mp3");
			$limite_kb = 1024;
	  
			if (in_array($archivo_audio['type'], $archivos_permitidos) && $archivo_audio['size'] <= $limite_kb * 1024){
				$ruta = "../../audio/";

				if ( !file_exists($ruta.$archivo_audio['name']) ){
				
					$resultado = @move_uploaded_file( $archivo_audio["tmp_name"], $ruta.$archivo_audio['name']);
					
					if ($resultado){
						$conexion = obtener_conexion();
						$query = "UPDATE maya SET nombre_audio = '".$ruta.$archivo_audio['name']."' WHERE maya_id = $maya_id";
				
						if(!($result = mysqli_query($conexion, $query))){
							$msg = "Error en la consulta: " . mysqli_error($conexion);
							mysqli_close($conexion);
							die( json_encode( array( false, $msg)));
						}
						
						mysqli_close($conexion);
					}
					else{
						$sStatus = "Error al guardar audio: El archivo no puede ser movido.";
						die( json_encode( array( false, $sStatus)));
					}
				} else {
					$sStatus = "Error al guardar audio: Ya existe un archivo con este nombre ( ".$archivo_audio['name']." ).";
					die( json_encode( array( false, $sStatus)));
				}
			} else {
				$sStatus = "Error al guardar audio: Solo se permiten archivos tipo mp3 menores a 1 MB.";
				die( json_encode( array( false, $sStatus)));
			}
		}
	}
	
	function insertarPalabraEspaniol($palabra_espaniol, $id_categoria){
		$id_palabra = 0;
		
		$conexion = obtener_conexion();
		
		$query = "INSERT INTO espaniol (texto_espaniol, categoria_id) VALUES ( '$palabra_espaniol', $id_categoria)";
			
		if($result = mysqli_query($conexion, $query)){
			$id_palabra = mysqli_insert_id($conexion);
			
			if($id_palabra <= 0){
				$msg = "Error en la consulta: No se pudo obtener el id autogenerado.";
				mysqli_close($conexion);
				die( json_encode( array( false, $msg)));
			}
		}
		else{
			$msg = "Error en la consulta: " . mysqli_error($conexion);
			mysqli_close($conexion);
			die( json_encode( array( false, $msg)));
		}
		
		mysqli_close($conexion);
		
		return $id_palabra;
	}
	
	function insertarPalabraMaya($palabra_maya, $id_categoria){
		$id_palabra = 0;
		
		$conexion = obtener_conexion();
		
		$query = "INSERT INTO maya (texto_maya, categoria_id) VALUES ( '$palabra_maya', $id_categoria)";
			
		if($result = mysqli_query($conexion, $query)){
			$id_palabra = mysqli_insert_id($conexion);
			
			if($id_palabra <= 0){
				$msg = "Error en la consulta: No se pudo obtener el id autogenerado.";
				mysqli_close($conexion);
				die( json_encode( array( false, $msg)));
			}
		}
		else{
			$msg = "Error en la consulta: " . mysqli_error($conexion);
			mysqli_close($conexion);
			die( json_encode( array( false, $msg)));
		}
		
		mysqli_close($conexion);
		return $id_palabra;
	}
	
	function existePalabraEspaniol($palabra_espaniol, $id_categoria){
		$id_palabra = 0;

		$conexion = obtener_conexion();
		
		$query = "SELECT espaniol_id FROM espaniol WHERE texto_espaniol = '$palabra_espaniol' AND categoria_id = $id_categoria";
		
		if($result = mysqli_query($conexion, $query)){
		
			if($registro = mysqli_fetch_assoc($result)){
				$id_palabra = $registro['espaniol_id'];
			}
		}
		else{
			$msg = "Error en la consulta: " . mysqli_error($conexion);
			mysqli_close($conexion);
			die( json_encode( array( false, $msg)));
		}
		
		mysqli_close($conexion);
		return $id_palabra;
	}
	
	function existePalabraMaya($palabra_maya, $id_categoria){
		$id_palabra = 0;

		$conexion = obtener_conexion();
		
		$query = "SELECT maya_id FROM maya WHERE texto_maya = '$palabra_maya' AND categoria_id = $id_categoria";
		
		if($result = mysqli_query($conexion, $query)){
		
			if($registro = mysqli_fetch_assoc($result)){
				$id_palabra = $registro['maya_id'];
			}
		}
		else{
			$msg = "Error en la consulta: " . mysqli_error($conexion);
			mysqli_close($conexion);
			die( json_encode( array( false, $msg)));
		}
		
		mysqli_close($conexion);
		return $id_palabra;
	}
	
	function obtener_conexion(){
		include 'conexion.php';
		// Conectar a la BD.
		$link = mysqli_connect($host, $user, $password, $database);
	
		// Verificar conexion
		if (mysqli_connect_errno()) {
			$msg = "Error en la conexión a la BD: ". mysqli_connect_error();
			die( json_encode( array( false, $msg)));
		}
		
		return	$link;
	}
	
	
	$id_categoria = $_POST['cmb_categoria'];
	$idioma = $_POST['txt_idioma'];
	
	if($idioma == "es"){
		$palabra_espaniol = $_POST['palabraes'];
		
		$id_espaniol = existePalabraEspaniol($palabra_espaniol, $id_categoria);
		
		if($id_espaniol <= 0){
			$id_espaniol = insertarPalabraEspaniol($palabra_espaniol, $id_categoria);
		}
		else{
			die( json_encode( array( false, "La palabra ya existe.") ));
		}
	}
	else{
		$palabra_maya = $_POST['palabrama'];
		$archivo_audio = $_FILES['f_audio'];
		
		$id_maya = existePalabraMaya($palabra_maya, $id_categoria);
	
		if($id_maya <= 0){
			$id_maya = insertarPalabraMaya($palabra_maya, $id_categoria);
			subirAudio($archivo_audio,$id_maya);
		}
		else{
			die( json_encode( array( false, "La palabra ya existe.") ));
		}
	}

	echo json_encode( array( true, "Se ha agregado la palabra al diccionario.") );
?>