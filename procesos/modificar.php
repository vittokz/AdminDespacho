<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $radicado=$_POST['radicado']; 
	  $idProceso=$_POST['idProceso'];
	  $idJuzgado=$_POST['idJuzgado'];
	  $demandante=$_POST['demandante'];
	  $demandado=$_POST['demandado'];
	  $fechaProceso=$_POST['fechaProceso'];
	  $valor=$_POST['valor'];
	  $tiempoI=$_POST['tiempo'];
	  $tiempo="+".$_POST['tiempo'];
	  $tiempo=$tiempo." month";
      $iva=$_POST['iva'];
	  $resultado = 0;
	  $resulIva=0;
	  $total=0;
	   if($iva=="Si"){
		 $resulIva = ($valor*19)/100;
		 $resultado = $valor -$resulIva;
	   }
	   else{
         $resulIva = 0;
		 $resultado = $valor;

	   }
	   $total= $resulIva + $resultado;
	            date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				$fecha_actual = date("Y-m-d");
				//sumo 6 mes
				
				$fechaTerminacion = strtotime ( '+6 month', strtotime ( $fecha_actual ) ) ;
			    $fechaTerminacion = date ( 'Y-m-d' , $fechaTerminacion ); 
				
      			//$fechaTerminacion= date("Y-m-d",strtotime($fecha_actual."+ 6 month")); 
		        $sql="UPDATE des_procesos SET idRadicado='$radicado',tiempo='$tiempoI',valor='$resultado',iva='$resulIva',total='$total',idJuzgado='$idJuzgado',demandado='$demandado',demandante='$demandante',
				fechaProceso='$fechaProceso', fechaTerminacion='$fechaTerminacion' WHERE idProceso like '$idProceso'";
		    	mysql_query($sql) or die('<center>No se modifico el proceso verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='30' height='30'></center><br>"; 
				echo "<center><font color='red'>Se modifico correctamente el proceso!!</font></center>";
				
/*
				$sql="UPDATE des_valor_procesos SET iva='$resulIva',valor='$resultado',total='$total' WHERE idProceso like '$idProceso'";
				mysql_query($sql) or die('');
				$cuenta = mysql_num_rows($sql);
				 if($cuenta<=0){
					$sql="INSERT INTO des_valor_procesos(idProceso,idDependiente,iva,valor,total,usuarioRegistro,fechaRegistro) VALUES ('$idProceso','','$resulIva','$resultado','$total','$usuario','$hoy')";
					mysql_query($sql) or die('<center>No se modifico contablemente verifique!!..</center>');
				 }
				
*/

?>

