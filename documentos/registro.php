<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
    require_once ('../conexion.php');
	  if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"];
	  $identidad=$_POST['identidad'];
	  $fecha=$_POST['fecha'];
	  
	  $carpeta ="Documentos/"."proceso".$identidad."/";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
		$nomImagen=basename($_FILES['archivo']['name']);
		$fichero_subido = $dir_subida.basename($_FILES['archivo']['name']);
	    date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d g:i a"); 
	   if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) { 
	          $sql="insert into des_documentos(identidad,nombre,fecha,usuarioRegistra,fechaRegistro) values ('$identidad','$nomImagen','$fecha','$usuario','$hoy')";
        	  mysql_query($sql);
		     
			  
		  		echo "<script> alert('Se cargo correctamente el archivo.'); </script>";
			    echo "<script language='javascript'> 
				location.href='subirContrato.php?iden=$identidad' </script>";	 
		 
   
	   }

?>

