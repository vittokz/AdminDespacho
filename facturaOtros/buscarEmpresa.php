<?php require_once("../seguridad/seguridad.php");
    require_once ('../conexion.php');
   if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
     $identidad=$_POST['identidad'];
     
       	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Buscar Empresa::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">


 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <div class="box">
   <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr align="center" style="background:#1d1a31; color:#FFF">
                  <th><center>Tipo de Plan</center></th>
                  <th><center>Municipio</center></th>
                  <th><center>Valor</center></th>
                  <th><center>Crear</center></th>
                  <th><center>Cuenta de Cobro</center></th>
                  <th><center>Generar Factura</center></th>
                  <th><center>Enviar Factura</center></th>
                </tr>
             <?php
              $sql="select * from des_contratos_empresas where identidad like '$identidad' and estado like 'Activo'";
              $resul = mysql_query($sql) or die('<center><font color="red">Error al realizar la busqueda identidad!!!..</font></center>');
              while($row=mysql_fetch_array($resul)) {
                    $id =$row["id"];
                    $idPlan =$row["idPlan"];
                    $municipio =$row["municipio"];
                    $nombreCiudad="";
                    $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
                      while($rowC=mysql_fetch_array($sqlCiudad)) {
                      $nombreCiudad = $rowC["opcion"];
                    }

                      $sqlPlan=mysql_query("select * from des_planes where idPlan like '$idPlan'");
                        while($rowP=mysql_fetch_array($sqlPlan)) {
                          $nombrePlan =$rowP["nombrePlan"];
                          $valorPlan =$rowP["valor"];
                        }
                    $sqlLiq=mysql_query("SELECT * FROM des_liquidar_contratos where idContrato like '$id' order by idLiquida desc limit 1");
                    $numContratos = mysql_num_rows($sqlLiq);
                    $estadoLiquida="";
                    $estadoEnvio="";

                    if($numContratos>0){
                          $texto="Imprimir";
                          while($rowL = mysql_fetch_array($sqlLiq)){
                              $idLiquida=$rowL['idLiquida'];
                              $estadoEnvio =$rowL["estadoEnvio"];
                              $estadoLiquida =$rowL["estadoLiquida"];
                          }
                  ?>
                        <tr>
                          <td><?php echo $nombrePlan;?></td>
                          <td><?php echo $nombreCiudad;?></td>
                          <td><?php echo number_format($valorPlan);?></td>
                          <td style="font-size:16px"><center><a title="Crear cuenta de cobro" href="cuentadeCobro.php?iden=<?php echo $identidad;?>&id=<?php echo $id;?>">
                          Crear</a></center></td>
                          <td style="font-size:16px"><center><a title="Imprimir cuenta de cobro" target="_blank" href="generaReciboEmpresa.php?idLiquida=<?php echo $idLiquida;?>">
                          <?php 
                              if($estadoLiquida=="Cuenta de Cobro"){
                                echo "<font color='RED'>Imprimir</font>";
                              }
                              else{
                                echo "-";
                              }
                          ?></a></center></td>
                          <td style="font-size:16px"><center><a title="Generar Factura" target="_blank" href="creaFactura.php?idLiquida=<?php echo $idLiquida;?>">
                          <?php 
                              if($estadoLiquida=="Cuenta de Cobro"){
                                echo "<font color='RED'>Pendiente Generar</font>";
                              }
                              else{
                                echo "-";
                              }
                          ?>
                          </a></center></td>
                          <td style="font-size:16px"><center><a title="Enviar Factura a cliente" target="_blank" href="enviarFactura.php?idLiquida=<?php echo $idLiquida;?>&idCliente=<?php echo $identidad;?>">
                          <?php 
                              if($estadoEnvio=="Pendiente"){
                                echo "<font color='RED'>Pendiente</font>";
                              }
                              else{
                                echo "Generar";
                              }
                          ?>
                          </a></center></td>
                        </tr>
             <?php
                    }
                 
                  else{
             ?>       
                 <tr>
                          <td><?php echo $nombrePlan;?></td>
                          <td><?php echo $nombreCiudad;?></td>
                          <td><?php echo number_format($valorPlan);?></td>
                          <td style="font-size:16px"><center><a title="Crear cuenta de cobro" href="cuentadeCobro.php?iden=<?php echo $identidad;?>&id=<?php echo $id;?>">
                          Crear</a></center></td>
                          <td style="font-size:16px"><center>-</center></td>
                          <td style="font-size:16px"><center>-</center></td>
                          <td style="font-size:16px"><center>-</center></td>
                        </tr>
             <?php
                  }      
              }
        		mysql_free_result($resul);
             ?>
              </table>
            </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


</body>
</html>
