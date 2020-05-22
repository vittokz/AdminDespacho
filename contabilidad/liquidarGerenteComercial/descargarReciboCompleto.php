<?php
ob_start(); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
table#mitabla {
    border-collapse: collapse;
    border: 1px solid #CCC;
    font-size: 10px;
    width:800px;
    border:1;
}
 

table#mitabla td {
    font-weight: bold;
    background-color: #FFFFFF;
    padding:5px;
    border:1px solid;
}


table#mitabla tbody tr:hover td {
    background-color: #F3F3F3;
}
 
table#mitabla td {
    padding: 3px 6px;
}
</style>
   <?php
     require_once ('../../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];

     $fecha1=$_GET["fecha1"];
     $fecha2=$_GET["fecha2"];
     $salario=980657;
     $transporte=102853;
     $sqlL=mysql_query("SELECT * FROM des_liquidar_contratos where periodoInicial between '$fecha1' and '$fecha2'");
		      
   
     //verifico el plan
     $sql=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan'");
     while($row = mysql_fetch_array($sql)){
          $descripcion=$row['descripcion'];
          $valor=$row['valor'];
      }
     mysql_free_result($sql);
   	
    
    ?>
    <table id="mitabla" align="center">
                <tr>
                  <td><img src="../../img/viacpro.png"><br>
                  Vigilancia de Actuaciones Procesales-Comprobante de Nómina<br></td>
                  <td colspan="2" align="center">Nit: 901170890-5 <br>
                  Carrera 22A N 13-119<br>
                  Cel: 311 6480997<br>
                  Email: asesoria@viacpro.com
                  </td>
                </tr>
                <tr> 
                  <td><span style="color:BLUE">Periodo de Pago</span><br>
                    <?php echo $fecha1." | ".$fecha2;?>
                  </td>
                  <td colspan="2">Liquidación mensual Gerente Comercial</td>
                </tr>  
                <tr>
                   <td colspan="2"><span style="color:BLUE">Salario Básico:</span> <?php echo "$ ".number_format($salario);?></td>
                </tr>
                <tr>
                   <td colspan="2"><span style="color:BLUE">Auxilio de Transporte: </span><?php echo "$ ".number_format($transporte);?> </td>
                  </td>
                </tr>             
    </table>
         
           
          <table id="mitabla" align="center">
          <tr><td style="background-color:#053d54;color:#FFFFFF" align="center" colspan="2">
                DEVENGADO</td>
                <td style="background-color:#053d54;color:#FFFFFF" align="center" colspan="3">
                DEDUCCIONES</td> 
                </tr>
             
              <?php
              $total=0;
                while($row=mysql_fetch_array($sqlL)) {
                  $idenCliente =$row["idenCliente"];
                  $idContrato=$row["idContrato"];
                  $sqlContrato=mysql_query("SELECT municipio,idPlan FROM des_contratos_empresas where id like '$idContrato'");
                  while($rowContrato = mysql_fetch_array($sqlContrato)){
                       $municipio=$rowContrato['municipio'];
                       $nombreCiudad="";
                       $idPlan=$rowContrato['idPlan'];
                        $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
                        while($rowM=mysql_fetch_array($sqlCiudad)) {
                          $nombreCiudad = $rowM["opcion"];
                        }
                  }
                  mysql_free_result($sqlContrato);

                  $sqlPlan=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan'");
                  while($rowPlan = mysql_fetch_array($sqlPlan)){
                        $descripcion=$rowPlan['descripcion'];
                        
                    }
                  mysql_free_result($sqlPlan);           

                  $usuarioLiquida =$row["usuarioLiquida"];
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
                  $gerenteComercial =$row["gerenteComercial"];
                  $total=$total+$gerenteComercial;       
              
               }
             mysql_free_result($sqlL);
               ?>
               <tr>
                   <td colspan="2">SUELDO: <?php echo "$ ".number_format($salario+$transporte);?></td>
                   <td colspan="3">SALUD: <?php echo "$ ".number_format((($total+$salario)*4/100));?></td>
               </tr>
               <tr>
                   <td colspan="2">COMISIONES: <?php echo "$ ".number_format($total);?></td>
                   <td colspan="3">PENSION: <?php echo "$ ".number_format((($total+$salario)*4/100));?></td>
               </tr>
               <tr>
                   <td style="background-color:#0E88AB; color:#ffffff; font-size:16px" colspan="2">TOTAL DEVENGADO: <?php $totalDevengado=$salario+$transporte+$total; echo "$ ".number_format($totalDevengado);?></td>
                   <td style="background-color:#0E88AB; color:#ffffff; font-size:16px" colspan="3">TOTAL DEDUCCIONES: <?php $totalDeducciones=(($total+$salario)*4/100)*2; echo "$ ".number_format($totalDeducciones);?></td>
               </tr>
            </table>
          
          <table id="mitabla" border="0" align="center">
             
                 <tr>
                      <td align="left" rowspan="3">
                        <span style="font-size:10px"></span>
                        <br><br><br><br>
                        Firma,________________________ <BR>
                        C.C: 1083915513, KATERINE DUARTE
                      </td>
                      <td style="background-color:#0E88AB; color:#ffffff; font-size:16px" align="right">TOTAL PAGO</td>
                      <td style="background-color:#0E88AB; color:#ffffff; font-size:16px">
                          <?php 
                            echo "$ ".number_format($totalDevengado-$totalDeducciones);
                          ?>
                                  
                      </td>
               </tr>
               

          </table>
             <br>
             <table id="mitabla" border="0" align="center">
                  <tr align="left">
                      <td>Usuario que Genero: <?php echo $usuario;?></td>
                      
                  </tr>
            </table>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ReciboDePagoGerentes.pdf";
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>