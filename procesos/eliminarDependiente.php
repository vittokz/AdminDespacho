<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $identidad=$_GET['idAsignacion'];
	  $idAsignacion=$_GET['idAsignacion'];
	  $idProceso=$_GET['idProceso'];
	  //$sql="DELETE FROM des_procesos where idProceso like '$idProceso'";
	  $sql = "delete from des_asignacion_procesos where idAsignacion like '$idAsignacion'";
	  mysql_query($sql) or die('<center>No se borro dependiente!!..</center>');
	  echo "<script language='javascript'> 
	  alert('Se borro Dependiente del proceso correctamente...!!');
	 location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";
	 
?>

