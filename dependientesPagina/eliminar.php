<?php require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
 require_once ('../conexion.php');
//variables POST
  $idTrabaje=$_GET['id'];
  
  $sqlC="DELETE FROM des_trabaje WHERE idTrabaje like '$idTrabaje' ";
  mysql_query($sqlC) or die("No se elimino Dependiente");
  echo "<script language='javascript'> 
  alert('Se elimino correctamente!!');
   location.href='dependientes.php' </script>";
	 
?>