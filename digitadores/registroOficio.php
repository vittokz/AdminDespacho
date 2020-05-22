<?php //require_once("../seguridad/seguridad.php");?>

<?php
	 require_once ('../conexion.php');

	if(!isset($_SESSION)) { session_start(); } 
		$usuario = $_SESSION["usuario"]; 
	 
	  $email=$_POST['email'];	
	  $idProceso=$_POST['idProceso'];
	  $identidad=$_POST['identidad'];
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
	  
	  //recojo los datos del proceso
	   $carpeta ="imgProcesos/"."proceso".$idProceso."/oficiosDepen";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		 }

		$dir_subida = $carpeta;
	
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
								
									 $sql="INSERT INTO des_oficiosDependientes(idProceso,idCliente,nombreArchivo,descripcion,usuarioRegistra,fechaRegistro,estado) 
									 VALUES('$idProceso','$identidad','$filename','$descripcion','$usuario','$hoy','Activo')";
									 $res=mysql_query($sql) or die("No se registro oficio");
							}
						}
					//fin
					        	
		/*					
								//envio el correo electronico al cliente informando la actuacion
									$asunto = "Informe de registro de Oficio-Archivo VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
									//para el envío en formato HTML 
									$headers = "MIME-Version: 1.0\r\n"; 
									$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n";
									$mensaje ='<a href="https://www.viacpro.com/AdminClientes"><img src="https://www.viacpro.com/AdminDespacho/img/viacpro2.png" width="100%"></a><br>'; 
									$mensaje .="<H1>Informacion de la Notificacion:</H1>";
									$mensaje .= '
									<br><table width=700px id="example1" class="table table-bordered table-striped">
										<thead>
										<tr style="background:#003A75; color:#FFF; font-size:12px">
											<th>Fecha</th>
											<th>Descripcion</th>
										
										</tr>
										</thead> 
										<tbody>
									   		<td>'.$fecha.'</td>
											<td>'.strtoupper($descripcion).'</td>
										</tbody>
									<tfoot>
									<tr style="background:#003A75; color:#FFF">
									    <th>Fecha</th>
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
							
				*/
				echo "<script> alert('Se almacenó correctamente la informacion.'); </script>";
				
			
?>



