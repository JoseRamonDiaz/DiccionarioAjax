<?php
    $palabraParcial = $_GET["palabraParcial"];
    $tipoTraduccion = $_GET["tipoTraduccion"];
    //supuesta Query
    $arregloPalabras = ["Acuerdo", "Adaptador", "Adaptar", "Adecuar", "Ademan", "Adictivo", "Aditivo","$palabraParcial", "$tipoTraduccion"];
    echo json_encode($arregloPalabras);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
