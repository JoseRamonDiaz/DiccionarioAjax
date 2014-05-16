<?php
    
    require_once '../daos/daoAdministrador.php';
   
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos del formulario
        if(empty($_POST['email'])) {
            echo "No ha ingresado su correo electr�nico. <a href='javascript:history.back();'>Reintentar</a>";
        }else {
            $email = mysql_real_escape_string($_POST['email']);
            $email = trim($email);
            $id = findByEmail($email);
            if($id != false) {
                $num_caracteres = "8"; // asignamos el n�mero de caracteres que va a tener la nueva contrase�a
                $nueva_clave = substr(md5(rand()),0,$num_caracteres); // generamos una nueva contrase�a de forma aleatoria
                //$usuario_clave = $nueva_clave; // la nueva contrase�a que se enviar� por correo al usuario
                //$usuario_clave2 = md5($usuario_clave); // encriptamos la nueva contrase�a para guardarla en la BD
                // actualizamos los datos (contrase�a) del usuario que solicit� su contrase�a
                $exito = editarPerdil($id, $nueva_clave);
                
                if ($exito){
                    
                    require_once('class.phpmailer.php');
	            include("class.smtp.php");
	
	            $mail = new PHPMailer();
	            $mail->IsSMTP();
	            $mail->SMTPAuth = true;
	            $mail->SMTPSecure = "tsl";
	            $mail->Host = "smtp.gmail.com";
	            $mail->Port = '587';
	
	            $mail->Username = "dicciomaya@gmail.com";
	            $mail->Password = "admin2014?";

	            $mail->setFrom("correo@correo.com", "prueba");
	            
	            $mail->AddAddress("ileanaguadalupeom@yahoo.com.mx", "Administrador");
	            $mail->AddCC("ontiveros.ig@hushmail.com","Ileana");
	
	            $mail->Subject = "Cambio de contrase�a"; 
	
	            $mensaje = "Su nueva contrase�a es ".$nueva_clave;
	
	            //if ($_POST["ckb_info"]=="on") $mensaje .= "Deseo recibir informaci�n de ofertas y productos nuevos." 
		
	            $mail->Body = $mensaje;

	            if(!$mail->Send()) {
		      //intentar el env�o varias veces
		      //Mailer Error: " . $mail->ErrorInfo;.
  		      echo "El mensaje no ha sido enviado. ";
	            } 
	            else 
	            {
  		      //generar p�gina con datos enviados
		      echo "Se ha enviado un correo electr�nico.";
		       
	             }
                    
                    
                } else {
                    
                    echo "no se edit� el perfil";
                }
            }else {
                echo "El usuario con e-mail<strong>".$email."</strong> no est� registrado. <a href='javascript:history.back();'>Reintentar</a>";
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