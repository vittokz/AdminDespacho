<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $descripcion=$_POST['descripcion'];
	  $fecha=$_POST['fecha'];
	  $valor=$_POST['valor'];
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
	 		//registro compra
				$sql="INSERT INTO des_gastosycompras (descripcion,valor,fecha,fechaRegistro,usuarioRegistro)VALUES ('$descripcion','$valor','$fecha','$hoy','$usuario')";
				mysql_query($sql) or die('<center>No se registro verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='35' height='32'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente!!</font></center>";
		
?>

