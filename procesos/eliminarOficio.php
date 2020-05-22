<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $numOficio=$_GET['numOficio'];
	  $identidad=$_GET['identidad'];
	  $idProceso=$_GET['idProceso'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d H:i:s");  
	
	  //$sql="DELETE FROM des_actuaciones where idActuacion like '$idActuacion'";
	  $sql="delete from des_oficios where idOficio like '$numOficio'";
	  mysql_query($sql) or die('<center>No se elimino Registro!!..</center>');
	  echo "<script language='javascript'> 
	  alert('Se elimino correctamente...!!');
	  location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";

?>

