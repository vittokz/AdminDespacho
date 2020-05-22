<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];
	  $destino=$_POST['destino'];
	  $mensaje=$_POST['mensaje'];
      date_default_timezone_set('America/Bogota');
	  $hoy = date("Y-m-d g:i a"); 
	  $sql="INSERT INTO des_mensajes(usuarioRemite,usuarioRecibe,mensaje,estado,fechaRegistro) VALUES
	  ('$usuario','$destino','$mensaje','No Leido','$hoy')";
      mysql_query($sql) or die('<center><font color="red">No se registro el mensaje!!!..</font></center>');
      echo "<center><img  src='../img/correcto.png' width='50' height='48'></center><br>"; 
	  echo "<center><font color='red'>Enviado!!</font></center>";
      require_once("consulta.php");

?>

