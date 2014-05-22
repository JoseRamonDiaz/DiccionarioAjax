function provideFeedback(errores){
    for(var i = 0; i < errores.length; i++){
        $("#"+errores[i]).addClass("errorClass");
        $("#"+errores[i] + "Error").removeClass("errorFeedback")
    }
    document.getElementById("errorDiv").innerHTML = "<p>Se han encontrado algunos errores</p>";
}

function provideFeedbackEdicion(errores){
    for(var i = 0; i < errores.length; i++){
        $("#"+errores[i]).addClass("errorClass");
        $("#"+errores[i] + "Error").removeClass("errorFeedback")
    }
    //document.getElementById("errorDiv").innerHTML = "<p>Se han encontrado algunos errores</p>";
    var errorDivEdicion = $("[id=errorDiv]")[1];
    errorDivEdicion.innerHTML = "<p>Se han encontrado algunos errores</p>";
}

function removeFeedback(){
    document.getElementById("errorDiv").innerHTML = "";
    var entradas = document.getElementsByTagName("input");
    var entradasSelect = document.getElementsByTagName("select");
    var entradasTextArea = document.getElementsByTagName("textarea");
    
    for(var i = 0; i < entradas.length; i++){
        var clase = entradas[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradas[i].removeAttribute("class");
        }
    }
    
    for(var i = 0; i < entradasSelect.length; i++){
        var clase = entradasSelect[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradasSelect[i].removeAttribute("class");
        }
    }

    for(var i = 0; i < entradasTextArea.length; i++){
        var clase = entradasTextArea[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradasTextArea[i].removeAttribute("class");
        }
    }

    var spans = document.getElementsByTagName("span");
    for(var i = 0; i < spans.length; i++){
        var clase = spans[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorSpan") > -1){
            spans[i].setAttribute("class", "errorFeedback errorSpan");
        }
    }
}

function removeFeedbackEdicion(){
    var errorDivEdicion = $("[id=errorDiv]")[1];
    errorDivEdicion.innerHTML = "";
    var entradas = document.getElementsByTagName("input");
    var entradasSelect = document.getElementsByTagName("select");
    var entradasTextArea = document.getElementsByTagName("textarea");
    
    for(var i = 0; i < entradas.length; i++){
        var clase = entradas[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradas[i].removeAttribute("class");
        }
    }
    
    for(var i = 0; i < entradasSelect.length; i++){
        var clase = entradasSelect[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradasSelect[i].removeAttribute("class");
        }
    }

    for(var i = 0; i < entradasTextArea.length; i++){
        var clase = entradasTextArea[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorClass") > -1){
            entradasTextArea[i].removeAttribute("class");
        }
    }

    var spans = document.getElementsByTagName("span");
    for(var i = 0; i < spans.length; i++){
        var clase = spans[i].getAttribute("class");
        if(clase != null && clase.indexOf("errorSpan") > -1){
            spans[i].setAttribute("class", "errorFeedback errorSpan");
        }
    }
}

function palabraValida(palabra){
    return !isEmpty(palabra);
}
function nombreValido(nombre){
	var vacio = isEmpty(nombre);
	var contieneNumero = hasNumber(nombre);
	return !vacio && !contieneNumero;
}

function abreviaturaValida(abreviatura){
    return !isEmpty(abreviatura);
}

function hasNumber(cadena){
	return /\d/i.test(cadena);
}

function isEmpty(cadena){
	return cadena == "";
}