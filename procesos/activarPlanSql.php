<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $id=$_POST['id'];
	  $fechaActivacion=$_POST['fechaActivacion'];


	  date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d H:i:s");
		        //registro asignacion proceso
$sql2="UPDATE des_contratos_empresas set fecha='$fechaActivacion',activoFecha='Si' where id like '$id'";
				
				
mysql_query($sql2) or die('<center>No se activo Plan!!..</center>');
echo "<center><img  src='../img/correcto.png' width='30' height='30'></center>"; 
echo "<center><font color='red'>Se activo correctamente el plan!!</font></center>";



?>

