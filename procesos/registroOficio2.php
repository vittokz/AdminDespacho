<?php //require_once("../seguridad/seguridad.php");?>

<?php
	 require_once ('../conexion.php');

	if(!isset($_SESSION)) { session_start(); } 
		$usuario = $_SESSION["usuario"]; 
	 
	  $email=$_POST['email'];	
	  $fecha=$_POST['fecha'];
	  $fechaFin=$_POST['fechaFin'];
	  $idProceso=$_POST['idProceso'];
	  $identidad=$_POST['identidad'];
	  $cel=$_POST['cel'];
	  $descripcion=$_POST['descripcion'];
	  $cuerpo = "";
	  date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d"); 
      $sqlProceso=mysql_query("SELECT * FROM des_procesos WHERE idProceso like '$idProceso'");
	  		 while($rowProceso=mysql_fetch_array($sqlProceso)) {
					$idRadicado = $rowProceso["idRadicado"];
					$demandado = $rowProceso["demandado"];
					$demandante = $rowProceso["demandante"];
					$idJuzgado = $rowProceso["idJuzgado"];
			           $nomJuzgado="";
					   $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado'");
					   while($rowC=mysql_fetch_array($sqlJuzgado)) {
							$nomJuzgado = $rowC["nombre"];
						}
					$demandado = $rowProceso["demandado"];
					$demandante = $rowProceso["demandante"];
			 }
			 mysql_query($sqlProceso);
	  $sql="INSERT INTO des_oficios(idProceso,idCliente,fecha,fechaFin,nombreArchivo,descripcion,usuarioRegistra,fechaRegistro,estado) 
	  VALUES('$idProceso','$identidad','$fecha','$fechaFin','sin archivo','$descripcion','$usuario','$hoy','Activo')";
      mysql_query($sql) or die("No se registro oficio");
	 
	  echo '<br>
								 <a title="Enviar a WhathApp" 
								 href="https://api.whatsapp.com/send?phone=57'.$cel.'&text=Actualizacion de estado Proceso radicado N.  '.$idRadicado.' Demandado : '.$demandado.' - Demandante: '.$demandante.' Verifique en su Perfil: www.viacpro.com/AdminClientes --Mensaje de VIACPRO- Vigilancia de Actuaciones Procesales."  target="_blank" rel="noopener">
								 <img src="../img/wasap.jpg" width="15%">Enviar a WhatsApp</a>
								 ';
	  								
						
								//envio el correo electronico al cliente informando la actuacion
									$asunto = "Informe de registro de Oficio-Archivo VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
									//para el envío en formato HTML 
									$headers = "MIME-Version: 1.0\r\n"; 
									$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
									$mensaje ='<a href="https://www.viacpro.com/AdminClientes"><img src="https://www.viacpro.com/AdminDespacho/img/viacpro2.png" width="100%"></a><br>'; 
									
								    $mensaje .="<H2>Informacion de la Notificacion:</H2>";
									$mensaje .= '
									<br><table width=700px id="example1" class="table table-bordered table-striped">
										<thead>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
											<th>Fecha</th>
											<th>Fecha Vencimiento</th>
											<th>Descripcion</th>
										
										</tr>
										</thead> 
										<tbody>
											   <td>'.$fecha.'</td>
											   <td>'.$fechaFin.'</td>
											<td>'.strtoupper($descripcion).'</td>
										</tbody>
									<tfoot>
									<tr style="background:#003A75; color:#FFF">
										<th>Fecha</th>
										<th>Fecha Vencimiento</th>
										<th>Descripcion</th>
								    </tr>
									</tfoot>
									</table>
								'; 
								$mensaje .= "<BR>Puede acceder a revisar la informacion :<br> 
									<a href='https://www.viacpro.com/AdminClientes'>www.viacpro.com/AdminClientes</a><br>
									<img src='../img/viacpro.png' width='20%'>
									";
								$mensaje .='<a href="https://www.viacpro.com/AdminClientes"><img src="https://www.viacpro.com/AdminDespacho/img/pieEmail.jpg" width="100%"></a><br>';
							$sqlEmail=mysql_query("SELECT distinct correo FROM des_envio_correos WHERE identidad like '$identidad'");
							 while($rowEmail=mysql_fetch_array($sqlEmail)) {
									$emailUsuarios = $emailUsuarios.','.$rowEmail["correo"];
										
								}
							  $long = strlen($emailUsuarios);
							 
							  $emailUsuarios=substr($emailUsuarios,0,($long-1));
							  $emailUsuarios=$emailUsuarios.",".$email;
							  mail($emailUsuarios,$asunto,$mensaje,$headers) ;
							   //----fin---
							
			
				
?>



