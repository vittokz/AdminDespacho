<?php //require_once("../seguridad/seguridad.php");?>

<?php

   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
		
	  $idServicio=$_POST['ocultoIdServicio'];
	  $idEmpleado=$_POST['ocultoIdEmpleado'];
	  $descrip=$_POST['des'];
	  $fecha=$_POST['fecha'];
	  //$hora=$_POST['hora'];
	  $cuerpo = "";
	 
	  $carpeta ="imgServicios/"."empleado".$idEmpleado."/";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		 }

		$dir_subida = $carpeta;
		
	$ftp_servidor = "viacpro.com";
    $ftp_usuario = "desarrolladorviacpro@viacpro.com";
    $ftp_pass = "Viacpro2019.";

    $con_id = ftp_connect($ftp_servidor);
    $lr = ftp_login($con_id,$ftp_usuario,$ftp_pass);
     if((!$con_id) || (!$lr)){
            echo "<center>No se pudo subir el archivo verifique con el administrador!!!</center>";
            exit;
     }
		 else
		 {
							$destino ="AdminDespacho/empleados/imgServicios/"."empleado".$idEmpleado."/";
							ftp_chdir($con_id, $destino);   
							$temp =explode(".",$_FILES["archivo"]["name"]);
							$source_file = $_FILES["archivo"]["tmp_name"];
							$nombre = $_FILES["archivo"]["name"];
							//ftp_pass($con_id,true);
							$subio=ftp_put($con_id,
							$nombre,
							$source_file,
							FTP_BINARY);
							if($subio) 
									{
									echo "Archivo cargado correctamente";
									}
							else{
									echo "Exite un error. El archivo no se subio verifique";
							}
						
							  date_default_timezone_set('America/Bogota');
								$hoy = date("Y-m-d"); 
								$horaR = date("g:i a");  
								$sql="INSERT INTO des_documentos_servicios (idEmpleado,idServicio,nomArchivo,descripcion,fecha,usuarioRegistra,fechaRegistro)
								VALUES ('$idEmpleado','$idServicio','$nombre','$descrip','$fecha','$usuario','$hoy')";
								mysql_query($sql) or die('<center>No se registro archivo!!..</center>');
								
					   	
							echo "<script> alert('Se almacenó correctamente el archivo.'); </script>";
			               
						
				}
?>



