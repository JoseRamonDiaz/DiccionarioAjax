<?php
    include 'funciones.php';
    $palabraATraducir = $_GET["palabraATraducir"];
    $tipoTraduccion = $_GET["tipoTraduccion"];
    //Aqui iria la query
//    $palabraATraducir = "perro";
//    $tipoTraduccion = "esma";
    
    $respuesta[] = obtenerRespuesta($palabraATraducir, $tipoTraduccion);
//    $respuesta[] = "Palabra: ".$palabraATraducir."<br>Tipo de traduccion: ".$tipoTraduccion;
    /*
     * Esto puede fallar si la palabra tiene menos de 3 letras por eso el operador ternario
     */
    $longitudPalabra = strlen($palabraATraducir);
    $resultadosParecidos = resultadosParecidos(substr($palabraATraducir, 0,$longitudPalabra < 2 ? $longitudPalabra: 2), $tipoTraduccion);//["resultado1", "resulatdo2", "resultado3"];
    $respuesta[] = $resultadosParecidos;
    echo json_encode($respuesta);
    
    function obtenerRespuesta($palabraATraducir, $tipoTraduccion){
        include 'conexion.php';
        $link = mysqli_connect($host, $user, $password, $database);
        $query = "";
        if($tipoTraduccion == "esma")
            $query = "SELECT texto_maya,abreviatura,nombre_audio FROM categoria INNER JOIN(SELECT texto_maya,categoria_id,nombre_audio FROM maya WHERE maya_id IN (SELECT maya_id FROM espaniol_maya WHERE espaniol_id IN (SELECT espaniol_id FROM espaniol WHERE texto_espaniol = '$palabraATraducir'))) AS b ON categoria.categoria_id = b.categoria_id";
        else
            $query = "SELECT texto_espaniol,abreviatura FROM categoria INNER JOIN(SELECT texto_espaniol,categoria_id FROM espaniol WHERE espaniol_id IN (SELECT espaniol_id FROM espaniol_maya WHERE maya_id IN (SELECT maya_id FROM maya WHERE texto_maya = '$palabraATraducir'))) AS b ON categoria.categoria_id = b.categoria_id";
        $result = mysqli_query($link, $query);
        
        //Incrementa el contador de la BD
        //Falta el caso en que los contadores no sean iguales para el mismo texto_espaniol
        if($result){
            $queryIncremento = "";
            if($tipoTraduccion == "esma")
                $queryIncremento = "UPDATE espaniol SET num_consultas = num_consultas + 1 WHERE texto_espaniol = '$palabraATraducir'";
            else
                $queryIncremento = "UPDATE maya SET num_consultas = num_consultas + 1 WHERE texto_maya = '$palabraATraducir'";
            mysqli_query($link, $queryIncremento);
        }
        $ids;
        $respuesta = "<h2>".$palabraATraducir."</h2>";
            //echo $respuesta;
        $respuesta .= "<h3>Traducción</h3>";
        $rutaAudio = "";
        while($resultado = mysqli_fetch_array($result)){
            $respuesta .= "<p>".$resultado[1].". ".$resultado[0]."</p>";
            if($tipoTraduccion == "esma")
                $rutaAudio = $resultado[2];
            //echo $respuesta;
            //$ids[] = $resultado["texto_maya"];
        }
        //Aqui se agregaria el audio
        if($tipoTraduccion == "esma"){
            $respuesta .= "<audio controls='controls'><source src='$rutaAudio' type='audio/mpeg'>Tu navegador no permite reproducir el audio</audio>";
            
        }
        mysqli_close($link);
        return $respuesta;
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
