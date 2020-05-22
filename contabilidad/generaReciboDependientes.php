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
    
     
     $numComprobante=0;
     $sqlA=mysql_query("SELECT max(idLiquida) as mayor FROM des_liquidar_contratos_dependientes");
     while($rowA=mysql_fetch_array($sqlA)) {
       $numComprobante= $rowA["mayor"];
     }
     $numComprobante++;
     $sqlL=mysql_query("SELECT * FROM des_liquidar_contratos_dependientes where idLiquida like '$idLiquida'");
     while($rowL = mysql_fetch_array($sqlL)){
         $periodoInicial=$rowL['periodoInicial'];
         $periodoFin=$rowL['periodoFin'];
         $fechaGen=$rowL['fechaRegistro'];
         $valorPagado=$rowL['valorPagado'];
         $idLiquida=$rowL['idLiquida'];
         $identidad=$rowL['idenCliente'];
         $idEmpleado=$rowL['idenEmpleado'];
         $idContrato=$rowL['idContrato'];
         $fechaRegistro=$rowL['fechaRegistro'];
         $usuarioLiquida=$rowL['usuarioLiquida'];
     }
     mysql_free_result($sqlL);

       
   
     $sql=mysql_query("SELECT * FROM des_contratos_empresas where numComprobante like '$idContrato'");
     while($row = mysql_fetch_array($sql)){
          $descripcionP=$row['descripcion'];
          $idPlan=$row['idPlan'];
          $fecha=$row['fecha'];
     }
     mysql_free_result($sql);

     //verifico el plan
     $sql=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan'");
     while($row = mysql_fetch_array($sql)){
          $descripcion=$row['descripcion'];
          $valor=$row['valor'];
      }
     mysql_free_result($sql);
       $diasT =(strtotime($periodoInicial)-strtotime($periodoFin))/86400;
       $diasT =abs($diasT); 
        $dias =floor($diasT);	
        $valorTotal=0;
        $valorTotal=($valor*$diasT)/30;
	
    $sqlCliente="SELECT empresa,dir_cliente FROM des_cliente WHERE cedula_cliente like '$identidad'";
    $res=mysql_query($sqlCliente);
    while($rowE=mysql_fetch_array($res)) {
          $nombreEmpresa = $rowE["empresa"];
          $dir = $rowE["dir_cliente"];
         
		}
    mysql_free_result($res);
    //recojo datos de empleado
    $sqlEmpleado="SELECT * FROM des_empleado WHERE cedula_empleado like '$idEmpleado'";
    echo $sqlEmpleado;
    $res=mysql_query($sqlEmpleado);
    while($rowE=mysql_fetch_array($res)) {
          $nombreEmpleado = $rowE["nombre"]." ".$rowE["apellido"];
          $cedulaEmpleado = $rowE["cedula_empleado"];
		}
		mysql_free_result($res);
    ?>
    <table id="mitabla" align="center">
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
                    <?php echo $periodoInicial." | ".$periodoFin;?>
                  </td>
                  <td colspan="2"><center>Pago Dependiente Judicial<br>
                   <?php
                      echo $nombreEmpleado." | C.C : ".$cedulaEmpleado;
                   ?>
                   </center>
                  </td>
                  </tr>
                <tr>
                  <td><span style="color:BLUE">Nombre Empresa</span><br>
                  <?php echo strtoupper($nombreEmpresa);?>
                 </td>
                  <td><span style="color:BLUE">Identificacion</span><br>
                    <?php echo $identidad;?>
                  </td>
                  <td><span style="color:BLUE">Dirección</span><br>
                    <?php echo $dir;?>
                  </td>
                </tr>
               
                
    </table>
         
           <table id="mitabla" align="center">
               <tr style="background=white; color:black">
               <td align="center">Plan Adquirido: <?php echo $descripcion."- Valor: $ ".number_format($valor);?></td>
                </tr>
               
          </table>
          <table id="mitabla" align="center">
          <tr><td style="background-color:#096075;color:#FFFFFF" align="center" colspan="2">Procesos Vigilados</td></tr>
              <tr>
                 <td><span style="color:BLUE">Radicado</span></td>
                 <td><span style="color:BLUE">Municipio</span></td>
              </tr>
              <?php
              $sqlProcesos="SELECT idRadicado,idJuzgado FROM des_procesos WHERE idCliente like '$identidad' and idContrato like '$idContrato'";
              $res=mysql_query($sqlProcesos);
                while($rowP=mysql_fetch_array($res)) {
                      $radicado = $rowP["idRadicado"];
                      $idJuzgado = $rowP["idJuzgado"];
                      $sql=mysql_query("SELECT ciudad FROM des_juzgados where idJuzgado like '$idJuzgado'");
                      while($row = mysql_fetch_array($sql)){
                        $idCiudad=$row['ciudad'];
                      }
                        $nombreCiudad="";
                        $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$idCiudad'");
                        while($rowC=mysql_fetch_array($sqlCiudad)) {
                          $nombreCiudad = $rowC["opcion"];
                        }
               ?>
              <tr>
                 <td><?php echo $radicado;?></td>
                 <td><?php echo strtoupper($nombreCiudad);?></td>
              </tr>
              <?php
                 }
                 mysql_free_result($res);
              ?>
          </table>
          
          <table id="mitabla" border="0" align="center">
             
                 <tr>
                      <td align="left" rowspan="3">
                        <span style="font-size:10px"></span>
                        <br><br><br><br>
                        Firma,________________________ 
                      </td>
                      <td style="background-color:#096075;color:#FFFFFF" align="right">SUB-TOTAL</td>
                      <td>
                          <?php 
                            echo "$ ".number_format("0");
                          ?>
                                  
                      </td>
               </tr>
               <tr>
                      <td style="background-color:#096075; color:#FFFFFF" align="right">I.V.A</td>
                      <td><?php echo "$ ".number_format("0");?></td>
               </tr>

               <tr>
                 <td style="background-color:#096075; color:#FFFFFF" align="right">TOTAL</td>
                 <td><?php echo "$ ".number_format(round(($valorPagado)));?></td>
               </tr>

          </table>
             <br>
             <table id="mitabla" border="0" align="center">
                  <tr align="left">
                      <td>Usuario que Registro: <?php echo $usuarioLiquida;?></td>
                      
                  </tr>
            </table>

<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ReciboDePagoDependiente.pdf";
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>