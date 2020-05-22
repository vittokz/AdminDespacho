<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   	require_once ('../conexion.php');
	 	if(!isset($_SESSION)) { session_start(); } 
			$usuario = $_SESSION["usuario"]; 
			$idCot=$_POST['idCot'];
			$estado=$_POST['estado'];
		
					date_default_timezone_set('America/Bogota');
					$hoy = date("Y-m-d H:i:s");
					//registro asignacion proceso
					$sql2="UPDATE des_cotizacion set estado='$estado' where idC like '$idCot'";
					mysql_query($sql2) or die('<center>No se cambio el estado!!..</center>');
					echo "<center><img  src='../img/correcto.png' width='30' height='30'></center>"; 
					echo "<center><font color='red'>Se cambio estado correctamente!!</font></center>";
?>

