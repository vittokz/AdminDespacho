<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $cedula=$_POST['iden'];
	  $nom=$_POST['nombre'];
	  $ape=$_POST['ape'];
	  $tel=$_POST['tel'];
	  $cel=$_POST['cel'];
	  $dir=$_POST['dir'];
	  $email=$_POST['email'];
	  $muni=$_POST['municipio'];
	  $fechaNaci=$_POST['fecha'];
	  $tipo=$_POST['tipo'];
	  $empresa=$_POST['empresa'];
	  date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s"); 

       $sql="INSERT INTO des_cliente (tipo,cedula_cliente,empresa,nombre,  
		  apellido,municipio,telefono,celular,dir_cliente,email, fecha_naci,estado,usuario,fechaRegistro,fechaActivacion,usuarioActiva) VALUES 
		  ('$tipo','$cedula','$empresa','$nom', '$ape','$muni',  
		  '$tel','$cel','$dir','$email','$fechaNaci','Activo','$usuario','$fecha','','')";
		  mysql_query($sql) or die(mysql_error());
          echo "<center><br><br><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	      echo "<center><font color='red'>Se registro correctamente el cliente!!</font></center>";
   


?>

