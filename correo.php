<?php	
class Correo{

	function __construct() { 
	
	}

	function EnviarCorreo($RutaConfig, $cantidad)
	{
		$cont = 0;
		require_once("PHPMailer_v5.1/class.phpmailer.php");
		
		$cadena_config = file_get_contents($RutaConfig); // obtenemos la cadena json 
 		$lectura =json_decode($cadena_config,true);  // decodificamos al formato json 

		$mail = new PHPMailer();
		try
		{
			$mail->IsSMTP(); //indico a la clase que use SMTP
			$mail->SMTPAuth = true; //Debo de hacer autenticación SMTP
			$mail->SMTPSecure = "ssl";
			//indico el servidor de Gmail para SMTP
			$mail->Host = $lectura['ConfMail']['email_smtp_host']; // Carga archivo
			//indico un usuario / clave de un usuario de gmail
			$mail->Username = $lectura['ConfMail']['email_smtp_user']; // Carga archivo
			$mail->Password = $lectura['ConfMail']['email_smtp_pass']; // Carga archivo
			//indico el puerto que usa Gmail
			$mail->Port = $lectura['ConfMail']['email_smtp_port']; // Carga archivo

			$mail->From = $lectura['Correo']['email_from'];//Carga archivo
			$mail->FromName = $lectura['Correo']['email_from_name'];//Carga archivo
			
			$mail->AddAddress($lectura['CorreoDestino']['email_for'], $lectura['CorreoDestino']['email_for_name']); // Esta es la dirección a donde enviamos
		
			$mail->IsHTML(true); // El correo se envía como HTML
			$mail->Subject = "Informe"; // Este es el asunto del email.
					
			date_default_timezone_set('America/Costa_Rica');
			//Imprimimos la fecha actual dandole un formato
			//Buscamos la fecha del sistema para crear el nombre del archivo .CSV
			
			$fechaHoy2 = date("d-m-Y");
			
			$body = "Proceso Finalizado <br><br>".
			"Fecha: ".$fechaHoy2." <br><br>".
			"Cantidad de estudiantes ingresados: ".$cantidad;
			
			$mail->Body = $body; //cuerpo del mensaje a enviar
			$envio = $mail->Send(); // Envía el correo.
			$mail->ClearAddresses();							
				
		} 
		catch (phpmailerException $e) 
		{
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} 
		catch (Exception $e)
		{
		  echo $e->getMessage(); //Boring error messages from anything else!
		}
		if($envio)
		{
		    echo "\nCorreo Enviado \n";
		}
		else
		{
			echo "\n \n Aqui Hubo un problema";
		}
	}
}
	
?>