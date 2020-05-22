<?php
 require_once('../seguridad/seguridad.php'); 
  require_once('../conexion.php'); 
	if(!isset($_SESSION)) { session_start(); } 
 	 $usuario = $_SESSION["usuario"];
     
   $nomNoticia=$_POST["nombre"];
   $desNoticia=$_POST["descripcion"];

   $carpeta ="noticias/";

   if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
    }
	 
	$dir_subida = $carpeta;
	$nomImagen=basename($_FILES['archivo']['name']);
	$fichero_subido = $dir_subida.basename($_FILES['archivo']['name']);
  
	date_default_timezone_set('America/Bogota');
	$fecha = date("Y-m-d H:i:s"); 
	if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
		 $sql="insert into des_noticias(nombre,nombreArchivo,descripcion,estado,fechaRegistro,usuarioRegistro)
		 VALUES('$nomNoticia','$nomImagen','$desNoticia','Activo','$fecha','$usuario')";
		
		 $res=mysql_query($sql);
		 echo "<script> alert('Se subio correctamente la noticia.'); </script>";
		 echo "<script> location.href='noticias.php' </script>";	
		
	
	} else {
		echo "¡No subio archivo verifique!!\n";
	}


?>