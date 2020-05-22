<?php
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];
	
	   $identidad="";$nombre="";$apellido ="";$claveUsuario ="";$tipoUsuario ="";
       $sql="SELECT * FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'";
        $res=mysql_query($sql) or mysql_error();
        while($row=mysql_fetch_array($res)) {
            $identidad = $row["cedula_usuario"];
            $nombre = $row["nombre"];
            $apellido = $row["apellido"];
            $nomUsuario = $row["nombre_usua"];
            $claveUsuario = $row["clave_usuario"];
            $tipoUsuario = $row["tipo_usuario"];
		}
    mysql_free_result($res);
  
    $sql=mysql_query("SELECT * FROM des_empleado where cedula_empleado like '$identidad'");
    while($row = mysql_fetch_array($sql)){
      $logo=$row['logo'];
    }
     
    if($logo==""){
      $logoImagen="../dist/img/avatar5.png";
     }
     else{
       $logoImagen="../perfil/imgLogos/".$identidad."/".$logo;
     }
     
?>

<html>
 <head>
     <title>Chat</title>
     <link rel="stylesheet" type="text/css" href="style.css">
     <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
 </head>
<body>
   
    <div class="chatbox">
        <div class="chatlogs" id="resultado">
           <?php 
            $sql=mysql_query("SELECT * FROM des_chat where remitente like 'desarrollador' and destinatario like 'DEMO' or remitente like 'Demo' and destinatario like 'desarrollador' order by fechaMensaje DESC");
              while($row = mysql_fetch_array($sql)){
                  $mensaje=$row['mensaje'];
                  $remitente=$row['remitente'];
                  $destinatario=$row['destinatario'];
           ?>
                    <?php
                    if($remitente==$usuario)
                    {
                    ?>
                      <div class="chat friend">
                          <div class="user-photo"><img src="<?php echo $logoImagen;?>"></div>
                          <p class="chat-message"><?php echo $mensaje;?></p> 
                      </div>
                   <?php
                    }
                   ?>
                   <?php
                    if($destinatario=="desarrollador")
                    {
                    ?>
                      <div class="chat self">
                          <div class="user-photo"><img src=""></div>
                          <p class="chat-message"><?php echo $mensaje;?></p> 
                      </div>
                   <?php
                    }
                   ?>
                  
            <?php
              }
            ?>
         
        </div>
          <div class="chat-form">
            <form name="chat">
              <input type="hidden" id="remitente" value="<?php echo $usuario;?>">
              <input type="hidden" id="destinatario" value="DEMO">
              <textarea id="mensajeChat"></textarea>
              <button type="submit"  onClick="enviar(); return false;">Enviar</button>
            </form>
          </div>  
    </div>
    

</body>
 </html>
