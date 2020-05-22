<?php require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
 require_once ('../conexion.php');
//variables POST
  $identidad=$_GET['identidad'];
  
   $sqlP="SELECT * FROM des_procesos WHERE idCliente like '$identidad'";
      $resul=mysql_query($sqlP) or die ("No hay datos");			
	  $registros = mysql_num_rows($resul);			
	  if($registros > 0){
		   echo "<script language='javascript'> 
	  alert('No se puede eliminar cliente, tiene procesos asignados!!');
	  location.href='clientes.php' </script>";
	  }
  else{
  //elimino cliente
  $sqlC="DELETE FROM des_cliente WHERE cedula_cliente like '$identidad' ";
  mysql_query($sqlC) or die("No se elimino Cliente");
  echo "<script language='javascript'> 
			alert('El cliente se elimino correctamente!!');
			location.href='clientes.php' </script>";
  }
?>