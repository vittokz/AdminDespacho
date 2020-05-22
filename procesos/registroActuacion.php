<?php //require_once("../seguridad/seguridad.php");?>

<?php

//Configuracion de la conexion a base de datos

   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  function _formatear($fecha)
		{
			return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
		}
 	function evaluar($valor) 
		{
			$nopermitido = array("'",'\\','<','>',"\"");
			$valor = str_replace($nopermitido, "", $valor);
			return $valor;
		}		
	  $idProceso=$_POST['idProceso'];
	  $identidad=$_POST['identidad'];
	  $radicado=$_POST['radicado'];
	  $cel=$_POST['cel'];
	  $tipo="estados";
	  $actuacion=$_POST['actuacion'];
	  $fecha=$_POST['fecha'];
	  $fechaAuto=$_POST['fechaAuto'];
	  $fechaInicio=$_POST['fechaInicio'];
	  $fechaFin=$_POST['fechaFin'];
	  $email=$_POST['email'];
	   $numEstado=$_POST['numEstado'];
	  //$hora=$_POST['hora'];
	  $cuerpo = "";
		//$fechaInicio = date_format($fechaInicio, 'd/m/Y H:i');
	    //$fechaFin = date_format($fechaFin, 'd/m/Y H:i');
		
		
		
		// Recibimos los demas datos desde el form
		$titulo = $actuacion;
		// y con la funcion evaluar
		$body   = evaluar('Actuacion');
    	// reemplazamos los caracteres no permitidos
    	$clase  = evaluar('event-important');
    		// Recibimos el fecha de inicio y la fecha final desde el form
    	//$inicio_normal = date_format($fechaInicio, 'd/m/Y');
    	$inicio_normal = date("d/m/Y", strtotime($fechaInicio));
    	// y la formateamos con la funcion _formatear
    	$final_normal  = date("d/m/Y", strtotime($fechaFin));
    	$inicio = _formatear($fechaInicio);
		// y la formateamos con la funcion _formatear
		$final  = _formatear($fechaFin);
		// insertamos el evento
		$nuevaInicio = strtotime ( '+0 day' , strtotime ( $inicio_normal ) ) ;
		$nuevaInicio = date ( 'Y-m-j' , $nuevaInicio );	
		$nuevaFin = strtotime ( '+0 day' , strtotime ( $final_normal ) ) ;
		$nuevaFin = date ( 'Y-m-j' , $nuevaFin );	

	
	$query="INSERT INTO eventos VALUES
	(null,'$identidad','$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','$nuevaInicio','$nuevaFin')";
	//recojo los datos del proceso
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
	  $carpeta ="imgProcesos/"."proceso".$idProceso."/actuaciones";

	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		 }

		$dir_subida = $carpeta;

		//Inicio envio varios archivos
					//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
					foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
					{
						//Validamos que el archivo exista
						if($_FILES["archivo"]["name"][$key]) {
							$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
							$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
							
							$directorio = $dir_subida; //Declaramos un  variable con la ruta donde guardaremos los archivos
							
														
							$dir=opendir($directorio); //Abrimos el directorio de destino
							$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
							
							//Movemos y validamos que el archivo se haya cargado correctamente
							//El primer campo es el origen y el segundo el destino
							if(move_uploaded_file($source, $target_path)) {	
								echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
								} else {	
								echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
							}
							closedir($dir); //Cerramos el directorio de destino
							
								$imagen="<img src='../img/viacpro.png' width='18%'>";
								 echo '<br>
								 <a title="Enviar a WhathApp" 
								 href="https://api.whatsapp.com/send?phone=57'.$cel.'&text=Actualizacion de estado Proceso radicado N.  '.$idRadicado.' Demandado : '.$demandado.' - Demandante: '.$demandante.' Verifique en su Perfil: www.viacpro.com/AdminClientes --Mensaje de VIACPRO- Vigilancia de Actuaciones Procesales."  target="_blank" rel="noopener">
								 <img src="../img/wasap.jpg" width="15%">Enviar a WhatsApp</a>
								 ';
								 date_default_timezone_set('America/Bogota');
								 $hoy = date("Y-m-d"); 
								 $horaR = date("g:i a");  
								 $sql="INSERT INTO des_actuaciones (idProceso,numEstado,idCliente,fecha,tipo,actuacion,fechaAuto,fechaInicio,fechaFin,hora,nombreArchivo,usuarioRegistra,fechaRegistro,horaRegistro,estado)
								 VALUES ('$idProceso','$numEstado','$identidad','$fecha','$tipo','$actuacion','$fechaAuto','$fechaInicio','$fechaFin','$horaR','$filename','$usuario','$hoy','$horaR','Activo')";
								 mysql_query($sql) or die('<center>No se registro actuacion verifique!!..</center>');
						}
					}
				//fin
	/*	
	$ftp_servidor = "viacpro.com";
    $ftp_usuario = "desarrolladorviacpro@viacpro.com";
    $ftp_pass = "Viacpro2019.";

    $con_id = ftp_connect($ftp_servidor);
    $lr = ftp_login($con_id,$ftp_usuario,$ftp_pass);
     if((!$con_id) || (!$lr)){
            echo "<center>No se pudo subir el archivo verifique con el administrador!!!</center>";
            exit;
     }
		 else
		 {
							$destino ="AdminDespacho/procesos/imgProcesos/"."proceso".$idProceso."/actuaciones/";
							ftp_chdir($con_id, $destino);   
							$temp =explode(".",$_FILES["archivo"]["name"]);
							$source_file = $_FILES["archivo"]["tmp_name"];
							$nombre = $_FILES["archivo"]["name"];
							//ftp_pass($con_id,true);
							$subio=ftp_put($con_id,
							$nombre,
							$source_file,
							FTP_BINARY);
							if($subio) 
									{
									echo "Archivo cargado correctamente";
									$imagen="<img src='../img/viacpro.png' width='18%'>";
									 echo '<br>
									 <a title="Enviar a WhathApp" 
									 href="https://api.whatsapp.com/send?phone=57'.$cel.'&text=Actualizacion de estado Proceso radicado N.  '.$radicado.' Verifique en su Perfil: www.viacpro.com/AdminClientes --Mensaje de VIACPRO- Vigilancia de Actuaciones Procesales."  target="_blank" rel="noopener">
									 <img src="../img/wasap.jpg" width="15%">Enviar a WhatsApp</a>
	            ';
									}
							else{
									echo "Exite un error. El archivo no se subio verifique";
							}
			*/			
							  
								//envio el correo electronico al cliente informando la actuacion
									$asunto = "Informe de registro de Actuacion VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
									//para el envío en formato HTML 
									$headers = "MIME-Version: 1.0\r\n"; 
									$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
									$mensaje ='<a href="https://www.viacpro.com/AdminClientes"><img src="http://www.viacpro.com/AdminDespacho/img/viacpro2.png" width="100%"></a><br>';
									$mensaje .="<H1>Informacion de la Actuacion:</H1><br>";
									$mensaje .= 'N. Radicado:'.$idRadicado.'<br>Demandado :'.$demandado.' - Demandante: '.$demandante.'<BR>
									<br><table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
											<th>N. Estado</th>
											<th>Fecha</th>
										<th>Descripcion</th>
											<th>Fecha Auto</th>
											<th>Fecha Inicio</th>
											<th>Fecha Final</th>
											<th>Juzgado</th>
											</tr>
										</thead> 
										<tbody>
										<td>'.$numEstado.'</td>
												<td>'.$fecha.'</td>
										
										<td>'.strtoupper($actuacion).'</td>
										<td>'.$fechaAuto.'</td>
										<td>'.$fechaInicio.'</td>
										<td>'.$fechaFin.'</td>
										<td>'.strtoupper($nomJuzgado).'</td>
										</tbody>
									<tfoot>
									<tr style="background:#003A75; color:#FFF">
										<th>N. Estado</th>       
										<th>Fecha</th>
										
										<th>Descripcion</th>
										<th>Fecha Auto</th>
										<th>Fecha Inicio</th>
										<th>Fecha Final</th>
										<th>Juzgado</th>
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
							echo "<script> alert('Se almacenó correctamente la actuación.'); </script>";
			               
						
			//	}
?>



