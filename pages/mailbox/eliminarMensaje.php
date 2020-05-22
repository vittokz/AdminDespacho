<?php //require_once("../seguridad/seguridad.php");?>

<?php
//Configuracion de la conexion a base de datos

   require_once ('../../conexion.php');
   $conexion = Conectarse();
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

      if(isset($_POST['idEmail'])){
		$idEmail=$_POST['idEmail'];
	  }
	  
	  if(isset($_GET['idEmail'])){
		$idEmail=$_GET['idEmail'];
	  }

						$sql="delete from des_email where idEmail like '$idEmail'";
						mysql_query($sql) or die(mysql_error());
						echo "<script language='javascript'> 
							alert('Se Elimino mensaje correctamente!!');
							location.href='enviados.php' </script>";
	  
?>



