/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   $("#word").autocomplete({
    minLength: 2,
    source: palabraIncompleta
});
});

function palabraIncompleta(request,response){
    console.log(request.term);
    $.get("testPhp/autocompleta.php", "palabraParcial="+request.term, function(respuesta){
        response(eval(respuesta));
    });
}






