<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $identidad=$_GET['identidad'];
	  $idPlan=$_GET['idPlan'];
	  $des=$_GET['descripcion'];
	  $idContrato=$_GET['idContrato'];
	  $idProceso=$_GET['idProceso'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d H:i:s");  
	
	  $sqlF="SELECT * FROM des_actuaciones where idProceso like '$idProceso' and estado like 'Activo'";
      $resul=mysql_query($sqlF) or die ("No hay datos");			
	  $registros = mysql_num_rows($resul);			
	  if($registros > 0){
		   echo "<script language='javascript'> 
	  alert('No se puede eliminar proceso, tiene registrado actuaciones!!');
	  location.href='procesosRegistro.php?identidad=$identidad' </script>";
	  }
	  else{
	  //$sql="DELETE FROM des_procesos where idProceso like '$idProceso'";
	  $sql = "update des_procesos set estado='Eliminado' where idProceso like '$idProceso'";
	  mysql_query($sql) or die('<center>No se elimino proceso!!..</center>');
	  echo "<script language='javascript'> 
	  alert('Se elimino proceso correctamente...!!');
	 location.href='planSeleccionado.php?idPlan=$idPlan&descripcion=$des&identidad=$identidad&idContrato=$idContrato' </script>";
	  }
?>

