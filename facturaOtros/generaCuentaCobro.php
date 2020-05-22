<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

	  $tipoCuenta=$_POST['tipo'];
      $idCliente=$_POST['idCliente'];
      $empresa=$_POST['empresa'];
	  $medio=$_POST['medio'];
	  $fechaEla=$_POST['fechaEla'];
	  $fechaVence=$_POST['fechaVence'];
	  $servicio=$_POST['servicio'];
	  $valorPago=$_POST['valorPago'];
	  //echo $fechaFin;
	 
	  $fechaFin2=date("Y-m-d",strtotime($fechaFin."+ 1 days")); 
	  //echo $fechaFin;
	 
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				
			   
			    $sql="INSERT INTO des_liquidar_contratos (idContrato,idenCliente,nomServicio,idenEmpleado,medioPago,fechaElaboracion,fechaVencimiento,usuarioAsesor,valorBono,asesorComercial,gerenteComercial,gerenteGeneral,periodoInicial,periodoFin,fechaAux,valor,estadoLiquida,estadoEnvio,fechaRegistro,usuarioLiquida)VALUES ('0','$idCliente','$servicio','no','$medio','$fechaEla','$fechaVence','no','no','no','no','no','no','no','no','$valorPago','Pagado','Pendiente','$hoy','$usuario')";
				mysql_query($sql) or die(mysql_error());
				
				echo "<script language='javascript'> 
					alert('Se registro correctamente!!');
					 location.href='cuentadeCobro.php?iden=$idCliente'</script>";	
?>
             

