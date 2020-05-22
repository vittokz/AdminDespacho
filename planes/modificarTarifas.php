<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $ano=$_POST['ano'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d");
	 
	  //plan 1
	  $idTarifa=$_POST['idTarifa'];
	  $plan1=$_POST['plan1'];
	  $ase1=$_POST['ase1'];
	  $gerC1=$_POST['gerC1'];
	  $gerG1=$_POST['gerG1'];
	  $dep1=$_POST['dep1'];
	 
		 
		  $i=0;
		  for($i=0;$i<=14;$i++){
			$sql="UPDATE des_planes set valor='".$plan1[$i]."',asesorComercial='".$ase1[$i]."',gerenteComercial='".$gerC1[$i]."',gerenteGeneral='".$gerG1[$i]."',dependiente='".$dep1[$i]."' where idPlan like '".$idTarifa[$i]."' and ano like '$ano'";
			mysql_query($sql);
			//echo $sql."<br>";
		  }
		  echo "<script language='javascript'> 
		  alert('Se modificaron tarifas correctamente!!');
		   location.href='planesTarifas.php' </script>";
  
      
?>

