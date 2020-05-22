<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

	  $tipoCuenta=$_POST['tipoCuenta'];
      $idCliente=$_POST['idCliente'];
      $empresa=$_POST['empresa'];
	  $medio=$_POST['medio'];
	  $fechaEla=$_POST['fechaEla'];
	  $fechaVence=$_POST['fechaVence'];
	  $ccEmpleado=$_POST['ccEmpleado'];
	  $idPlan=$_POST['idPlan'];
	  $nomPlan=$_POST['nomPlan'];
	  $valorPlan=$_POST['valorPlan'];
	  $descuento=$_POST['descuento'];
	  $fechaInicial=$_POST['fechaInicial'];
      $fechaFin=$_POST['fechaFin'];
	  $idContrato=$_POST['idContrato'];
	  $vendedor=$_POST['vendedor'];
	  //echo $fechaFin;
	 
	  $fechaFin2=date("Y-m-d",strtotime($fechaFin."+ 1 days")); 
	  //echo $fechaFin;
	 
	  $sqlP=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan' and estado like 'Activo'");
	  while($rowP = mysql_fetch_array($sqlP)){
		  $gerenteComercial=$rowP['gerenteComercial'];
		  $gerenteGeneral=$rowP['gerenteGeneral'];
		  $asesorComercial=$rowP['asesorComercial'];
          $valorTotal = $rowP['valor'];
	  }
	  mysql_free_result($sqlP);
	  $diasT =(strtotime($fechaInicial)-strtotime($fechaFin))/86400;
      $diasT =abs($diasT); 
	  $dias =floor($diasT);	
	  // $valorTotal=($valorPlan*$diasT)/30;
	  $bono = round(($valorTotal*10)/100);
	   $sqlP=mysql_query("SELECT * FROM des_usuario where nombre_usua like '$empleado'");
	 while($rowP = mysql_fetch_array($sqlP)){
		  $cedula=$rowP['cedula_usuario'];
		}
	  mysql_free_result($sqlP);

	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				
			 //registro compra
			 if($dias<30){
				$nuevoValor=($valorTotal*$dias)/30;
				$valorTotal  = $nuevoValor - (($nuevoValor * $descuento)/100);
	            $gerenteComercial = (($gerenteComercial*$dias)/30)-(($gerenteComercial*$descuento/100));
				$gerenteGeneral= (($gerenteGeneral*$dias)/30)-(($gerenteGeneral*$descuento/100));
				$asesorComercial = (($asesorComercial*$dias)/30)-(($asesorComercial*$descuento/100));
			 }else {
				$dias=30;
				$nuevoValor=($valorTotal*$dias)/30;
				$valorTotal  = $nuevoValor - (($nuevoValor * $descuento)/100);
			    $gerenteComercial = $gerenteComercial-(($gerenteComercial*$descuento/100));
				$gerenteGeneral= $gerenteGeneral-(($gerenteGeneral*$descuento/100));
				$asesorComercial = $asesorComercial-(($asesorComercial*$descuento/100));
			 }	
				$sql="INSERT INTO des_liquidar_contratos (idContrato,idenCliente,idenEmpleado,medioPago,fechaElaboracion,fechaVencimiento,usuarioAsesor,valorBono,asesorComercial,gerenteComercial,gerenteGeneral,periodoInicial,periodoFin,fechaAux,valor,estadoLiquida,estadoEnvio,fechaRegistro,usuarioLiquida)VALUES ('$idContrato','$idCliente','$ccEmpleado','$medio','$fechaEla','$fechaVence','$vendedor','$gerenteComercial','$asesorComercial','$gerenteComercial','$gerenteGeneral','$fechaInicial','$fechaFin2','$fechaFin','$valorTotal','Cuenta de Cobro','Pendiente','$hoy','$usuario')";
			   
				mysql_query($sql) or die(mysql_error());
				echo "<center><img  src='../img/correcto.png' width='25' height='22'></center><br>"; 
				echo "<center><font color='red'>Se registro correctamente!!</font></center>";		
?>
             

