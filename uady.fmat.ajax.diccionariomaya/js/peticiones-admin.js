var sIdiomaDiccionario;
var nPagina;
var nPalabras=15;

var editando;

$(function(){
	consultarPalabras(0);
    $("#admin_palabras").tabs({disabled: [ 2 ]});
	
	$( "#btn_guardar" ).click( agregarPalabra );
	
	$( "#btn_cancelarEdicion" ).click( cancelarEdicion );
	$( "#btn_guardarEdicion" ).click( guardarEdicion );
});

function setIdioma(idioma){
	sIdiomaDiccionario =idioma;
}

function consultarPalabra(){
	sPalabra = $("#word").val();
	datos = {palabra: sPalabra, idioma: sIdiomaDiccionario};
	$.get("../daos/palabras/consultarPalabra.php", datos, muestraResultados);
}

function consultarPalabras(numPagina){
	nPagina = numPagina;
	
	datos = {idioma: sIdiomaDiccionario, pagina: numPagina, palabras: nPalabras};
	$.get("../daos/palabras/consultarPalabras.php", datos, muestraResultados);
}

function muestraResultados(respuesta){
	var len;

	aRespuesta = eval(respuesta);
	
	if(aRespuesta[0]){
		aPalabras  = aRespuesta[1];
		resultado = "";
		
		if(sIdiomaDiccionario == "es"){
			resultado += "<tr><th>Palabra</th><th>Categoría</th><th>&nbsp</th><th>&nbsp</th></tr>";
		}
		else{
			resultado += "<tr><th>Palabra</th><th>Categoría</th><th>Audio</th><th>&nbsp</th><th>&nbsp</th></tr>";
		}
		
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
				resultado += "<tr id=\""+aPalabras[i]['espaniol_id']+"\"><td>"+aPalabras[i]['texto_espaniol']+"</td><td>"+aPalabras[i]['nombre']+"</td> <td><a href=\"#\" onClick=\"editarPalabra("+aPalabras[i]['espaniol_id']+");\"><i class=\"fa fa-pencil fa-fw\"></i></a></td> <td><a href=\"#\" onClick=\"borrarPalabra("+aPalabras[i]['espaniol_id']+");\"><i class=\"fa fa-times fa-fw\"></i></a></td></tr>";
			}
			else{
				resultado += "<tr id=\""+aPalabras[i]['maya_id']+"\"><td>"+aPalabras[i]['texto_maya']+"</td><td>"+aPalabras[i]['nombre']+"</td> <td>" +aPalabras[i]['nombre_audio']+ "</td> <td><a href=\"#\" onClick=\"editarPalabra("+aPalabras[i]['maya_id']+");\"><i class=\"fa fa-pencil fa-fw\"></i></a></td> <td><a href=\"#\" onClick=\"borrarPalabra("+aPalabras[i]['maya_id']+",'" +aPalabras[i]['nombre_audio']+ "');\"><i class=\"fa fa-times fa-fw\"></i></a></td></tr>";
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

function borrarPalabra(palabra_id, audio){
	datos = {id: palabra_id, idioma: sIdiomaDiccionario, nombre_audio: audio};
	$.get("../daos/palabras/borrarPalabra.php", datos, mostrarMensaje);
}

function editarPalabra(palabra_id){
	datos = {id: palabra_id, idioma: sIdiomaDiccionario};
	
	$.get("../daos/palabras/consultarPalabraID.php", datos, mostrarEdicion);
}

function mostrarEdicion(respuesta){
	aRespuesta = eval(respuesta);
			
	if(aRespuesta[0]){
		palabra = aRespuesta[1][0];
		
		id_categoria = palabra['categoria_id'];
		
		
		aOptions = $("#form_editar #cmb_categoria option");
		cmb = $("#form_editar #cmb_categoria");
		
		for(i=0; i<aOptions.length; i++){
			if(aOptions[i].value == id_categoria){
				cmb[0].selectedIndex = i;
			}
		}
		
		if(sIdiomaDiccionario == "es"){
			$("#form_editar #palabra").val(palabra['texto_espaniol']);
			$("#form_editar #id_palabra").val(palabra['espaniol_id']);
		}
		else{
			audio = palabra['nombre_audio'];
		
			$("#form_editar #palabra").val(palabra['texto_maya']);
			$("#form_editar #id_palabra").val(palabra['maya_id']);
			$("#form_editar #audio").val(audio);
		}
		
		$("#admin_palabras").tabs( "option", "disabled", [0,1]);
		$("#admin_palabras").tabs( "option", "active", 2);
		
		editando = palabra;
	}
	else{
		alert(aRespuesta[1]);
	}
}

function agregarPalabra(){
	fd = new FormData( document.forms["form_agregar"] );
	
	$.ajax( {
		url: "../daos/palabras/agregarPalabra.php",
		type: "POST",
		data: fd,
		processData: false,
		contentType: false,
		success: function(data, stat, obj){
			aRespuesta = eval(data);
			
			if(aRespuesta[0]){
				consultarPalabras(0);
			}

			alert(aRespuesta[1]);
		}
	} );
}

function mostrarMensaje(respuesta){
	console.log(respuesta);
	aRespuesta = eval(respuesta);
	
	bBorrado = aRespuesta[0];
	id_borrada = aRespuesta[1];
	
	if(bBorrado){
		$("#"+id_borrada).remove();
		alert("La palabra con id = "+id_borrada+" ha sido borrada.");
	}
	else{
		alert(aRespuesta[1]);
	}
}

function cancelarEdicion(){
	$("#admin_palabras").tabs( "option", "disabled", [2]);
	$("#admin_palabras").tabs( "option", "active", 0);
	editando = null;
}

function guardarEdicion(){
	fd = new FormData( document.forms["form_editar"] );
	
	$.ajax( {
		url: "../daos/palabras/editarPalabra.php",
		type: "POST",
		data: fd,
		processData: false,
		contentType: false,
		success: function(data, stat, obj){
			console.log(data);
			aRespuesta = eval(data);
			
			if(aRespuesta[0]){
				consultarPalabras(0);
				cancelarEdicion();
			}

			alert(aRespuesta[1]);
		}
	} );
}