<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idArchivo=$_GET['idArchivo'];
	  $identidad=$_GET['identidad'];
	  $idProceso=$_GET['idProceso'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d H:i:s");  
	  
	  //$sql="DELETE FROM des_audiosvideos where id like '$idArchivo'";
	  $sql = "update des_audiosvideos set estado = 'Eliminado' where id like '$idArchivo'";
	  mysql_query($sql) or die('<center>No se elimino archivo!!..</center>');
	  echo "<script language='javascript'> 
	  alert('Se elimino archivo correctamente...!!');
	  location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";
	 
?>

