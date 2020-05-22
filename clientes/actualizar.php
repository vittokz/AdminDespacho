<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $idCliente=$_POST['idCliente'];
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
	  $estado=$_POST['estado'];
	  date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s");
	 
      $sql="UPDATE des_cliente SET tipo='$tipo',cedula_cliente='$cedula',empresa='$empresa',nombre='$nom',  
		  apellido='$ape',municipio='$muni',telefono='$tel',celular='$cel',dir_cliente='$dir',email='$email', fecha_naci='$fechaNaci',estado='$estado' WHERE id_cliente like '$idCliente'";
				
				
				mysql_query($sql) or die('<center>No se modifico el cliente verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	            echo "<center><font color='red'>Se modifico correctamente datos del cliente!!</font></center>";
   


?>

