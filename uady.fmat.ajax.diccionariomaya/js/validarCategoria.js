function validarForm(){
    var errores = new Array();
    var nombre = $("#nombre_input").val();
    var abreviatura = document.getElementById("abreviatura").value;
    
    removeFeedback();
    
    if(!nombreValido(nombre))
        errores.push("nombre_input");
    if(!abreviaturaValida(abreviatura))
        errores.push("abreviatura");
        
    var isValid = errores=="";
    if(isValid){
        return true;
    }
    else{
        provideFeedback(errores);
        return false;
    }
}