<?php require_once("../seguridad/seguridad.php");
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
   if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
  //variables POST
	  $idActuacion=$_POST['ocultoIdActuacion'];
	  $idProceso=$_POST['oculto'];
	 
	  date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d g:i a"); 

      $carpeta ="img/"."actuaciones".$idActuacion."/";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
		$nomImagen=basename($_FILES['archivo']['name']);
		$fichero_subido = $dir_subida.basename($_FILES['archivo']['name']);
		
		
		if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) { 
			  //registra datos de usuario
			  $sql="INSERT INTO des_fotosactuacion(idActuacion,idProceso,nombre,fechaRegistro,usuarioRegistra) VALUES
			  ('$idActuacion','$idProceso','$nomImagen','$hoy','$usuario')";
			  mysql_query($sql) or die("<center><font color='red'>Error en la información registrada..</font></center>
			   <br><br><center><img title='Advertencia!!!' src='../img/adver.jpg' height='50' width='50'></center>
			  ");
			   echo "<script> alert('Se almacenó correctamente el archivo.'); </script>";
			   echo "<script language='javascript'> 
				location.href='subirFoto.php?idProceso=$idProceso&idActuacion=$idActuacion' </script>";
		  
		}
		 else {
		          echo "<script> alert('No se alamacenó el archivo.'); </script>";
			      echo "<script> location.href='subirFoto.php?idProceso=$idProceso&idActuacion=$idActuacion' </script>";
          }
?>

