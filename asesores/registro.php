<?php
//Configuracion de la conexion a base de datos
        require_once ('../conexion.php');
        if(!isset($_SESSION)) { session_start(); } 
        $usuario = $_SESSION["usuario"]; 
     
        $cliente=$_POST['cliente'];
        $email=$_POST['email'];
        $celular=$_POST['celular'];
        $contacto=$_POST['contacto'];
        $fecha=$_POST['fecha'];
        date_default_timezone_set('America/Bogota');
        $hoy = date("Y-m-d H:i:g"); 

        $sql="INSERT INTO des_llamadas (empresa,celular,email,contacto,observacion,fechaVence,fecha,usuario) VALUES 
        ('$cliente','$celular','$email','$contacto','no','$fecha','$hoy','$usuario')";
        mysql_query($sql) or die(mysql_error());
        echo "<center><br><br><img  src='../img/correcto.png' width='35' height='32'></center><br>"; 
        echo "<center><font color='red'>Se registro correctamente!!</font></center>";

   


?>

