<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	     $identidad="";
       $sql=mysql_query("SELECT tipo_usuario,cedula_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
            $tipoUsuario = $row["tipo_usuario"];
            $identidad = $row["cedula_usuario"];
       }
    
       mysql_free_result($sql);
       //busco idEmpleado
       $sql="SELECT id_empleado FROM des_empleado WHERE cedula_empleado like '$identidad'";
       $resul=mysql_query($sql);
           while($row=mysql_fetch_array($resul)) {
            $idEmpleado = $row["id_empleado"];
           
       }
    
       mysql_free_result($sql);
       

  if($tipoUsuario==4){
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Digitadores::.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
    <link rel="shortcut icon" href="../img/icono.ico">
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
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<center> <div style="width:100%; height:15%; background:#003">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<img src="../../images/viacpro3.png" style="width:10%">
</span></center>
</div></center>
<div class="wrapper">

 <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">ABOGADOS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      <span style="font-size:16px; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIACPRO </span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
    
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                
                  <small> <?php echo $usuario;?></small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../seguridad/cerrar.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
   
      
        
         <li class="active">
          <a href="">
            <i class="fa fa-bar-chart"></i> <span>Procesos</span>
            <span class="pull-right-container">
             
            </span>
          </a>
   
        </li>
        
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <section class="content-header" style="width:100%">
            <h1>Subir Documentos De Procesos</h1><br>
              <div class="row">
                <div class="col-md-12">
                <div class="box box-primary">    
                <div class="box">
                   <div class="box-body">
                    <?php
                    
                    $totalPagos=0;
                    $totalIva=0;$totalValor=0;
                    $sql="SELECT idProceso FROM des_asignacion_procesos where idEmpleado like '$idEmpleado'";
                    $resul=mysql_query($sql);
                   
                ?>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr align="center" style="background:#003A75; color:#FFF; font-size:12px">
                              <th><center>Radicado</center></th>
                              <th><center>Juzgado</center></th>
                              <th><center>Fecha Proceso</center></th>
                              <th><center>Ver</center></th>
                              <th><center>Estados</center></th>
                              <th><center>Fijación en Lista</center></th>
                              <th><center>Audios/Videos</center></th>
                            
                            </tr>
                          </thead> 
                          

                      <tbody>
                           
                                  <?php
                                        $total =0;$registros=0;
                                          while($row = mysql_fetch_array($resul)){
                                              $idProceso=$row['idProceso'];
                                              $sqlP=mysql_query("SELECT * FROM des_procesos where idProceso like '$idProceso' order by fechaProceso DESC");
                                            
                                              $total =0;
                                              while($rowP = mysql_fetch_array($sqlP)){
                                                    $registros=$registros+1;
                                                    $idProceso=$rowP['idProceso'];
                                                    $idRad=$rowP['idRadicado'];
                                                    $idJuz=$rowP['idJuzgado'];
                                                    $iva = $rowP["iva"];
                                                    $valor = $rowP["valor"];
                                                    $total = $rowP["total"];
                                                    $totalIva = $totalIva + $rowP["iva"];
                                                    $totalValor = $totalValor +  $rowP["valor"];
                                      ?>
                                        <tr style="font-size:12px">
                                              <th><?php echo $rowP["idRadicado"];?></th>
                                                <th>     <?php 
                                                            $nomJuzgado="";
                                                            $sqlJuzgado=mysql_query("SELECT nombre FROM des_juzgados where idJuzgado like '$idJuz'");
                                                            while($rowJ=mysql_fetch_array($sqlJuzgado)) {
                                                                  $nomJuzgado = $rowJ["nombre"];
                                                                }
                                                            echo strtoupper($nomJuzgado);
                                                        ?>
                                            
                                                </th>
                                                <th><center><?php echo $rowP["fechaProceso"];?></center></th>
                                              <th><center><a href="procesoSeleccionado.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                              <img  src="../img/ver.png" width="35" height="22" title="Ver detalle de proceso"></a></center></th>

                                            <th><a href="../procesos/subirActuacion.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRad;?>"target="popup"
            onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                              <img  src="../img/subir.png" width="28" height="25" title="Subir Actuacion">SUBIR</a></th>


                              <th><a href="../procesos/fijacionLista.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRad;?>"target="popup"
            onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                              <img  src="../img/subir.png" width="28" height="25" title="Subir Fijación en lista">SUBIR</a></th>
                            
                            
                              <th><a href="../procesos/subirArchivo.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRad;?>"target="popup"
            onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=960px,height=480px'); return false;">
                              <img  src='../img/subir.png' width='28' height='20' title='Ver multimedia'>SUBIR</a></th>
                                              
                                         </tr>
                                          
                                              <?php }?>
                                  <?php }?>
                         
                      </tbody>





                        
                          
                        
                        
                          <tfoot>
                          <tr  style="background:#003A75; color:#FFF; font-size:12px">
                              <th><center>Radicado</center></th>
                              <th><center>Juzgado</center></th>
                              <th><center>Fecha Proceso</center></th>
                              <th><center>Ver</center></th>
                              <th><center>Estados</center></th>
                              <th><center>Fijación en Lista</center></th>
                              <th><center>Audios/Videos</center></th>
                            
                          </tr>
                          </tfoot>
                          
                        
                          
                        </table>
                        </div>
                        </div>
                    </div>


              </div>
              </div><!-- /.row --> 
            </div>
          </section> 
           <div id="resultado" style="width:100%">
            
          </div>      
   </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>

  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
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
<?php
  }
?>
</body>
</html>
