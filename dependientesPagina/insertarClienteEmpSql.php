<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	 
	  $cliente=$_POST['cliente'];
	  $tel=$_POST['telefono'];
	  $email=$_POST['email'];
	  $ciudad=$_POST['ciudad'];
	  date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s"); 

       $sql="INSERT INTO des_abogados_empresas (cliente,email,telefono,ciudad,fechaRegistro,usuarioRegistrO) VALUES 
		  ('$cliente','$email','$tel','$ciudad','$fecha','$usuario')";
		  mysql_query($sql) or die(mysql_error());
          echo "<center><br><br><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	      echo "<center><font color='red'>Se registro correctamente el registro!!</font></center>";
   


?>

