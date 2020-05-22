<?php
 require_once('../seguridad/seguridad.php'); 
  require_once('../conexion.php'); 
	if(!isset($_SESSION)) { session_start(); } 
 	 $usuario = $_SESSION["usuario"];
     
   $idEmpleado=$_POST["idEmpleado"];
   $carpeta ="imgLogos/".$idEmpleado."/";

   if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
    }
	 
	$dir_subida = $carpeta;
	$nomImagen=basename($_FILES['imagen']['name']);
	$fichero_subido = $dir_subida.basename($_FILES['imagen']['name']);
  
	if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
		 $sql="UPDATE des_empleado SET logo ='$nomImagen' WHERE cedula_empleado like '$idEmpleado'";
		
		 $res=mysql_query($sql);
		 echo "<script> alert('Se subio correctamente la imagen.'); </script>";
		 echo "<script> location.href='perfil.php' </script>";	
		
	
	} else {
		echo "¡No subio la imagen verifique!!\n";
	}


?>