<?php
//Configuracion de la conexion a base de datos
        require_once ('../conexion.php');
        if(!isset($_SESSION)) { session_start(); } 
        $usuario = $_SESSION["usuario"]; 
        $remitente=$_POST['remitente'];
        $destinatario=$_POST['destinatario'];
        $mensaje=$_POST['mensaje'];
        date_default_timezone_set('America/Bogota');
        $hoy = date("Y-m-d H:i:s"); 

        $sql="INSERT INTO des_chat (remitente,destinatario,mensaje,fechaMensaje) VALUES 
        ('$remitente','$destinatario','$mensaje','$fechaMensaje')";
        mysql_query($sql) or die(mysql_error());
      
   


?>

