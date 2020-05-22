<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idEmpleado=$_POST['idEmpleado'];
	  $servicio=$_POST['servicio'];
	  $fecha=$_POST['fecha'];
	  $municipio=$_POST['municipio'];
	  $juzgado=$_POST['juzgado'];

	date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d H:i:s");
	//registro asignacion servicio
	$sql2="INSERT INTO des_asignacion_servicios
	(idServicio,idJuzgado,municipio,idEmpleado,fechaAsignacion,estado,usuarioRegistra,fechaRegistro)
	VALUES ('$servicio','$juzgado','$municipio','$idEmpleado','$fecha','Activo','$usuario','$hoy')";
					
					
	mysql_query($sql2) or die('<center>No se asigno servicio-verifique!!..</center>');
	echo "<center><img  src='../img/correcto.png' width='30' height='30'></center>"; 
	echo "<center><font color='red'>Se asigno correctamente el servicio!!</font></center>";



?>

