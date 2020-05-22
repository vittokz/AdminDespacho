<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $tipo=$_POST['tipo'];
	  $fecha=$_POST['fecha'];
	  $idProceso=$_POST['oculto'];
	  $identidad=$_POST['oculto2'];
	  
	  $carpeta ="archivos/"."audiencia".$idProceso."/";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
		$nomImagen=basename($_FILES['archivoA']['name']);
		$fichero_subido = $dir_subida.basename($_FILES['archivoA']['name']);
	   
	    date_default_timezone_set('America/Bogota');
    	$hoy = date("Y-m-d H:i:s");  
	
	            
				$sql="INSERT INTO des_audiosvideos (idProceso,fecha,tipo,nombreArchivo,usuarioRegistra,fechaRegistro)
				VALUES ('$idProceso','$fecha','$tipo','$nomImagen','$usuario','$hoy')";
				mysql_query($sql) or die('<center>No se registro archivo en la base de datos!!..</center>');
				 echo "<script> alert('Se almaceno correctamente el archivo..'); </script>";
	   			 echo "<script> location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";
				 move_uploaded_file($_FILES['archivoA']['tmp_name'],$fichero_subido);


		