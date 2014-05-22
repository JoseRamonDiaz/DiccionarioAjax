<?php
    function resultadosParecidos($palabraParcial, $tipoTraduccion) {
    include '../daos/conexion.php';
    $link = mysqli_connect($host, $user, $password, $database);

    $query = "";
    if ($tipoTraduccion == "esma") {
        $query = "SELECT DISTINCT texto_espaniol FROM espaniol WHERE texto_espaniol LIKE '%$palabraParcial%'";
    } else {
        $query = "SELECT DISTINCT texto_maya FROM maya WHERE texto_maya LIKE '%$palabraParcial%'";
    }

    $result = mysqli_query($link, $query);
    $vectorRespuesta = array();

    while ($resultadoOrdenado = mysqli_fetch_array($result)) {
        $vectorRespuesta[] = $resultadoOrdenado[0];
    }
    mysqli_close($link);
    return $vectorRespuesta;
}
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
