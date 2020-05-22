<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

	  $fechaFin=$_POST['fechaFin'];
	  //echo $fechaFin;
	 
	  $fechaFin2=date("Y-m-d",strtotime($fechaFin."+ 1 days")); 
	  //echo $fechaFin;
	  $fechaInicial=$_POST['fechaInicial'];
	  $idContrato=$_POST['idContrato'];
	  $idCliente=$_POST['idCliente'];
	  $valorPlan=$_POST['valorPlan'];
	  $empleado=$_POST['empleado'];
	  $idPlan=$_POST['idPlan'];
	  $descuento=$_POST['descuento'];

	  $usuarioRegistro=$_POST['usuarioRegistro'];
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
				$sql="INSERT INTO des_liquidar_contratos (idContrato,idenCliente,idenEmpleado,usuarioAsesor,valorBono,asesorComercial,gerenteComercial,gerenteGeneral,periodoInicial,periodoFin,fechaAux,valor,estadoLiquida,fechaRegistro,usuarioLiquida)VALUES ('$idContrato','$idCliente','$cedula','$usuarioRegistro','$gerenteComercial','$asesorComercial','$gerenteComercial','$gerenteGeneral','$fechaInicial','$fechaFin2','$fechaFin','$valorTotal','Pagado','$hoy','$usuario')";
			   
				mysql_query($sql) or die(mysql_error());
				echo "<center><img  src='../img/correcto.png' width='25' height='22'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente!!</font></center>";
		
?>

