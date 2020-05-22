<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $numComprobante=$_POST['numComprobante'];
	  $descripcion=$_POST['descripcion'];
	  $fechaInicial=$_POST['fechaInicial'];
	  $fechaFinal=$_POST['fechaFinal'];
      $primeraFecha="2019-07-01";
	  if($descripcion=="" || $fechaInicial=="" || $fechaFinal==""){
        echo "<center><img  src='../img/adver.jpg' width='35' height='32'></center><br>"; 
	    echo "<center><font color='red'>Todos los campos son obligatorios!!</font></center>";

	  }
	  else {
			date_default_timezone_set('America/Bogota');
			$hoy = date("Y-m-d H:i:s");
			$actual = date("Y-m-d");
			
			$sql="select id_empleado,cedula_empleado,nombre,apellido from des_empleado where estado like 'Activo'";
			$result=mysql_query($sql) or die('<center>No se consulto empleado!!..</center>');
			$numero_filas = mysql_num_rows($result);
			echo "<center><table border=1 style='border-collapse:separate;border-spacing:5px;'>
					<tr align='CENTER' style='font-weight:bold; background-color:#039CD2; color:#FFFFFF'>
						  <td>Nombre</td> 
					      <td>Identidad</td>
					      <td>Radicado</td>
						  <td>Fecha Proceso</td>
						  <td>Fecha Fin</td>
						  <td>Detalle</td>
						  <td>Dias Trabajados</td>
						  <td>Valor</td>
					</tr>
			";

			while($row = mysql_fetch_array($result))
			   {
				   
					$idEmpleado=$row["id_empleado"];
					$ccEmpleado=$row["cedula_empleado"];
					$nomEmpleado=$row["nombre"]." ".$row["apellido"];
					$registros=0;
					$sqlP="select idProceso from des_asignacion_procesos where idEmpleado like '$idEmpleado' and estado like 'Activo'";
					
					$resultP=mysql_query($sqlP) or die('<center>No se realizo la busqueda de la identificación empleado!!..</center>'); 
					$registros = mysql_num_rows($resultP);
					
					while($rowP = mysql_fetch_array($resultP))
					{
						$detalle="";
						$idProceso=$rowP["idProceso"];
						$sqlPr="select idRadicado,tiempo,fechaProceso,total from des_procesos where idProceso like '$idProceso' and estado like 'Activo' and fechaProceso between '$fechaInicial' and '$fechaFinal' order by fechaProceso DESC";
						$pagoMensual=0;
						$resultPr=mysql_query($sqlPr) or die('<center>No se realizo la busqueda de proceso!!..</center>'); 
							while($rowPr = mysql_fetch_array($resultPr))
							{
								$idRadicado=$rowPr["idRadicado"];
								$fechaProceso=$rowPr["fechaProceso"];
								$tiempo=$rowPr["tiempo"];
								$total=$rowPr["total"];
								$diasT	= (strtotime($fechaProceso)-strtotime($fechaFinal))/86400;
								$diasT 	= abs($diasT); 
								$dias = floor($diasT);	
								$fech = date("Y-m-d",strtotime($fechaProceso."+ ".$tiempo." month")); 
								$totalPago = (6000*$dias)/30;
								$pagoMensual = $pagoMensual + $totalPago;
								$detalle = $detalle."-Radicado:".$idRadicado."|Dias Trab: ".$diasT;
								echo"
									<tr align='RIGHT'>
										<td>".$nomEmpleado."</td>
									    <td>".$ccEmpleado."</td>								
										<td>".$idRadicado."</td>	
										<td>".$fechaProceso."</td>
										<td>".$fech."</td>
										<td>".$descripcion."</td>
										<td>".$diasT."</td>
										<td> $ ".number_format($totalPago)."</td>
						  			</tr>								
 
								";
								$sqlM="INSERT INTO des_pagos_mensuales (numComprobante,idDependiente,fechaPagada,fechaFinal,descripcion,detalle,valor,diasTrab,usuarioRegistra,fechaRegistro)
								VALUES ('$numComprobante','$ccEmpleado','$fechaInicial','$fechaFinal','$descripcion','$detalle','$totalPago','$diasT','$usuario','$hoy')";
								mysql_query($sqlM) or die('<center>No se registro verifique!!..</center>');
							}
							
					    //registro pago
					
							mysql_free_result($resultPr);
							
								
					}//fin asignacion
					
					//registro pago
					//$sql="INSERT INTO des_pagos_mensuales (numComprobante,idDependiente,fechaPagada,fechaFinal,descripcion,detalle,valor,usuarioRegistra,fechaRegistro)
					//VALUES ('$numComprobante','Pago Mensual','$fechaInicial','$fechaFinal','$descripcion','$detalle','$totalPagos','$usuario','$hoy')";
					//mysql_query($sql) or die('<center>No se registro verifique!!..</center>');
						
					mysql_free_result($resultP);
					
				}//fin empleados
				mysql_free_result($result);
				
				echo "</table></center>"	;
				echo "<center><img  src='../img/correcto.png' width='35' height='32'></center>"; 
				echo "<center><font color='red'>Se registro correctamente!!</font></center>";
				echo "<center><font color='red'><a href='imprimirNomina.php?numComprobante=".$numComprobante."&fechaInicial=".$fechaInicial."&fechaFinal=".$fechaFinal."'>IMPRIMIR</a></font></center>";
			}//fin else
			

		
	  