<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $numComprobante=$_POST['numComprobante'];
	  $descripcion=$_POST['descripcion'];
	  $identidad=$_POST['identidad'];
	  $fecha=$_POST['fecha'];
	  $plan=$_POST['plan'];
	  $estados=$_POST['estados'];
	  $opcion=$_POST['opcion'];
	  $descuento=$_POST['descuento'];
	  if($opcion=="Si") {
		$municipio=$estados;
	  }
	  else{
		$municipio="0"; 
	  }
	 
	  if(fecha=="")
	  {
		  alert("Todos los campos son necesarios");
		
	  }
	  date_default_timezone_set('America/Bogota');
				$hoy = date("Y-m-d H:i:s");
				//registro Contrato
				$ban=0;
			    $sql=mysql_query("SELECT * FROM des_contratos_empresas where identidad like '$identidad' and municipio like '$municipio'");
				while($row = mysql_fetch_array($sql)){
                    $ban=1;
				}
				mysql_free_result($sql);
				if($ban==0){
					$sql="INSERT INTO des_contratos_empresas (identidad,numComprobante,descripcion,municipio,idPlan,descuento,fecha,estado,fechaRegistro,usuarioRegistro)VALUES ('$identidad','$numComprobante','$descripcion','$municipio','$plan','$descuento','$fecha','Activo','$hoy','$usuario')";
				
					mysql_query($sql) or die(mysql_error());
		    		echo "<script language='javascript'> 
					alert('Se registro correctamente!!');
					 location.href='contrato.php?iden=$identidad' </script>";
				}
				else{
					echo "<center><img  src='../img/adver.jpg' width='35' height='32'></center>"; 
	                echo "<center><font color='red'>Empresa ya tiene plan para el municipio seleccionado!!</font></center>";
				}
				
				
		
?>

