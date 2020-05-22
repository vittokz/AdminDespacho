<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	 
	  $nombre=$_POST['nombre'];
	  $municipio=$_POST['municipio'];
	  $idJuzgado=$_POST['idJuzgado'];
	 
      $sql="UPDATE des_juzgados SET nombre ='$nombre',ciudad='$municipio' WHERE idJuzgado like '$idJuzgado'";
				
				mysql_query($sql) or die('<center>No se modifico el juzgado verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	            echo "<center><font color='red'>Se modifico correctamente datos de juzgado!!</font></center>";
   


?>

