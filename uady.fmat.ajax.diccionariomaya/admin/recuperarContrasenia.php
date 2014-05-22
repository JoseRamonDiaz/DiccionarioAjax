 <?php
    //include('acceso_db.php'); // incluímos los datos de acceso a la BD
    require_once '../daos/daoAdministrador.php';
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos del formulario
        if(empty($_POST['email'])) {
            echo "No ha ingresado su correo electrónico. <a href='javascript:history.back();'>Reintentar</a>";
        }else {
            $email = mysql_real_escape_string($_POST['email']);
            $email = trim($email);
            $id = findByEmail($email);
            if($id != false) {
                $num_caracteres = "8"; // asignamos el número de caracteres que va a tener la nueva contraseña
                $nueva_clave = substr(md5(rand()),0,$num_caracteres); // generamos una nueva contraseña de forma aleatoria
                //$usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario
                //$usuario_clave2 = md5($usuario_clave); // encriptamos la nueva contraseña para guardarla en la BD
                // actualizamos los datos (contraseña) del usuario que solicitó su contraseña
                $exito = editarContrasenia($id, $nueva_clave);
                
                if ($exito){
                    // Enviamos por email la nueva contraseña
                    $remite_nombre = "Administrador Web";
                    $remite_email = "nombre@dominio"; // Sustituir por un e-mail válido
                    $asunto = "Recuperación de contraseña"; // Asunto (se puede cambiar)
                    $mensaje = "Ha solicitado una nueva contraseña. La nueva contraseña es: <strong>".$nueva_clave."</strong>.";
                    $cabeceras = "From: ".$remite_nombre." <".$remite_email.">\r\n";
                    $cabeceras = $cabeceras."Mime-Version: 1.0\n";
                    $cabeceras = $cabeceras."Content-Type: text/html";
                    $enviar_email = mail($email,$asunto,$mensaje,$cabeceras);
                    echo $enviar_email;
                    if($enviar_email) {
                        echo "La nueva contraseña ha sido enviada al email ".$email.".";
                    }else {
                        echo "No se ha podido enviar el email. <a href='javascript:history.back();'>Reintentar</a>";
                    }
                } else {
                    
                    echo "Ocurrió un error.";
                }
            }else {
                echo "El usuario con e-mail<strong>".$email."</strong> no está registrado. <a href='javascript:history.back();'>Reintentar</a>";
            }
        }
    }else {
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Email:</label><br />
        <input type="text" name="email" /><br />
        <input type="submit" name="enviar" value="Enviar" />
    </form>
<?php
    }
?> 