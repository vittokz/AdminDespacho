<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	
	  $usuario = $_SESSION["usuario"]; 
	  date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d");	
	  $fecha = date('Y-m-d');
	  $nuevafecha = strtotime ( '-5 day' , strtotime ( $fecha ) ) ;
	  $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	  $cuerpo = "";
	  $sqlCliente=mysql_query("SELECT * FROM des_cliente order by id_cliente DESC");	
	  while($rowCliente=mysql_fetch_array($sqlCliente)) {
		$email="";
		$cedula = $rowCliente["cedula_cliente"];
		$email =$rowCliente["email"];
		
			$sqlProceso="SELECT * FROM des_procesos WHERE idCliente like '$cedula'";
			$resulPro=mysql_query($sqlProceso);
			while($rowProceso=mysql_fetch_array($resulPro)) {
					$idProceso = $rowProceso["idProceso"];
					$idRadicado = $rowProceso["idRadicado"];
					$idJuzgado = $rowProceso["idJuzgado"];
					$demandado = $rowProceso["demandado"];
					$demandante = $rowProceso["demandante"];
					$fechaProceso = $rowProceso["fechaProceso"];
					$estadoProceso = $rowProceso["estado"];
					$sql="SELECT * FROM des_actuaciones where idProceso like '$idProceso' and fechaFin between $nuevafecha and $hoy";
					
					$resul=mysql_query($sql) or die ("No hay datos");
					$num=mysql_num_rows($resul);
					echo $sql."-".$num."<br>";
					while($row = mysql_fetch_array($resul)){
						$headers="";
						$idCliente=$row['idCliente'];
						$actuacion=$row['actuacion'];
						$fechaAuto=$row['fechaAuto'];
						$fechaInicio=$row['fechaInicio'];
						$fechaFin=$row['fechaFin'];
						echo "<br>".$fechaFin;
                         //envio el correo electronico al cliente informando la actuacion
									$asunto = "Alerta de Vencimiento-- 'Vigilancia de Actuaciones Procesales'"; 
									//para el envío en formato HTML 
									$headers = "MIME-Version: 1.0\r\n"; 
									$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									
									//dirección del remitente 

								    $headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
									$headers .="<H2>Informacion</H2><br>";
									$headers .= 'N. Radicado:'.$idRadicado.'<br>Demandado :'.$demandado.' - Demandante: '.$demandante.'<BR>
									<br><table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
											<th>Descripcion</th>
											<th>Fecha Auto</th>
											<th>Fecha Inicio</th>
											<th>Fecha Final</th>
											<th>Juzgado</th>
											</tr>
										</thead> 
											<tbody>
													<td>'.strtoupper($actuacion).'</td>
													<td>'.$fechaAuto.'</td>
													<td>'.$fechaInicio.'</td>
													<td>'.$fechaFin.'</td>
													<td>'.strtoupper($nomJuzgado).'</td>
											</tbody>
									<tfoot>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
										    <th>Descripcion</th>
											<th>Fecha Auto</th>
											<th>Fecha Inicio</th>
											<th>Fecha Final</th>
											<th>Juzgado</th>
										</tr>
									</tfoot>
									</table>
								'; 
									$headers .= "<BR>Puede acceder a revisar la informacion :<br> 
									<a href='https://www.viacpro.com/AdminClientes'>www.viacpro.com/AdminClientes</a><br>
									<img src='../img/viacpro.png' width='20%'>
									";
									/*$sqlEmail=mysql_query("SELECT distinct correo FROM des_envio_correos WHERE identidad like '$identidad'");
									while($rowEmail=mysql_fetch_array($sqlEmail)) {
										   $emailUsuarios = $emailUsuarios.','.$rowEmail["correo"];
											   
									   }
									 $long = strlen($emailUsuarios);
									
									 $emailUsuarios=substr($emailUsuarios,0,($long-1));
									 $emailUsuarios=$emailUsuarios.",".$email;*/
									 //mail($emailUsuarios,$asunto,$cuerpo,$headers) ;
									 //----fin---
									 echo "<br>".$email;
					}
					mysql_free_result($resul);
	  }
	  mysql_free_result($resulPro);
	}
	mysql_free_result($sqlCliente);
								
							
						//	echo "<script> alert('Se almacenó correctamente la actuación.'); </script>";
			               
		
?>



