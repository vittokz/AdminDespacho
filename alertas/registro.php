<?php
//Configuracion de la conexion a base de datos
        require_once ('../conexion.php');
        if(!isset($_SESSION)) { session_start(); } 
        $usuario = $_SESSION["usuario"]; 
        $des=$_POST['des'];
        $cliente=$_POST['cliente'];
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
      
        date_default_timezone_set('America/Bogota');
        $hoy = date("Y-m-d H:i:s"); 

        $sql="INSERT INTO des_tareas (cliente,descripcion,fecha,hora,municipio,estado,fechaRegistro,usuarioRegistro) VALUES 
        ('$cliente','$des','$fecha','$hora','no','Pendiente','$hoy','$usuario')";
        mysql_query($sql) or die(mysql_error());
        echo "<center><br><br><img  src='../img/correcto.png' width='35' height='32'></center><br>"; 
        echo "<center><font color='red'>Se registro correctamente!!</font></center>";

   


?>

