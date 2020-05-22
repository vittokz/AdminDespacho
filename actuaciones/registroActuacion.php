<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $fecha=$_POST['fecha'];
	  $idProceso=$_POST['idProceso'];
	  $actuacion=$_POST['actuacion'];
	  $tipo=$_POST['tipo'];
	  $fechaAuto=$_POST['fechaAuto'];
	  date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d H:i:s");  
		        $sql="INSERT INTO des_actuaciones (idProceso,fecha,tipo,actuacion,fechaAuto,usuarioRegistra,fechaRegistro)
				VALUES ('$idProceso','$fecha','$tipo','$actuacion','$fechaAuto','$usuario','$hoy')";
				mysql_query($sql) or die('<center>No se registro el proceso verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='70' height='68'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente actuación!!</font></center>";
?>

