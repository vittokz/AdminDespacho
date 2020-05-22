<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $idProceso=$_POST['idProceso'];
	  $idJuzgado=$_POST['idJuzgado'];
	  $radicado=$_POST['radicado'];
	  $tipo=$_POST['tipo'];
	  $etapa=$_POST['etapa'];
	  $demandante=$_POST['demandante'];
	  $demandado=$_POST['demandado'];
	  $descrip=$_POST['descrip'];
	  $fechaProceso=$_POST['fechaProceso'];
	  date_default_timezone_set('America/Bogota');
    			$hoy = date("Y-m-d H:i:s");
		        $sql="UPDATE des_procesos SET idRadicado='$radicado',idJuzgado='$idJuzgado',idTipoProceso='$tipo',demandado='$demandado',demandante='$demandante',descripcion='$descrip',etapa='$etapa',
				fechaProceso='$fechaProceso' WHERE idProceso like '$idProceso'";
				
				mysql_query($sql) or die('<center>No se modifico el proceso verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='75' height='72'></center><br>"; 
	            echo "<center><font color='red'>Se modifico correctamente el proceso!!</font></center>";
   


?>

