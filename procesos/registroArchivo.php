<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $tipo=$_POST['tipo'];
	  $fecha=$_POST['fecha'];
	  $idProceso=$_POST['oculto'];
	  $identidad=$_POST['oculto2'];
	  $des=$_POST['des'];
	  $email=$_POST['email'];
	  $radicado=$_POST['radicado'];
	  $cuerpo = "";

	    $carpeta ="imgProcesos/"."proceso".$idProceso."/multimedia";
	    if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
		//$nomImagen=basename($_FILES['archivoA']['name']);
		//$fichero_subido = $dir_subida.basename($_FILES['archivoA']['name']);
	    
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

                            $destino ="AdminDespacho/procesos/imgProcesos/"."proceso".$idProceso."/multimedia/";
               	            ftp_chdir($con_id, $destino);   
 			                $temp =explode(".",$_FILES["archivoA"]["name"]);
			                $source_file = $_FILES["archivoA"]["tmp_name"];
                            $nombre = $_FILES["archivoA"]["name"];
                            //ftp_pass($con_id,true);
                            $subio=ftp_put($con_id,
                            $nombre,
                            $source_file,
                            FTP_BINARY);
                                 if($subio) 
                                   {
                                    echo "Archivo cargado correctamente";
                                   }
                                     else{
                                       echo "Exite un error. El archivo no se subio verifique";
                                   }
                              

					    date_default_timezone_set('America/Bogota');
				    	$hoy = date("Y-m-d g:i a");   
			  			$sql="INSERT INTO des_audiosvideos (idProceso,idCliente,detalle,fecha,tipo,nombreArchivo,usuarioRegistra,fechaRegistro,estado)
						VALUES ('$idProceso','$identidad','$des','$fecha','$tipo','$nombre','$usuario','$hoy','Activo')";
						mysql_query($sql) or die('<center>No se registro archivo en la base de datos!!..</center>');
						 echo "<script> alert('Se almaceno correctamente el archivo..'); </script>";
			   			 //move_uploaded_file($_FILES['archivoA']['tmp_name'],$fichero_subido);
		                
						//recojo los datos del proceso
						  $sqlProceso=mysql_query("SELECT * FROM des_procesos WHERE idProceso like '$idProceso'");
								 while($rowProceso=mysql_fetch_array($sqlProceso)) {
										$idRadicado = $rowProceso["idRadicado"];
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
						  
						  //envio el correo electronico al cliente informando la actuacion
							$asunto = "Informe de registro de Video/Audio VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
							//para el env��o en formato HTML 
							$headers = "MIME-Version: 1.0\r\n"; 
							$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
							
							//direcci��n del remitente 
							$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
							$headers .="<H2>Informacion de registro Video/Audio:</H2><br>";
							$headers .= 'N. Radicado:'.$idRadicado.'<br>Demandado :'.$demandado.' - Demandante: '.$demandante.'<BR>
							<br><table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr style="background:#003A75; color:#FFF; font-size:12px">
								  <th>N. Estado</th>
								  <th>Fecha</th>
								  <th>Descripcion</th>
								  <th>Juzgado</th>
							    </tr>
								</thead> 
								<tbody>
								<td>'.$numEstado.'</td>
						        <td>'.$fecha.'</td>
								<td>'.strtoupper($des).'</td>
								<td>'.strtoupper($nomJuzgado).'</td>
								</tbody>
							<tfoot>
							<tr style="background:#003A75; color:#FFF">
							   <th>N. Estado</th>
								  <th>Fecha</th>
								  <th>Descripcion</th>
								  <th>Juzgado</th>
							</tr>
							</tfoot>
						  </table>
							
							
							'; 
							$headers .= "<BR>Puede acceder a revisar la informacion :<br> 
							<a href='https://www.viacpro.com/AdminClientes'>www.viacpro.com/AdminClientes</a><br>
							<img src='../img/viacpro.png' width='20%'>
							";
							
							$sqlEmail=mysql_query("SELECT distinct correo FROM des_envio_correos WHERE identidad like '$identidad'");
							 while($rowEmail=mysql_fetch_array($sqlEmail)) {
									$emailUsuarios = $emailUsuarios.','.$rowEmail["correo"];
										
								}
							  $long = strlen($emailUsuarios);
							 
							  $emailUsuarios=substr($emailUsuarios,0,($long-1));
							  $emailUsuarios=$emailUsuarios.",".$email;
							  mail($emailUsuarios,$asunto,$cuerpo,$headers) ;
						
						//----fin---
						
						
						
						 echo "<script> location.href='subirArchivo.php?identidad=$identidad&idProceso=$idProceso&radicado=$radicado' </script>";
            }
		