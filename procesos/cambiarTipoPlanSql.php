<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idContrato=$_POST['idContrato'];
	  $plan=$_POST['plan'];
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
	 		//registro compra
				$sql="UPDATE des_contratos_empresas set idPlan ='$plan' where id like '$idContrato'";
				//echo $sql;
				mysql_query($sql) or die('<center>No se cambio tipo plan consulte con el administrador!!..</center>');
				$sqlProcesos="UPDATE des_procesos set idPlan ='$plan' where idContrato like '$idContrato'";
				mysql_query($sqlProcesos) or die('<center>No se cambio tipo plan consulte con el administrador!!..</center>');
				//echo $sqlProcesos;
				echo "<center><br><br><img  src='../img/correcto.png' width='28' height='25'></center><br>"; 
	            echo "<center><font color='red'>Se cambio plan correctamente!!</font></center>";
		
?>

