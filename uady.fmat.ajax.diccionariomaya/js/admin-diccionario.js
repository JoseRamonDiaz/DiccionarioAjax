var sIdiomaDiccionario;
var nPagina;
var nPalabras=15;

$(function(){
	consultarPalabras(0);
	cargarPalabras();
	
    $("#admin_palabras").tabs();
	
	$("#cmb_idioma").change(function(){
		consultarPalabras(0);
	});
	
	$( "#btn_guardar" ).click( agregarEntrada );

});

function consultarEntrada(){
	sPalabra = $("#word").val();
	sIdiomaDiccionario = $("#cmb_idioma").val();
	
	datos = {palabra: sPalabra, idioma: sIdiomaDiccionario};
	$.get("../daos/diccionario/consultarEntrada.php", datos, muestraResultados);
}

function consultarPalabras(numPagina){
	nPagina = numPagina;
	sIdiomaDiccionario = $("#cmb_idioma").val();
	
	datos = {idioma: sIdiomaDiccionario, pagina: numPagina, palabras: nPalabras};
	$.get("../daos/diccionario/consultarDiccionario.php", datos, muestraResultados);
}

function muestraResultados(respuesta){
	var len;

	aRespuesta = eval(respuesta);
	
	if(aRespuesta[0]){
		aPalabras  = aRespuesta[1];

		resultado = "<tr><th>Palabra</th><th>Traducción</th><th>Categoría</th><th>&nbsp</th><th>&nbsp</th></tr>";

		if(aPalabras.length > nPalabras){
			len = nPalabras;
			if(nPagina > 0){
				$("#nav_bar").html("<a href=\"#\" onClick=\"consultarPalabras(nPagina-1);\"> &lt </a>&nbsp <a href=\"#\" onClick=\"consultarPalabras(nPagina+1);\"> &gt </a>");
			}
			else{
				$("#nav_bar").html("&nbsp <a href=\"#\" onClick=\"consultarPalabras(nPagina+1);\"> &gt </a>");
			}
		}
		else{
			len = aPalabras.length;
			if(nPagina > 0){
				$("#nav_bar").html("<a href=\"#\" onClick=\"consultarPalabras(nPagina-1);\"> &lt </a>&nbsp ");
			}
			else{
				$("#nav_bar").html("");
			}
		}
		
		for(i=0; i<len; i++){
			if(sIdiomaDiccionario == "es"){
				resultado += "<tr id=\""+aPalabras[i]['espaniol_id']+aPalabras[i]['maya_id']+"\"><td>"+aPalabras[i]['texto_espaniol']+"</td> <td>"+aPalabras[i]['texto_maya']+"</td> <td>"+aPalabras[i]['nombre']+"</td> <td><a href=\"#\" onClick=\"borrarPalabra("+aPalabras[i]['espaniol_id']+","+aPalabras[i]['maya_id']+");\"><i class=\"fa fa-times fa-fw\"></i></a></td></tr>";
			}
			else{
				resultado += "<tr id=\""+aPalabras[i]['espaniol_id']+aPalabras[i]['maya_id']+"\"><td>"+aPalabras[i]['texto_maya']+"</td> <td>"+aPalabras[i]['texto_espaniol']+"</td> <td>"+aPalabras[i]['nombre']+"</td> <td><a href=\"#\" onClick=\"borrarPalabra("+aPalabras[i]['espaniol_id']+","+aPalabras[i]['maya_id']+");\"><i class=\"fa fa-times fa-fw\"></i></a></td></tr>";
			}
		}
		
		$("#tablaDiccionario").html(resultado);
	}
	else if(aRespuesta[0]==false){
		alert("Error: "+aRespuesta[1]);
	}
	else {
		$("#tablaDiccionario").html("No se encontraron resultados");
		$("#nav_bar").html("");
	}
}

function cargarPalabras(){
	$.get("../daos/diccionario/consultarPalabras.php", {idioma:"es"}, llenarSelectEsp);
	$.get("../daos/diccionario/consultarPalabras.php", {idioma:"ma"}, llenarSelectMa);
}

function llenarSelectEsp(respuesta){
	aRespuesta = eval(respuesta);
	
	if(aRespuesta[0]){
		aPalabras = aRespuesta[1];

		$( "#sel_palabraes" ).html("<option value=\"-1\" selected>Palabra espa&ntilde;ol</option>");
	
		for(i=0; i<aPalabras.length; i++){
			$( "#sel_palabraes" ).append("<option value=\""+aPalabras[i]['espaniol_id']+"\">"+aPalabras[i]['texto_espaniol']+"</option>");
		}
	}else if(aRespuesta[0]==false){
		alert(aRespuesta[1]);
	}
}

function llenarSelectMa(respuesta){
	aRespuesta = eval(respuesta);
	
	if(aRespuesta[0]){
		aPalabras = aRespuesta[1];
		
		$( "#sel_palabrama" ).html("<option value=\"-1\" selected>Palabra maya</option>");
		
		for(i=0; i<aPalabras.length; i++){
			$( "#sel_palabrama" ).append("<option value=\""+aPalabras[i]['maya_id']+"\">"+aPalabras[i]['texto_maya']+"</option>");
		}
	}else if(aRespuesta[0]==false){
		alert(aRespuesta[1]);
	}
}

function agregarEntrada(){
	id_esp = $( "#sel_palabraes" ).val();
	id_may= $( "#sel_palabrama" ).val();
	
	$.get("../daos/diccionario/agregarEntrada.php", {id_espaniol: id_esp, id_maya: id_may}, agregado);
}

function agregado(respuesta){
	aRespuesta = eval(respuesta);
	
	if(aRespuesta[0]){
		consultarPalabras(0);
	}
	alert(aRespuesta[1]);

}

function borrarPalabra(id_esp, id_may){
	datos = {id_espaniol: id_esp, id_maya: id_may};
	$.get("../daos/diccionario/borrarEntrada.php", datos, borrado);
}

function borrado(respuesta){
	console.log(respuesta);
	aRespuesta = eval(respuesta);
	
	bBorrado = aRespuesta[0];
	id_borrada = aRespuesta[1];
	
	if(bBorrado){
		$("#"+id_borrada).remove();
		alert("La entrada ha sido borrada.");
	}
	else{
		alert(aRespuesta[1]);
	}
}