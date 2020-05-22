<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

	  
			$empresa=$_POST['empresa'];
			$email=$_POST['email'];
			$ccCliente=$_POST['ccCliente'];
			$idLiquida=$_POST['idLiquida'];
			
			$sql="UPDATE des_liquidar_contratos set estadoEnvio='Enviada' where idLiquida like '$idLiquida'";
			echo $sql;
			$resSql=mysql_query($sql);
			$to = $email;
        	$from = 'asesoria@viacpro.com';
			$fromName = 'VIGILANCIA DE ACTUACIONES PROCESALES-VIACPRO';
			$subject = "VIACPRO-'Vigilancia de Actuaciones Procesales le ha enviado comprobante electronico'";
			$file="pdfFacturas/".$ccCliente."/".$idLiquida;
			$reply_to_email="vittorio15@hotmail.com";
            //header for sender info
			$headers = "From: $fromName"." <".$from.">";

			$boundary = md5("viacpro");

			//headers for attachment 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From:".$from_email."\r\n"; 
			$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
			//$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
			
			//para el envío en formato HTML 
			$message ='
			<div align="Justify">
			Estimado(a) '.$empresa.', ha recibido un DOCUMENTO ELECTR&oacute;NICO por parte de VIGILANCIA DE ACTUACIONES PROCESALES;
			env&iacute;o que se efect&uacute;a mediante los sistemas de Facturaci&oacute;n Electr&oacute;nica.<br>

			Adjuntos al correo se encuentran los siguientes documentos:<br>
			+ Representaci&oacute;n gr&aacute;fica del comprobante con extensi&oacute;n .PDF<br>
			+ Anexos (Esta informaci&oacute;n es responsabilidad exclusiva del contribuyente emisor.<br><br>
			
			Solicitamos que por favor revise el documento electr&oacute;nico.
			Este E-mail ha sido enviado autom&aacute;ticamente por favor no responder a esta cuenta, de requerir cualquier
			aclaratoria o informaci&oacute;n adicional debe comunicarse directamente las direcciones de email o tel&eacute;fono 
			de: VIGILANCIA DE ACTUACIONES PROCESALES.<br><br>
			
						
			La informaci&oacute;n contenida en este E-mail es confidencial y solo puede ser utilizada por la persona o la 
			empresa a la cual est&aacute; dirigido y/o por el emisor. Si por error recibe este mensaje, favor reenviarlo y
			borrar el mensaje recibido inmediatamente.</div><br><br> '; 

			$message .= "<center><img src='https://www.viacpro.com/AdminDespacho/img/viacproSolo.png' width='20%'></center>";
	
			//Enviar el mail
			$sentMail = @mail($to, $subject, $message, $headers);

			if($sentMail) //Muestro mensajes segun se envio con exito o si fallo
				{       
					echo"
						<h2>Gracias por tu contacto</h2>
						<div>Tu mensaje fu&amp;eacute; enviado con &amp;eacute;xito.</div>
					";
				}else{
					echo "
						<h2>Se produjo un error y su pedido no pudo ser enviado</h2>
					";
				}
	  ?>
						            

