<?php
    $palabraATraducir = $_GET["palabraATraducir"];
    $tipoTraduccion = $_GET["tipoTraduccion"];
    //Aqui iria la query
    $respuesta[] = "Palabra: ".$palabraATraducir."<br>Tipo de traduccion: ".$tipoTraduccion;
    $resultadosParecidos = ["resultado1", "resulatdo2", "resultado3"];
    $respuesta[] = $resultadosParecidos;
    echo json_encode($respuesta);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
