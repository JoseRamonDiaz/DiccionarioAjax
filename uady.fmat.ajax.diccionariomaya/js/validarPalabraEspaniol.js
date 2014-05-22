function validarForm(){
    var errores = new Array();
    var palabra = $("#palabraes").val();
    
    removeFeedback();
    
    if(!palabraValida(palabra))
        errores.push("palabraes");
        
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
    
    removeFeedback();
    
    if(!palabraValida(palabra))
        errores.push("palabra");
        
    var isValid = errores=="";
    if(isValid){
        return true;
    }
    else{
        provideFeedback(errores);
        return false;
    }
}