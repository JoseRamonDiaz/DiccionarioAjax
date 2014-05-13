var sIdiomaDiccionario;
var nPagina;
var nPalabras=15;

function setIdioma(idioma){
	sIdiomaDiccionario =idioma;
}

function consultarPalabra(sPalabra){
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
	
	aPalabras  = eval(respuesta);
	resultado = "<tr><th>Palabra</th><th>Categoría</th><th>&nbsp</th></tr>";
	
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
		resultado += "<tr id=\""+aPalabras[i][2]+"\"><td>"+aPalabras[i][0]+"</td><td>"+aPalabras[i][1]+"</td><td><a href=\"#\" onClick=\"borrarPalabra("+aPalabras[i][2]+");\">Eliminar</a></td></tr>";
	}
	
	$("#tablaDiccionario").html(resultado);
}

function borrarPalabra(palabra_id){
	datos = {id: palabra_id, idioma: sIdiomaDiccionario};
	console.log(datos);
	$.get("../daos/palabras/borrarPalabra.php", datos, mostrarMensaje);
}

function mostrarMensaje(respuesta){
	aRespuesta = eval(respuesta);
	
	bBorrado = aRespuesta[0];
	id_borrada = aRespuesta[1];
	
	if(bBorrado){
		$("#"+id_borrada).remove();
		alert("La palabra con id = "+id_borrada+" ha sido borrada.");
	}
	else{
		alert("Error: "+aRespuesta[1]);
	}
}