<?php
    

    $palabraATraducir = $_GET["palabraATraducir"];
    $tipoTraduccion = $_GET["tipoTraduccion"];
    //Aqui iria la query
    $respuesta[] = obtenerRespuesta($palabraATraducir, $tipoTraduccion);
//    $respuesta[] = "Palabra: ".$palabraATraducir."<br>Tipo de traduccion: ".$tipoTraduccion;
    $resultadosParecidos = ["resultado1", "resulatdo2", "resultado3"];
    $respuesta[] = $resultadosParecidos;
    echo json_encode($respuesta);
    
    function obtenerRespuesta($palabraATraducir, $tipoTraduccion){
        include 'conexion.php';
        $link = mysqli_connect($host, $user, $password, $database);
        $query = "";
        if($tipoTraduccion == "esma")
            $query = "SELECT texto_maya FROM maya WHERE maya_id = (SELECT maya_id FROM espaniol_maya WHERE espaniol_id = (SELECT espaniol_id FROM espaniol WHERE texto_espaniol = '$palabraATraducir'))";
        else
            $query = "SELECT texto_espaniol FROM espaniol WHERE espaniol_id = (SELECT espaniol_id FROM espaniol_maya WHERE maya_id = (SELECT maya_id FROM maya WHERE texto_maya = '$palabraATraducir'))";
        $result = mysqli_query($link, $query);
        $ids;
        while($resultado = mysqli_fetch_array($result)){
            $respuesta = "<h2>".$palabraATraducir."</h2>";
            //echo $respuesta;
            $respuesta .= "<p>Traducción: ".$resultado[0]."</p>";
            //echo $respuesta;
            //$ids[] = $resultado["texto_maya"];
        }
        
        return $respuesta;
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
