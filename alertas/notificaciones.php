<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	
	  $usuario = $_SESSION["usuario"]; 
	  date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d");	

	  $sql=mysql_query("SELECT * FROM des_cliente where estado like 'Activo'");
			while($row = mysql_fetch_array($sql))
			    {
		
						 $email = $row["email"];
						 $emailUsuarios=$emailUsuarios.$email.",";
						
		                 //envio el correo electronico al cliente informando la actuacion
										$asunto = "Informativo -- 'Vigilancia de Actuaciones Procesales'"; 
										//para el envío en formato HTML 
									
										$headers = "MIME-Version: 1.0\r\n"; 
										$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
										$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
										
										$message = '<html><body>';
										$message .= '<a href="https://www.viacpro.com/AdminClientes"><img src="https://www.viacpro.com/AdminDespacho/img/email.jpg"></a>';
										$message .= '</body></html>';
										
								
								

			}
			$emailUsuarios = $emailUsuarios."vittorio15@hotmail.com";
			mail($emailUsuarios,$asunto,$message,$headers);
				
			               
		
?>



