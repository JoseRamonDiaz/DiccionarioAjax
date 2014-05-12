<?php
include 'funciones.php';
$palabraParcial = $_GET["palabraParcial"];
$tipoTraduccion = $_GET["tipoTraduccion"];
//supuesta Query
//    $palabraParcial = "pe";
//    $tipoTraduccion = "esma";
$vectorRespuesta = resultadosParecidos($palabraParcial, $tipoTraduccion);
//Inicio de envio
//$arregloPalabras = ["Acuerdo", "Adaptador", "Adaptar", "Adecuar", "Ademan", "Adictivo", "Aditivo","$palabraParcial", "$tipoTraduccion"];
echo json_encode($vectorRespuesta);

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
