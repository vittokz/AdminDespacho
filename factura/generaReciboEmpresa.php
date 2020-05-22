<?php
ob_start(); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
table#mitabla {
    border-collapse: collapse;
    border: 1px solid #CCC;
    font-size: 10px;
    width:500px;
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
          require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
     $usuario=$_SESSION["usuario"];

     $idLiquida=$_GET["idLiquida"];
    
     

     date_default_timezone_set('America/Bogota');
     $hoy = date("Y-m-d"); 

     $sqlL=mysql_query("SELECT * FROM des_liquidar_contratos where idLiquida like '$idLiquida'");
     while($rowL = mysql_fetch_array($sqlL)){
         $periodoInicial=$rowL['periodoInicial'];
         $periodoFin=$rowL['periodoFin'];
         $fechaAux=$rowL['fechaAux'];
         $fechaEla=$rowL['fechaElaboracion'];
         $fechaVencimiento=$rowL['fechaVencimiento'];
         $fechaGen=$rowL['fechaRegistro'];
         $valor=$rowL['valor'];
         $medio=$rowL['medioPago'];
         $idLiquida=$rowL['idLiquida'];
         $identidad=$rowL['idenCliente'];
         $idContrato=$rowL['idContrato'];
         $fechaRegistro=$rowL['fechaRegistro'];
         $usuarioLiquida=$rowL['usuarioLiquida'];
     }
     mysql_free_result($sqlL);
     $diasCon =(strtotime($fechaAux)-strtotime($periodoInicial))/86400;
     $diasCon =abs($diasCon); 
     //$diasCon =floor($diasCon);
     if($diasCon<29)
         $diasCon =$diasCon;
    else
          $diasCon=30;
     $sql="SELECT * FROM des_contratos_empresas where id like '$idContrato'";
    
     $res=mysql_query($sql);
     while($row = mysql_fetch_array($res)){
          $descripcionP=$row['descripcion'];
          $idPlan=$row['idPlan'];
          $fecha=$row['fecha'];
          $muniContrato=$row['municipio'];
          $nombreCiudadContrato="";
                    $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$muniContrato'");
                      while($rowC=mysql_fetch_array($sqlCiudad)) {
                      $nombreCiudadContrato = $rowC["opcion"];
                    }
     }
     mysql_free_result($res);

     //verifico el plan
     $sql=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan'");
     while($row = mysql_fetch_array($sql)){
          $descripcion=$row['descripcion'];
         // $valor=$row['valor'];
      }
     mysql_free_result($sql);
      date_default_timezone_set('America/Bogota');
	
       $diasT =(strtotime($periodoInicial)-strtotime($periodoFin))/86400;
       $diasT =abs($diasT); 
	   $dias =floor($diasT);	
       $valorTotal=0;
       $valorTotal=($valor*$diasT)/30;
       
      
	
    $sqlEmpleado="SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad'";
    $res=mysql_query($sqlEmpleado);
    while($rowE=mysql_fetch_array($res)) {
          $nombreEmpresa = $rowE["empresa"];
          $dir = $rowE["dir_cliente"];
          $municipio = $rowE["municipio"];
          $celular = $rowE["celular"];
          $nombreCiudad="";
					   $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
					   while($rowC=mysql_fetch_array($sqlCiudad)) {
							$nombreCiudad = $rowC["opcion"];
						}
		}
		mysql_free_result($res);
    ?>
    <table id="mitabla" align="center">
                <tr>
                     <td colspan="2" align="center"><br>
                    
                     <span style="font-size:16px; font-weight:bold">
                      VIGILANCIA DE ACTUACIONES PROCESALES<br>
                      VIACPRO</span><br>
                      Nit: 901170890-5<br>
                      Condominio Bosques de la Colina Torre 1 Oficina 501<br>
                      Cel: 311 6480997<br>
                      Pasto-Narino<br>
                      Email: asesoria@viacpro.com
                      </td>
                      <td align="center"><center><br><br><br><hr>Recibo<hr><br>
                          No. <?php echo $idLiquida;?> </center>
                      </td>
                </tr>
     </table><br><br><br>
     <table id="mitabla" align="center">        
                <tr>
                  <td style="background-color:#E6BF10;color:#020227">Señores</td> 
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo strtoupper($nombreEmpresa);?></td>
                  <td style="background-color:#E6BF10;color:#020227">Teléfono:</td>
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo $celular;?></td>
                </tr>
                <tr>
                  <td style="background-color:#E6BF10;color:#020227">Nit</td> 
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo $identidad;?></td>
                  <td style="background-color:#E6BF10;color:#020227">Ciudad</td>
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo $nombreCiudad;?></td>
                </tr>
                <tr>
                  <td style="background-color:#E6BF10;color:#020227">Dirección</td>
                  <td style="background-color:#F7F7F4;color:#020227" colspan="3"><?php echo $dir;?></td>
                 
                </tr>
                <tr>
                  <td style="background-color:#E6BF10;color:#020227">Fecha de Factura</td> 
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo $fechaEla;?></td>
                  <td style="background-color:#E6BF10;color:#020227">Fecha de Vencimiento</td>
                  <td style="background-color:#F7F7F4;color:#020227"><?php echo $fechaVencimiento;?></td> 
                </tr>
                
    </table>
         
        <br><br>
          <table id="mitabla" align="center">
              <tr>
                 <td style="background-color:#020227;color:#FFFFFF"><center>Item</center></td>
                 <td style="background-color:#020227;color:#FFFFFF"><center>Descripción</center></td>
                 <td style="background-color:#020227;color:#FFFFFF"><center>Cantidad</center></td>
                 <td style="background-color:#020227;color:#FFFFFF"><center>Vr Total</center></td>
              </tr>
              
              <tr>
                 <td><center>1</center></td>
                 <td><?php echo $descripcion." ".$nombreCiudadContrato;?></center></td>
                 <td><center>1</center></td>
                 <td><center><?php echo "$ ".number_format(round(($valor)));?></center></td>
              </tr>

              <tr>
                 <td colspan="4"></td>
              </tr>
              <tr>
                 <td colspan="4"></td>
              </tr>

              <tr>
                
                 <td colspan="2"></td>
                 <td style="background-color:#020227;color:#FFFFFF" align="right">Total Bruto</td>
                  <td><center>
                          <?php 
                            $subTotal=($valor/1.19);
                            $valIva=$valor-$subTotal;
                            echo "$ ".number_format(round(($subTotal)));
                          ?>
                        </center>          
                      </td>
              </tr>
              <tr>
               
                 <td colspan="2"><span style="color:BLUE">Condición de Pago  :</span> <?php 
                 $sqlA=mysql_query("SELECT * FROM des_medio_pago where idMedio like '$medio'");
                 while($rowA=mysql_fetch_array($sqlA)) {
                    $nombreP= $rowA["nombre"];
                    $cuentaP= $rowA["cuenta"];

                 }
                 echo $nombreP."-".$cuentaP;?></td>
                 <td style="background-color:#020227; color:#FFFFFF" align="right">IVA 19%</td>
                 <td><center><?php echo "$ ".number_format(round(($valIva)));?></center></td>
              </tr>
              <tr>
                 <td colspan="2"></td>
                 <td style="background-color:#020227; color:#FFFFFF" align="right">Total a Pagar</td>
                 <td><center><?php echo "$ ".number_format(round(($valor)));?></center></td>
              </tr>
              
          </table><br><br>
          
              

          </table>
             <br>
             <table id="mitabla" border="0" align="center">
                  <tr align="left">
                      <td style="background-color:#f3f3f5;color:#020227">Observaciones: <br>
                      <div align="justify">
                         Recibo de pago de periodo del <?php echo $periodoInicial;?> al <?php echo $periodoFin;?>
                      </div>    
                  </td>
                      
                  </tr>
            </table>
            <br><br><br>
            <table padding=3px id="mitabla" border="1" align="center">
                  <tr>
                   <td> 
                      <div align="justify">
                      A esta factura de venta aplican las normas relativas a la letra de cambio (artículo 5 ley 1231 de 2008). Con esta el comprador declara haber recibido real y materialmente las mercancías o prestación de servicios descritos en este artículo - valor. Número de autorización 18763000608631 aprobado en 20190923 prefijo VAPS desde el número 1 al 500 responsable de IVA- Actividad Económica 6209 Otras actividades de tecnologías de información Tarifa 19
                      </div>    
                  </td>
                      
                  </tr>
            </table>

<?php
require_once("../contabilidad/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ReciboDePago.pdf";
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>