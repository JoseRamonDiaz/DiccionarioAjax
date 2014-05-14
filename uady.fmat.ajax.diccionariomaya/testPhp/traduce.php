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
            $query = "SELECT texto_maya,abreviatura FROM categoria INNER JOIN(SELECT texto_maya,categoria_id FROM maya WHERE maya_id IN (SELECT maya_id FROM espaniol_maya WHERE espaniol_id = (SELECT espaniol_id FROM espaniol WHERE texto_espaniol = '$palabraATraducir'))) AS b ON categoria.categoria_id = b.categoria_id";
        else
            $query = "SELECT texto_espaniol,abreviatura FROM categoria INNER JOIN(SELECT texto_espaniol,categoria_id FROM espaniol WHERE espaniol_id IN (SELECT espaniol_id FROM espaniol_maya WHERE maya_id = (SELECT maya_id FROM maya WHERE texto_maya = '$palabraATraducir'))) AS b ON categoria.categoria_id = b.categoria_id";
        $result = mysqli_query($link, $query);
        $ids;
        $respuesta = "<h2>".$palabraATraducir."</h2>";
            //echo $respuesta;
        $respuesta .= "<h3>Traducción</h3>";
        
        while($resultado = mysqli_fetch_array($result)){
            $respuesta .= "<p>".$resultado[1].". ".$resultado[0]."</p>";
            //echo $respuesta;
            //$ids[] = $resultado["texto_maya"];
        }
        mysqli_close($link);
        return $respuesta;
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
