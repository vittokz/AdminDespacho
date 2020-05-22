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
     $identidad=$_GET['identidad'];
     $nombre=$_GET['nombre'];
     $sqlL=mysql_query("SELECT * FROM des_liquidar_contratos where periodoInicial between '$fecha1' and '$fecha2' and idenEmpleado like '$identidad'");
		      
  
      	
    
    ?>
    <table id="mitabla" align="center" width="70%">
                <tr>
                  <td><img src="https://www.viacpro.com/AdminDespacho/img/viacpro.png"><br>
                  Vigilancia de Actuaciones Procesales<br></td>
                  <td colspan="2" align="center">Nit: 901170890-5 <br>
                  Carrera 22A N 13-119<br>
                  Cel: 311 6480997<br>
                  Email: asesoria@viacpro.com
                  </td>
                </tr>
                <tr> 
                  <td><span style="color:BLUE">Periodo de Pago</span><br>
                    <?php echo $fecha1." | ".$fecha2;?><br>
                    
                  </td>
                  <td colspan="2">Pago Comisión Asesor Comercial</td>
                  </tr>               
    </table>
         
           
          <table id="mitabla" align="center">
          <tr><td style="background-color:#096075;color:#FFFFFF" align="center" colspan="5">Planes cancelados</td></tr>
              <tr>
                 <td><span style="color:BLUE">Cliente-Empresa</span></td>
                 <td><span style="color:BLUE">Descuento</span></td>
                 <td><span style="color:BLUE">Plan</span></td>
                 <td><span style="color:BLUE">Municipio</span></td>
                 <td><span style="color:BLUE">Valor</span></td>
              </tr>
              <?php
              $total=0;
                while($row=mysql_fetch_array($sqlL)) {
                  $idenCliente =$row["idenCliente"];
                  $idContrato=$row["idContrato"];
                  $sqlContrato=mysql_query("SELECT municipio,descuento,idPlan FROM des_contratos_empresas where id like '$idContrato'");
                  while($rowContrato = mysql_fetch_array($sqlContrato)){
                       $municipio=$rowContrato['municipio'];
                       $nombreCiudad="";
                       $idPlan=$rowContrato['idPlan'];
                       $descuento=$rowContrato['descuento'];
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
                          $salario = $rowEmple["salario"];
                     }
                  $valorBono =$row["asesorComercial"];
         
                  $total=$total+$valorBono;       
              ?>
                 <tr>
                   <td><?php echo strtoupper($empresa);?></td>
                   <td><?php echo strtoupper($descuento)." %";?></td> 
                   <td><?php echo strtoupper($descripcion);?></td>
                   <td><?php echo strtoupper($nombreCiudad);?></td>
                   <td><?php echo "$ ".number_format($valorBono);?></td>
                 </tr>
              <?php
               }
             mysql_free_result($sqlL);
               ?>
              
            </table>
          
          <table id="mitabla" border="0" align="center">
             
                 <tr>
                      <td align="left" rowspan="3">
                        <span style="font-size:10px"></span>
                        <br><br><br><br>
                        Firma,________________________ <br>
                        C.C <?php echo $identidad;?>, <?php echo $nombre;?><nav></nav>
                      </td>
                     
                  </tr>
                  <tr>
                      <td style="align="right">TOTAL COMISIÓN</td>
                      <td>
                          <?php 
                            echo "$ ".number_format(round($total));
                          ?>
                      </td>
               </tr>
               <tr>
                      <td style="background-color:#096075;color:#FFFFFF" align="right">TOTAL PAGO</td>
                      <td>
                          <?php 
                            echo "$ ".number_format(round($total));
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
$filename = "ReciboDePagoAsesor.pdf";
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>