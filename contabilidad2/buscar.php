<?php
//Configuracion de la conexion a base de datos
require_once ('../conexion.php');
//consulta todos los empleados
   if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"];
	 $identidad = $_POST["identidad"];
        
	    $sql="select empresa,cedula_cliente from des_cliente where cedula_cliente like '$identidad' or empresa like '%$identidad%'";
		$result=mysql_query($sql) or die('<center>No se realizo la busqueda de la identificación!!..</center>');
		$número_filas = mysql_num_rows($result);
		if ($número_filas > 0){
		   while($row = mysql_fetch_array($result)){
			   echo strtoupper($row["empresa"]);	
			   		
	       }
		}else{
			 echo"No existen cohincidencias";
		}
      mysql_free_result($result);
	  
 
?>
