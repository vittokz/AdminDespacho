<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
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
	  $tipoEmpleado=$_POST['tipoEmpleado'];
	  $salario=$_POST['salario'];
	  
	  date_default_timezone_set('America/Bogota');
      $fecha = date("Y-m-d H:i:s"); 

       $sql="INSERT INTO des_empleado (tipo,cedula_empleado,empresa,nombre,  
		  apellido,salario,tipoEmpleado,semestre,municipio,tipoContrato,telefono,celular,dir_empleado,email,fecha_naci,fechaContrato,estado,usuario,fechaRegistro,fechaElimino,usuarioElimino) VALUES 
		  ('$tipo','$cedula','$empresa','$nom', '$ape','$salario','$tipoEmpleado','$semestre','$muni','$contrato',  
		  '$tel','$cel','$dir','$email','$fechaNaci','$fechaContrato','Activo','$usuario','$fecha','','')";
		  mysql_query($sql) or die(mysql_error());
          echo "<center><img  src='../img/correcto.png' width='55' height='52'></center><br>"; 
	      echo "<center><font color='red'>Se registro correctamente Empleado!!</font></center>";
   


?>

