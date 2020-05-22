<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $identidad=$_POST['identidad'];
	  $idProceso=$_POST['idProceso'];
	  $idJuzgado=$_POST['idJuzgado'];
	  $radicado=$_POST['radicado'];
	  $tipo=$_POST['tipo'];
	  $demandante=$_POST['demandante'];
	  $demandado=$_POST['demandado'];
	  $fechaProceso=$_POST['fechaProceso'];
	  $email=$_POST['email'];
	  $tiempo=$_POST['tiempo'];
	  $valor=$_POST['valor'];
	  $iva=$_POST['iva'];
	  $resultado = 0;
	  $resulIva=0;
	   if($iva=="Si"){
		 $resulIva = ($valor*19)/100;
		 $resultado = $valor -$resulIva;
	   }
	   else{
         $resulIva = 0;
		 $resultado = $valor;

	   }
	   $total= $resulIva + $resultado;
	  $nomJuzgado="";
					   $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado'");
					   while($rowC=mysql_fetch_array($sqlJuzgado)) {
							$nomJuzgado = $rowC["nombre"];
						}
	  
                date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				
				$fecha_actual = date("Y-m-d");
				//sumo 6 mes
				$fechaTerminacion= date("Y-m-d",strtotime($fecha_actual."+ 6 month")); 

				//registro el proceso
				$sql="INSERT INTO des_procesos (idRadicado,idCliente,tiempo,valor,iva,total,idJuzgado,idTipoProceso,demandado,demandante,idPlan,fechaRegistro,usuarioRegistra,fechaProceso,fechaTerminacion,estado)VALUES ('$radicado','$identidad','$tiempo','$resultado','$resulIva','$total','$idJuzgado','$tipo','$demandado','$demandante','0','$hoy','$usuario','$fechaProceso','$fechaTerminacion','Activo')";
			 	mysql_query($sql) or die('<center>No se registro el proceso verifique!!..</center>'.mysql_error());
				echo "<center><br><br><img  src='../img/correcto.png' width='45' height='42'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente el proceso!!</font></center>";
	           
				/*
                $sqlR="select idProceso from des_procesos where idRadicado like '$radicado'";
				$resul=mysql_query($sqlR) or die('<center>No se consulto radicado!!..</center>');
			       while($row=mysql_fetch_array($resul)){
                        $idProceso = $row["idProceso"];
				   }

				//registro en contable iva y valores
				/*
				$sqlC="INSERT INTO des_valor_procesos (idProceso,idDependiente,iva,valor,total,usuarioRegistro,fechaRegistro)
				VALUES ('$idProceso','','$resulIva','$resultado','$total','$usuario','$hoy')";		
	            mysql_query($sqlC) or die('<center>No se registro contablemente!!..</center>');
		        */
			
				//envio el correo electronico al cliente informando la actuacion
									$asunto = "Informe de registro de Proceso VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
									//para el env铆o en formato HTML 
									$headers = "MIME-Version: 1.0\r\n"; 
									$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									
									//direcci贸n del remitente 

								$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
									$headers .="<H2>Informacion de Proceso registrado:</H2>";
									$headers .= '
									<br><table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
											<th>Radicado</th>
											<th>Juzgado</th>
											<th>Demandado</th>
											<th>Demandante</th>
											<th>Fecha</th>
									
										</tr>
										</thead> 
										<tbody>
										    <td>'.$radicado.'</td>
										    <td>'.strtoupper($nomJuzgado).'</td>
										    <td>'.$demandado.'</td>
										    <td>'.$demandante.'</td>
    									    <td>'.$fechaProceso.'</td>
    								       
										</tbody>
									<tfoot>
									<tr style="background:#003A75; color:#FFF">
									       <th>Radicado</th>
										   <th>Juzgado</th>
										   <th>Demandado</th>
										   <th>Demandante</th>
										   <th>Fecha</th>
									
									</tr>
									</tfoot>
									</table>
								'; 
									$headers .= "<BR>Puede acceder a revisar la informacion :<br> 
									<a href='https://www.viacpro.com/AdminClientes'>www.viacpro.com/AdminClientes</a><br>
									<img src='../img/viacpro.png' width='20%'>
									";
									
									mail($email,$asunto,$cuerpo,$headers) ;
								//----fin---       

?>

