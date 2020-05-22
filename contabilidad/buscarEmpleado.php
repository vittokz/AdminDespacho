<?php
//Configuracion de la conexion a base de datos
require_once ('../conexion.php');
//consulta todos los empleados
   if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"];
	 $identidad = $_POST["identidad"];
	 $fechaInicial = $_POST["fechaInicial"];
	 $fechaFinal = $_POST["fechaFinal"];

	    $sql="select id_empleado,nombre,apellido from des_empleado where cedula_empleado like '$identidad'";
		$result=mysql_query($sql) or die('<center>No se realizo la busqueda de la identificación empleado!!..</center>');
		$número_filas = mysql_num_rows($result);
		if ($número_filas > 0){
		   while($row = mysql_fetch_array($result)){
			     $idEmpleado=$row["id_empleado"];
			     $nombre=$row["nombre"]." ".$row["apellido"];
			     $registros=0;
			     $sqlP="select idProceso from des_asignacion_procesos where idEmpleado like '$idEmpleado' and estado like 'Activo'";
			     $resultP=mysql_query($sqlP) or die('<center>No se realizo la busqueda de la identificación empleado!!..</center>'); 
				 while($rowP = mysql_fetch_array($resultP)){
                   $registros++;
				 }
				 mysql_free_result($resultP);
				 echo "Empleado: ".strtoupper($row["nombre"])." Tiene : ".$registros." Procesos";			
	       }
		}else{
			 echo"Identidad incorrecta";
		}
      mysql_free_result($result);
	  
 
?>
