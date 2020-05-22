<?php require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
 require_once ('../conexion.php');
//variables POST
  $idJuzgado=$_GET['idJuzgado'];
  
   $sqlJ="SELECT * FROM des_procesos WHERE idJuzgado like '$idJuzgado'";
      $resul=mysql_query($sqlJ) or die ("No hay datos");			
	  $registros = mysql_num_rows($resul);			
	  if($registros > 0){
		   echo "<script language='javascript'> 
	  alert('No se puede eliminar Juzgado, esta asignado a un proceso!!');
	  location.href='juzgados.php' </script>";
	  }
	  else{
  //elimino juzgado
  $sqlC="DELETE FROM des_juzgados WHERE idJuzgado like '$idJuzgado' ";
  mysql_query($sqlC) or die("No se elimino Juzgado");
  echo "<script language='javascript'> 
			alert('El Juzgado se elimino correctamente!!');
			 location.href='juzgados.php' </script>";
	  }
?>