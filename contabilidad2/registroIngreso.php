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
	  $valor=$_POST['valor'];
	  $detalle="";
	  $valorTotal=0;
        //recojo datos del proceso
		$sqlProceso="SELECT * FROM des_procesos WHERE idCliente like '$identidad'";
		$resultP=mysql_query($sqlProceso);
		while($rowProceso=mysql_fetch_array($resultP)) {
			$idRadicado = $rowProceso["idRadicado"];
			$fechaProceso = $rowProceso["fechaProceso"];
			$total = $rowProceso["total"]; 
			$estadoProceso = $rowProceso["estado"]; 
			$detalle = $detalle."-Radicado: ".$idRadicado."/ Valor: ".$total."/ Estado: ".$estadoProceso."|";
			$valorTotal = $valorTotal+$total;
		}
		$num_procesos = mysql_num_rows($resultP);
		mysql_free_result($resultP);	
        //$valorTotal= $num_procesos*12000;
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
	 		   //registro ingreso
				$sql="INSERT INTO des_ingresosyegresos (identidad,numComprobante,descripcion,detalle,valor,tipo,fechaInicial,fechaFinal,fechaRegistro,usuarioRegistro)VALUES ('$identidad','$numComprobante','$descripcion','$detalle','$valorTotal','Ingreso','$fechaInicial','$fechaFinal','$hoy','$usuario')";
				
				mysql_query($sql) or die('<center>No se registro verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='35' height='32'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente!!</font></center>";
		
?>

