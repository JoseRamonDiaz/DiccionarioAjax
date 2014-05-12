<?php
    include 'conexion.php';
    $palabraParcial = $_GET["palabraParcial"];
    $tipoTraduccion = $_GET["tipoTraduccion"];
    //supuesta Query
//    $palabraParcial = "pe";
//    $tipoTraduccion = "esma";
    $link = mysqli_connect($host, $user, $password, $database);
    
    $query = "";
    if($tipoTraduccion == "esma"){
        $query = "SELECT texto_espaniol FROM espaniol WHERE texto_espaniol LIKE '%$palabraParcial%'";
    }else{
        $query = "SELECT texto_maya FROM maya WHERE texto_maya LIKE '%$palabraParcial%'";
    }
    
    $result = mysqli_query($link, $query);
    $vectorRespuesta = array();
   
    while ($resultadoOrdenado = mysqli_fetch_array($result)){
        $vectorRespuesta[] = $resultadoOrdenado[0];
    }
    //Inicio de envio
    //$arregloPalabras = ["Acuerdo", "Adaptador", "Adaptar", "Adecuar", "Ademan", "Adictivo", "Aditivo","$palabraParcial", "$tipoTraduccion"];
    echo json_encode($vectorRespuesta);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
