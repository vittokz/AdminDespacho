<?php require_once("../../seguridad/seguridad.php");
    require_once ('../../conexion.php');
   if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
     $fecha1=$_POST['fecha1'];
     $fecha2=$_POST['fecha2'];
     $sql=mysql_query("SELECT * FROM des_liquidar_contratos where periodoInicial between '$fecha1' and '$fecha2'");
		   		
?>
      <center>
      <a href="descargarRecibo.php?fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>" target="_blank">
        <img src="../../img/mirar.png" width="5%">Generar Recibo
      </a>
      <a href="descargarReciboCompleto.php?fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>" target="_blank">
        <img src="../../img/verificar.png" width="5%">Generar Liquidacion Completa
      </a>
      <table border="1" width="80%">
                <tr  style="background:#003A75; color:#FFF">
                  <th><center>Empresa</center></th>
                  <th><center>Empleado</center></th>
                  <th><center>Valor</center></th>
                 
                </tr>
             <?php
              while($row=mysql_fetch_array($sql)) {
                 $idenCliente =$row["idenCliente"];
                 $sqlC=mysql_query("SELECT * FROM des_cliente where cedula_cliente like '$idenCliente'");
                        while($rowC = mysql_fetch_array($sqlC)){
                           $empresa=$rowC['empresa'];
                        }
                 $idenEmpleado =$row["idenEmpleado"];
                 $sqlEmple="select * from des_empleado where cedula_empleado like '$idenEmpleado'";
                 $resul2=mysql_query($sqlEmple);
                    while($rowEmple=mysql_fetch_array($resul2)) {
                         $nombre = $rowEmple["nombre"]." ".$rowEmple["apellido"];
                    }
        			   $gerenteGeneral =$row["gerenteGeneral"];
        		        			
             ?>
                <tr>
                  <td><?php echo strtoupper($empresa);?></td>
                  <td><?php echo strtoupper($nombre);?></td>
                  <td><?php echo "$ ".number_format($gerenteGeneral);?></td>
                </tr>
             <?php
              }
        		mysql_free_result($resul);
             ?>
              </table>
              </center>
    
  </div>
</div>
</body>
</html>
