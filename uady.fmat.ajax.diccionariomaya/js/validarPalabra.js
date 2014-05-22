function validarForm(){
    var errores = new Array();
    var palabra = $("#palabra1").val();
    
    removeFeedback();
    
    if(!palabraValida(palabra))
        errores.push("palabra1");
        
    var isValid = errores=="";
    if(isValid){
        return true;
    }
    else{
        provideFeedback(errores);
        return false;
    }
}

function validarEdicion(){
     var errores = new Array();
    var palabra = $("#palabra").val();
    
    removeFeedbackEdicion();
    
    if(!palabraValida(palabra))
        errores.push("palabra");
        
    var isValid = errores=="";
    if(isValid){
        return true;
    }
    else{
        provideFeedbackEdicion(errores);
        return false;
    }
}