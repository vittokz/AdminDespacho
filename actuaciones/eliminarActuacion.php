<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idActuacion=$_GET['idActuacion'];
	  $identidad=$_GET['identidad'];
	  $idProceso=$_GET['idProceso'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d H:i:s");  
	
	  $sqlF="SELECT * FROM des_fotosactuacion where idActuacion like '$idActuacion'";
      $resul=mysql_query($sqlF) or die ("No hay datos");			
	  $registros = mysql_num_rows($resul);			
	  if($registros > 0){
		   echo "<script language='javascript'> 
	  alert('No se puede eliminar actuación, tiene archivos adjuntos!!');
	  location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";
	  }
	  else{
	  $sql="DELETE FROM des_actuaciones where idActuacion like '$idActuacion'";
	  mysql_query($sql) or die('<center>No se elimino actuación!!..</center>');
	  echo "<script language='javascript'> 
	  alert('Se elimino actuación correctamente...!!');
	  location.href='procesoSeleccionado.php?identidad=$identidad&idProceso=$idProceso' </script>";
	  }
?>

