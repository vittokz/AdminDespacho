<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $nom=$_POST['nombre'];
	  $muni=$_POST['municipio'];
      date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d H:i:s");
		        $sql="INSERT INTO des_juzgados (nombre,ciudad,usuario,fechaRegistro,estado)
				VALUES ('$nom','$muni','$usuario','$hoy','Activo')";
				mysql_query($sql) or die(mysql_error());
				echo "<center><br><br><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente juzgado!!</font></center>";
	            
	            
   


?>

