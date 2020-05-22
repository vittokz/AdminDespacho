<?php require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
 require_once ('../conexion.php');
//variables POST
if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
  $idEmpleado=$_GET['idEmpleado'];
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
   $sqlP="SELECT * FROM des_asignacion_procesos WHERE idEmpleado like '$idEmpleado'";
      $resul=mysql_query($sqlP) or die ("No hay datos");			
	  $registros = mysql_num_rows($resul);			
	  if($registros > 0){
		   echo "<script language='javascript'> 
	     alert('No se puede eliminar Empleado, tiene procesos asignados!!');
	     location.href='empleado.php' </script>";
	  }
  else{
  //elimino cliente
  $sqlC="UPDATE des_empleado SET estado='Eliminado',fechaElimino='$hoy', usuarioElimino='$usuario' WHERE id_empleado like '$idEmpleado' ";
  mysql_query($sqlC) or die("No se elimino Cliente");
  echo "<script language='javascript'> 
			alert('El empleado se elimino correctamente!!');
			location.href='empleado.php' </script>";
  }
?>