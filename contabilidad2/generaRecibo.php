<!DOCTYPE html>
<html>
<head>
  <title>.::recibo de pago::.</title>

 </head>
<body>
    <?php
          require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];
     $numComprobante=$_GET["numComprobante"];
     $identidad=$_GET["identidad"];
    
     $sqlN="select * from des_pagos_mensuales where numComprobante like '$numComprobante' and idDependiente like '$identidad'";
		 $resultN=mysql_query($sqlN) or die('<center>No se consulto Comprobante!!..</center>');
		while($rowN = mysql_fetch_array($resultN))
		  {
            $fechaInicial=$rowN["fechaPagada"];
            $identidad=$rowN["idDependiente"];
            $fechaFinal=$rowN["fechaFinal"];
            $descripcion=$rowN["descripcion"];
            $detalle=$detalle."-".$rowN["detalle"];
            
						$valor=$valor+$rowN["valor"];
						$diasTrab=$rowN["diasTrab"];
						$usuarioRegistra=$rowN["usuarioRegistra"];
					
		  }
		  mysql_free_result($resultN);
    

	
     $sqlEmpleado="SELECT nombre,apellido FROM des_empleado WHERE cedula_empleado like '$identidad'";

    $res=mysql_query($sqlEmpleado);
    while($rowE=mysql_fetch_array($res)) {
          $nombre = $rowE["nombre"]." ".$rowE["apellido"];
         
		}
		mysql_free_result($res);
    ?>
    <table border="1" width="800px">
                <tr>
                  <th><img src="../img/viacpro.png" width="45%"></th>
                  <th align="left" colspan="4">Comprobante de pago:<?php echo $idComprobante;?></th>
                </tr>
                <tr style="background:#E5E5E5">
                  <th>Nombre Completo</th>
                  <th style="color:#069"><?php echo strtoupper($nombre);?></th>
                 
                  <th>Identificacion</th>
                  <th style="color:#069"><?php echo $identidad;?></th>
                 
                 </tr>
                 <tr> 
                  <th>Periodo de Pago</th>
                  <th><?php echo $fechaInicial."/".$fechaFinal;?></th>
                  <th colspan="2" style="color:#069"><?php echo $descripcion;?></th>
                 
               </tr>
    </table>
         
           <table border="1" width="800px">
               <tr style="background=white; color:black">
                  <th align="center" colspan="4">Listado de Procesos Pagados-Radicados</th>
                </tr>
                <tr>
                   <th><?php echo $detalle;?></th>
                  </tr> 
                 <tr><th colspan="4"></th></tr>
                <tr>
                   <th>Valor a pagar: <?php echo "$".number_format($valor);?></th>
                </tr>

             </table>
             <br>
             <table border="1" width="800px">
                  <tr align="left">
                      <th>Usuario que Pago: <?php echo $usuarioRegistra;?></th>
                      
                  </tr>
            </table>
     
</body>
</html>