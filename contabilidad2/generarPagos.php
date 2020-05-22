<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $numComprobante=$_POST['numComprobante'];
	  $descripcion=$_POST['descripcion'];
	  $identidad=$_POST['identidad'];
	  $fechaInicial=$_POST['fechaInicial'];
	  $fechaFinal=$_POST['fechaFinal'];

	  if($descripcion=="" || $identidad=="" || $fechaInicial=="" || $fechaFinal==""){
        echo "<center><img  src='../img/adver.jpg' width='35' height='32'></center><br>"; 
	    echo "<center><font color='red'>Todos los campos son obligatorios!!</font></center>";

	  }
	  else {
		  
				date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				
				$sql="select id_empleado from des_empleado where cedula_empleado like '$identidad'";
					$result=mysql_query($sql) or die('<center>No se realizo la busqueda de la identificación empleado!!..</center>');
					
					$número_filas = mysql_num_rows($result);
					if ($número_filas > 0){
					while($row = mysql_fetch_array($result)){
						$detalle="";
							$idEmpleado=$row["id_empleado"];
							$registros=0;
							$sqlP="select idProceso from des_asignacion_procesos where idEmpleado like '$idEmpleado' and estado like 'Activo'";
							$resultP=mysql_query($sqlP) or die('<center>No se realizo la busqueda de la identificación empleado!!..</center>'); 
							$registros = mysql_num_rows($resultP);
							while($rowP = mysql_fetch_array($resultP)){
								$idProceso=$rowP["idProceso"];
									
								$sqlPr="select idRadicado from des_procesos where idProceso like '$idProceso' and estado like 'Activo'";
								
								$resultPr=mysql_query($sqlPr) or die('<center>No se realizo la busqueda de proceso!!..</center>'); 
									while($rowPr = mysql_fetch_array($resultPr)){
										$idRadicado=$rowPr["idRadicado"];
										$detalle = $detalle."-".$idRadicado;
									}
									mysql_free_result($resultPr);
							}
							mysql_free_result($resultP);
									
					}
					}else{
					echo"Identidad incorrecta";
					
					}
					if($registros>0 && $registros<=10){
						$totalPagos = $registros*6000;
						}
						if($registros>10 && $registros<=40){
						$totalPagos = "100000";
						}
						if($registros>40 && $registros<=60)
							$totalPagos = "150000";
						if($registros>60 && $registros<=100)
							$totalPagos = "200000";
						if($registros>100 && $registros<=200)
							$totalPagos = "300000";
					//registro pago
					$sql="INSERT INTO des_pagos_mensuales (numComprobante,idDependiente,fechaPagada,fechaFinal,descripcion,detalle,valor,usuarioRegistra,fechaRegistro)
					VALUES ('$numComprobante','$identidad','$fechaInicial','$fechaFinal','$descripcion','$detalle','$totalPagos','$usuario','$hoy')";
					mysql_query($sql) or die('<center>No se registro verifique!!..</center>');
					mysql_free_result($result);


				echo "<center><img  src='../img/correcto.png' width='35' height='32'></center><br>"; 
				echo "<center><font color='red'>Se registro correctamente!!</font></center>";
	}
		
?>

