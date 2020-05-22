<!DOCTYPE html>
<html>
<head>
  <title>.::recibo de pago Empresa::.</title>

 </head>
<body>
    <?php
          require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];
     $numComprobante=$_GET["numComprobante"];
   
     $sql=mysql_query("SELECT * FROM des_ingresosyegresos where numComprobante like '$numComprobante'");
     while($row = mysql_fetch_array($sql)){
          $numComprobante=$row['numComprobante'];
          $identidad=$row['identidad'];
          $descripcionP=$row['descripcion'];
          $fechaInicial=$row['fechaInicial'];
          $fechaFinal=$row['fechaFinal'];
          $usuarioRegistro=$row['usuarioRegistro'];
          $valor=$row['valor'];
          $detalle=$detalle."-".$row['detalle'];
     }
     mysql_free_result($sql);

     //verifico el plan
    


     $sqlEmpleado="SELECT empresa FROM des_cliente WHERE cedula_cliente like '$identidad'";

    $res=mysql_query($sqlEmpleado);
    while($rowE=mysql_fetch_array($res)) {
          $nombreEmpresa = $rowE["empresa"];
         
		}
		mysql_free_result($res);
    ?>
    <table border="1" width="800px">
                <tr>
                  <th><img src="../img/viacpro.png" width="45%"></th>
                  <th align="center">Comprobante de pago N° :<?php echo $numComprobante;?></th>
                  <th align="center">Vigilancia de Actuaciones Procesales</th>
                  <th align="center">Nit: 901170890-5</th>
                </tr>
                <tr style="background:#E5E5E5">
                  <th>Nombre Empresa</th>
                  <th style="color:#069"><?php echo strtoupper($nombreEmpresa);?></th>
                 
                  <th>Identificacion</th>
                  <th style="color:#069"><?php echo $identidad;?></th>
                 
                 </tr>
                 <tr> 
                  <th>Fecha de Pago</th>
                  <th colspan="3" style="color:#069"><?php echo $fechaInicial."/".$fechaFinal;?></th>
                 
               </tr>
    </table>
         
           <table border="1" width="800px">
                 <tr style="background=white; color:black">
                   <th align="center">Detalle</th>
                </tr>
                <tr style="background=white; color:black">
                   <th align="center"><?php echo $detalle;?></th>
                </tr>
                <tr>
                   
                   <th>Valor cancelado: <?php echo "$".number_format($valor);?></th>
                </tr>

             </table>
             <br>
             <table border="1" width="800px">
                  <tr align="left">
                      <th>Usuario que Registro: <?php echo $usuarioRegistro;?></th>
                      
                  </tr>
            </table>
     
</body>
</html>