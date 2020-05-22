<?php //require_once("../seguridad/seguridad.php");?>

<?php

//Configuracion de la conexion a base de datos

   require_once ('../conexion.php');

	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idProceso=$_POST['idProceso'];
	  $identidad=$_POST['identidad'];
	  $radicado=$_POST['radicado'];
	  $asunto2=$_POST['asunto'];
	  $fecha=$_POST['fecha'];
	  $fechaInicio=$_POST['fechaInicio'];
	  $fechaFin=$_POST['fechaFin'];
	  $email=$_POST['email'];
	  $numFijacion=$_POST['numFijacion'];
	  //$hora=$_POST['hora'];
	  $cuerpo = "";
	  //inserto en eventos la nueva actuacion
	  /*$inicio = _formatear($fechaInicio);
	  $fin =_formatear($fechaFin);
	  
      $inicio_normal = $fechaInicio;
      $final_normal  = $fechaFin;
      $nuevaInicio = strtotime ( '+0 day' , strtotime ( $inicio_normal ) ) ;
      $nuevaInicio = date ( 'Y-m-j' , $nuevaInicio );	
      $nuevaFin = strtotime ( '+0 day' , strtotime ( $final_normal ) ) ;
	  $nuevaFin = date ( 'Y-m-j' , $nuevaFin );
	  $sqlE="INSERT INTO eventos VALUES(null,'$identidad','$tipo','$actuacion','','event-important','$inicio','$final','$inicio_normal','$final_normal','$nuevaInicio','$nuevaFin')";

	  */
  //
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
	  $carpeta ="imgProcesos/"."proceso".$idProceso."/actuaciones/";
	   if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
		$dir_subida = $carpeta;
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
							}
					else{
							echo "Exite un error. El archivo no se subio verifique";
					}
		
	            date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d"); 
				$horaR = date("g:i a");  
		        $sql="INSERT INTO des_actuaciones (idProceso,numEstado,idCliente,fecha,tipo,actuacion,fechaAuto,fechaInicio,fechaFin,hora,nombreArchivo,usuarioRegistra,fechaRegistro,horaRegistro,estado)
				VALUES ('$idProceso','$numFijacion','$identidad','$fecha','fijacionlista','$asunto2','$fecha','$fechaInicio','$fechaFin','$horaR','$nombre','$usuario','$hoy','$horaR','Activo')";
				mysql_query($sql) or die('<center>No se registro Fijación en lista!!..</center>');
				//envio el correo electronico al cliente informando la actuacion
					$asunto = "Informe de registro de Actuacion-Fijación en Lista VIACPRO-'Vigilancia de Actuaciones Procesales'"; 
					//para el envío en formato HTML 
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
				//dirección del remitente 
					$headers .= "From: VIACPRO <asesoria@viacpro.com>\r\n"; 
					$headers .="<H2>Informacion de la Actuacion-Fijación en Lista:</H2><br>";
					$headers .= 'N. Radicado:'.$idRadicado.'<br>Demandado :'.$demandado.' - Demandante: '.$demandante.'<BR>
					<br><table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr style="background:#003A75; color:#FFF; font-size:12px">
						  <th>N. Estado</th>
						  <th>Fecha</th>
						  <th>Descripcion</th>
						  <th>Fecha Inicio</th>
						  <th>Fecha Final</th>
						  <th>Juzgado</th>
					    </tr>
						</thead> 
						<tbody>
						<td>'.$numFijacion.'</td>
				        <td>'.$fecha.'</td>
						<td>'.strtoupper($asunto2).'</td>
						<td>'.$fechaInicio.'</td>
						<td>'.$fechaFin.'</td>
						<td>'.strtoupper($nomJuzgado).'</td>
						</tbody>
					<tfoot>
					<tr style="background:#003A75; color:#FFF">
					   <th>N. Estado</th>
						  <th>Fecha</th>
						  <th>Descripcion</th>
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
					$sqlEmail=mysql_query("SELECT distinct correo FROM des_envio_correos WHERE identidad like '$identidad'");
					while($rowEmail=mysql_fetch_array($sqlEmail)) {
						   $emailUsuarios = $emailUsuarios.','.$rowEmail["correo"];
							   
					   }
					 $long = strlen($emailUsuarios);
					
					 $emailUsuarios=substr($emailUsuarios,0,($long-1));
					 $emailUsuarios=$emailUsuarios.",".$email;
					 mail($emailUsuarios,$asunto,$cuerpo,$headers) ;
     		//----fin---
				echo "<script> alert('Se almacenó correctamente la actuación-fijación en lista.'); </script>";
			    echo "<script language='javascript'> 
				location.href='fijacionLista.php?identidad=$identidad&idProceso=$idProceso&radicado=$radicado' </script>";
		   }
?>



