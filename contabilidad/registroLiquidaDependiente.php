<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 

	  $fechaFin=$_POST['fechaFin'];
	  $fechaInicial=$_POST['fechaInicial'];
	  $idContrato=$_POST['idContrato'];
	  $idCliente=$_POST['idCliente'];
	  $valorPlan=$_POST['valorPlan'];
	  $empleado=$_POST['empleado'];
	  $idPlan=$_POST['idPlan'];
	  $sqlP=mysql_query("SELECT dependiente FROM des_planes where idPlan like '$idPlan' and estado like 'Activo'");
	  while($rowP = mysql_fetch_array($sqlP)){
		  $dependiente=$rowP['dependiente'];
	  }
	  mysql_free_result($sqlP);
	  $diasT =(strtotime($fechaInicial)-strtotime($fechaFin))/86400;
      $diasT =abs($diasT); 
	  $dias =floor($diasT);	
	  $valorTotal=0;
	  $valorTotal=($valorPlan*$diasT)/30;
	   $sqlP=mysql_query("SELECT * FROM des_usuario where nombre_usua like '$empleado'");
	 while($rowP = mysql_fetch_array($sqlP)){
		  $cedula=$rowP['cedula_usuario'];
		}
	  mysql_free_result($sqlP);

	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
	 		//registro compra
				$sql="INSERT INTO des_liquidar_contratos_dependientes (idContrato,idenCliente,idenEmpleado,valorPagado,periodoInicial,periodoFin,estadoLiquida,fechaRegistro,usuarioLiquida)VALUES ('$idContrato','$idCliente','$cedula','$dependiente','$fechaInicial','$fechaFin','Pagado','$hoy','$usuario')";
			
				mysql_query($sql) or die('<center>No se registro pago!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='25' height='22'></center><br>"; 
	            echo "<center><font color='red'>Se registro correctamente!!</font></center>";
		
?>

