<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $identidad=$_POST['identidad'];
	  $idProceso=$_POST['idProceso'];
	  $idRadicado=$_POST['radicado'];


			    $sql="UPDATE des_procesos SET estado='Cerrado' WHERE idProceso like '$idProceso'";
		    	mysql_query($sql) or die('<center>No se modifico el proceso verifique!!..</center>');
		    	
		    	$sqlA="UPDATE des_asignacion_procesos SET estado='Cerrado' WHERE idProceso like '$idProceso'";
		    	mysql_query($sqlA) or die('<center>No se modifico el proceso en Asignacion Procesos!!..</center>');
		    	
				echo "<center><img  src='../img/correcto.png' width='30' height='30'></center><br>"; 
				echo "<center><font color='red'>Se cerro correctamente el proceso!!</font></center>";
?>