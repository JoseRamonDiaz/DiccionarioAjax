 <?php
    
    session_start();
    
    header("Content-Type: text/plain");
    
    //require_once '../daos/daoAdministrador.php';
    
    if(isset($_SESSION['usuario'])) {
        session_destroy();
        header("Location: index.html");
    }else {
        echo "Operación incorrecta.";
    }
?> 
