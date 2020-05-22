<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $idEmpleado=$_POST['idEmpleado'];
	  $cedula=$_POST['iden'];
	  $nom=$_POST['nombre'];
	  $ape=$_POST['ape'];
	  $tel=$_POST['tel'];
	  $cel=$_POST['cel'];
	  $dir=$_POST['dir'];
	  $email=$_POST['email'];
	  $muni=$_POST['municipio'];
	  $fechaNaci=$_POST['fecha'];
	  $tipo=$_POST['tipo'];
	  $empresa=$_POST['empresa'];
	  $semestre=$_POST['semestre'];
	  $contrato=$_POST['contrato'];
	  $fechaContrato=$_POST['fechaContrato'];
	  $estadoEmple=$_POST['estadoEmple'];
	  $salario=$_POST['salario'];
	  $tipoEmple=$_POST['tipoEmple'];
	 
	  date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s");
	 
      $sql="UPDATE des_empleado SET tipo='$tipo',cedula_empleado='$cedula',empresa='$empresa',nombre='$nom',  
		  apellido='$ape',salario='$salario',tipoEmpleado='$tipoEmple',semestre='$semestre',municipio='$muni',tipoContrato='$contrato',telefono='$tel',celular='$cel',dir_empleado='$dir',email='$email', fecha_naci='$fechaNaci',fechaContrato='$fechaContrato',estado='$estadoEmple' WHERE id_empleado like '$idEmpleado'";
				
				
				mysql_query($sql) or die('<center>No se modifico el Empleado verifique!!..</center>');
				echo "<center><img  src='../img/correcto.png' width='45' height='42'></center>"; 
	            echo "<center><font color='red'>Se modifico correctamente Empleado!!</font></center>";
   


?>

