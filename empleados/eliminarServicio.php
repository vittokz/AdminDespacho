<?php require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
 require_once ('../conexion.php');
//variables POST
if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
  $idServicio=$_GET['idServicio'];
  $idEmpleado=$_GET['idEmpleado'];
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  
  
  //elimino servicio
  $sql="delete from des_asignacion_servicios where idServicio like '$idServicio'";
  mysql_query($sql) or die("No se elimino Servicio");
  echo "<script language='javascript'> 
			alert('Servicio se elimino correctamente!!');
			location.href='empleadoDetalle.php?idEmpleado=".$idEmpleado."' </script>";
  
?>