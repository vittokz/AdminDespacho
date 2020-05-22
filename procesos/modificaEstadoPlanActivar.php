<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $id=$_GET['id'];
	  $identidad=$_GET['identidad'];
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
	 		//registro compra
				$sql="UPDATE des_contratos_empresas set estado ='Activo' where id like '$id'";
				mysql_query($sql) or die('<center>No se Activo plan verifique con el administrador!!..</center>');
				echo "<script language='javascript'> 
					alert('Se Activo plan correctamente!!');
					 location.href='planes.php?identidad=$identidad' </script>";
		
?>

