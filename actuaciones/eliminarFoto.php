<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idFoto=$_GET['idFoto'];
	  $idProceso=$_GET['idProceso'];
	  $idActuacion=$_GET['idActuacion'];
	  date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d H:i:s");  
		        $sql="DELETE FROM des_fotosactuacion where idFoto like '$idFoto'";
				mysql_query($sql) or die('<center>No se elimino archivo !!..</center>');
				echo "<script language='javascript'> 
					alert('Se elimino archivo correctamente...!!');
					location.href='subirFoto.php?idProceso=$idProceso&idActuacion=$idActuacion' </script>";
?>

