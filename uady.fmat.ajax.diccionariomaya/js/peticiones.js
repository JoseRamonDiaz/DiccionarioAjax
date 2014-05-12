/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    var btn_buscar = $("#buscar");
    btn_buscar.click(pideTraducciones);
    
   $("#word").autocomplete({
    minLength: 2,
    source: palabraIncompleta,
    select: pideTraducciones
});
});

function palabraIncompleta(request,response){
    var elementoBusqueda = request.term;
    var idioma = getIdioma();
    var datos = {palabraParcial: elementoBusqueda, tipoTraduccion: idioma};
    $.get("testPhp/autocompleta.php", datos, function(respuesta){
        response(eval(respuesta));
    });
}

function pideTraducciones(event, ui){
    $("#word").autocomplete("close");
    var palabra = ui.item.value;
    var idioma = getIdioma();
    var datos = {palabraATraducir: palabra, tipoTraduccion: idioma};
    $.get("testPhp/traduce.php", datos, muestraRespuesta);
}

function pideTraducciones(){
    $("#word").autocomplete("close");
    var palabra = $("#word").val();
    var idioma = getIdioma();
    var datos = {palabraATraducir: palabra, tipoTraduccion: idioma};
    $.get("testPhp/traduce.php", datos, muestraRespuesta);
}

function muestraRespuesta(respuesta){
    var respuestaConvertida = eval(respuesta);
    muestraTraducciones(respuestaConvertida[0]);
    muestraResultadosParecidos(eval(respuestaConvertida[1]));
}

function muestraTraducciones(traducciones){
    $("#traducciones").html(traducciones);
}

function muestraResultadosParecidos(resultadosParecidos){
    var divResultadosParecidos = $("#resultadosParecidos");
    divResultadosParecidos.html("");
    for(var i = 0; i < resultadosParecidos.length; i++){
        divResultadosParecidos.append("<p>"+resultadosParecidos[i]+"</p><br>");
    }
}

//Funciones privadas no las vean :D 
function getIdioma(){
    return $("#fSelect").val();
}