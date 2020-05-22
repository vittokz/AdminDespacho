<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   	require_once ('../conexion.php');
	 	if(!isset($_SESSION)) { session_start(); } 
			$usuario = $_SESSION["usuario"]; 
			$idTarea=$_POST['idTarea'];
			$estado=$_POST['estado'];
			$des=$_POST['des'];
		   
			$sql="SELECT * FROM des_tareas where idTarea like '$idTarea'";
            $res=mysql_query($sql);
               while($row=mysql_fetch_array($res)) {
                  $usuarioRegistro = $row["usuarioRegistro"];
			   }
			if($usuarioRegistro==$usuario){
					date_default_timezone_set('America/Bogota');
					$hoy = date("Y-m-d H:i:s");
					//registro asignacion proceso
					$sql2="UPDATE des_tareas set estado='$estado',observacion='$des' where idTarea like '$idTarea'";
					mysql_query($sql2) or die('<center>No se cambio el estado!!..</center>');
					echo "<center><img  src='../img/correcto.png' width='30' height='30'></center>"; 
					echo "<center><font color='red'>Se cambio estado correctamente!!</font></center>";
			}
			else{
					echo "<center><img  src='../img/adver.jpg' width='30' height='30'></center>"; 
					echo "<center><font color='red'>Usuario no puede modificar Tarea!!</font></center>";
			}



?>

