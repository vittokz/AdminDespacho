<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
	
	   $idPlan=$_GET["idPlan"];
     $identidad=$_GET["identidad"];
     $fecha=$_GET["fecha"];
     $empleado=$_GET["empleado"];
     $nombreEmpleado=$_GET["nombre"];
     $idContrato=$_GET["idContrato"];
     date_default_timezone_set('America/Bogota');
     $hoy = date("Y-m-d");
	   
	    $sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysql_fetch_array($sqlCliente)) {
          $nombre = $rowCliente["nombre"];
          $apellido = $rowCliente["apellido"];
          $municipio = $rowCliente["municipio"];
          $empresa = $rowCliente["empresa"];
          $email = $rowCliente["email"];
		   }
		   mysql_free_result($sqlCliente);
		
		   $sqlP=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan' and estado like 'Activo'");
                          while($rowP = mysql_fetch_array($sqlP)){
                              $descripcion=$rowP['descripcion'];
                              $valor=$rowP['valor'];

                          }
                          mysql_free_result($sqlP);
      
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Liquidar pagos dependiente::.</title>
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
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="shortcut icon" href="../img/icono.ico"> 
  
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
<script type="text/javascript" src="select_dependientes.js"></script>
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h3 style="background-color:RED; color:WHITE"> PAGAR A - <?php echo $nombreEmpleado;?></h3><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
               <tr>
                 <th colspan="4">Empresa por la que se le cancela al dependiente.</th>
               </tr>
               <tr>
                  <th>Identidad Cliente</th>
                  <th style="color:#069"><?php echo $identidad;?></th>
                  <th>Nombre Empresa</th>
                  <th style="color:#069"><?php echo strtoupper($empresa);?></th>
               </tr>
               <tr>
                  <th>Email</th>
                  <th style="color:#069"><?php echo $email;?></th>
                  <th>Plan</th>
                  <th style="color:#069"><?php echo strtoupper($descripcion);?></th>
               </tr>
               <tr>
                  <th>Valor Plan</th>
                  <th style="color:#069">$ <?php echo number_format($valor);?></th>
                  <th>Fecha Aquirido</th>
                  <th style="color:#069"><?php echo $fecha;?></th>
               </tr>
              </table>
           </div>
          <!-- general form elements -->
          <div class="box box-primary">
                    
            <div class="box-body table-responsive no-padding">
            <div class="box-body table-responsive no-padding">
               <div id="resultado">
            
               </div>   
            <table class="table table-hover">
               <h3>Pagar</h3>
              
              <?php
                  
                // if($numContratos<=0){
                  $sqlLiq=mysql_query("SELECT * FROM des_liquidar_contratos_dependientes where idContrato like '$idContrato' order by idLiquida desc limit 1");
                  $numContratos = mysql_num_rows($sqlLiq);
                   if($numContratos>0){

                  ?>
                     <tr style="background-color:#098cc1; color:#ffffff">
                          <th>Fecha Inicial</th>
                          <th>Fecha Final</th>
                          <th>Generar</th>
                     </tr>

                  <?php
                        while($rowL = mysql_fetch_array($sqlLiq)){
                              $periodoInicial=$rowL['periodoInicial'];
                              $periodoFin=$rowL['periodoFin'];
                              $fechaGen=$rowL['fechaGen'];
                                
                          
                ?>                  <form name="pagar" id="pagar">       
                                      <tr>
                                          <th><?php echo $periodoFin;?></th>
                                          <th>
                                              
                                              <input type="date" class="form-control" id="fechaFin" required autofocus>
                                              <input type="hidden" class="form-control" id="fechaInicial" value="<?php echo $periodoFin;?>">
                                              <input type="hidden" class="form-control" id="idContrato" value="<?php echo $idContrato;?>">
                                              <input type="hidden" class="form-control" id="idCliente" value="<?php echo $identidad;?>">
                                              <input type="hidden" class="form-control" id="valorPlan" value="<?php echo $valor;?>">
                                              <input type="hidden" class="form-control" id="empleado" value="<?php echo $empleado;?>">
                                               <input type="hidden" class="form-control" id="idPlan" value="<?php echo $idPlan;?>">
                                          </th>
                                          
                                          <th><button type="submit" class="btn btn-primary" onClick="liquidarDependiente(); return false;">Pagar</button></th>
                                      </tr>
                                    </form>
                  <?php
                    }
                    mysql_free_result($sqlL);
                 }
                 else {
                 ?>
                                    <tr style="background-color:#098cc1; color:#ffffff">
                                          <th>Fecha Inicial</th>
                                          <th>Fecha Final</th>
                                          <th>Generar</th>
                                    </tr> 
                                    <form name="pagar" id="pagar">       
                                      <tr>
                                          <th><?php echo $fecha;?></th>
                                          <th>
                                              
                                              <input type="date" class="form-control" id="fechaFin" required autofocus>
                                              <input type="hidden" class="form-control" id="fechaInicial" value="<?php echo $fecha;?>">
                                              <input type="hidden" class="form-control" id="idContrato" value="<?php echo $idContrato;?>">
                                              <input type="hidden" class="form-control" id="idCliente" value="<?php echo $identidad;?>">
                                              <input type="hidden" class="form-control" id="valorPlan" value="<?php echo $valor;?>">
                                              <input type="hidden" class="form-control" id="empleado" value="<?php echo $empleado;?>">
                                              <input type="hidden" class="form-control" id="idPlan" value="<?php echo $idPlan;?>">
                                          </th>
                                          
                                          <th><button type="submit" class="btn btn-primary" onClick="liquidarDependiente(); return false;">Pagar</button></th>
                                      </tr>
                                    </form>

                 <?php


                 }
                  ?>


              </table> 
             
             <hr>
             <table class="table table-hover">
               <h3>Pagos realizados</h3>
              <tr style="background-color:#098cc1; color:#ffffff">
                    <th>Periodo Pagado</th>
                    <th>Dias Pagados</th>
                    <th>Valor a pagar</th>
                    <th>Recibo Empleado</th>
                   <!-- <th>Otros</th>-->
              </tr>

              <?php
                 $sqlL=mysql_query("SELECT * FROM des_liquidar_contratos_dependientes where idContrato like '$idContrato' and estadoLiquida like 'Pagado' order by fechaRegistro DESC");
                 while($rowL = mysql_fetch_array($sqlL)){
                     $periodoInicial=$rowL['periodoInicial'];
                     $periodoFin=$rowL['periodoFin'];
                     $fechaGen=$rowL['fechaRegistro'];
                     $valor=$rowL['valorPagado'];
                     $idLiquida=$rowL['idLiquida'];
               ?>
                      <tr>
                      
                          <th><?php echo $periodoInicial." a ".$periodoFin;?></th>
                          <th>
                            <?php 
                                $diasT	= (strtotime($periodoInicial)-strtotime($periodoFin))/86400;
                                $diasT 	= abs($diasT); 
                                $dias = floor($diasT);	
                                echo $dias;
                              ?>
                          </th>
                          <th>
                              <?php 
                                echo "$ ".number_format(round($valor));
                              ?>
                          </th>
                          <th><a href="generaReciboDependientes.php?idLiquida=<?php echo $idLiquida;?>" class="btn btn-primary">Imprimir</button></th>
                       <!--   <th><a href="generaReciboGerentes.php?idLiquida=<?php echo $idLiquida;?>" class="btn btn-primary"></button></th>-->
                      </tr>
                  <?php
                    }
                    mysql_free_result($sqlL);

                  ?>


              </table> 
              </div>
            
             
              <br>
              
            </div>

            </div>
           </div> 
          </div> 
          
           
               </div>
          </div>     
            </div>
          </div>        
       </section>      



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
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>