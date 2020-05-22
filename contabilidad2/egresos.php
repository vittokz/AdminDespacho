<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad="";
       $sql=mysql_query("SELECT tipo_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
		}
		mysql_free_result($sql);
		
	//verifico el idActuacion mayor para el numero de estado
  $numEstado=0;
  $sqlA=mysql_query("SELECT max(numComprobante) as mayor FROM des_pagos_mensuales");
  while($rowA=mysql_fetch_array($sqlA)) {
    $numEstado = $rowA["mayor"];
  }
  $numEstado++;
  mysql_free_result($sqlA);		
 
  if($tipoUsuario==1){

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Egresos viacpro::.</title>
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
<center> <div style="width:100%; height:15%; background:#003">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<img src="../../images/viacpro3.png" style="width:10%">
</span></center>
</div></center>
<div class="wrapper">

 <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
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
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
           <?php 
		       $mensaje ="";$remite="";$envia = "";
			   $sql="SELECT * FROM des_mensajes where usuarioRecibe like '$usuario' and estado like 'No Leido'";
			   $resul = mysql_query($sql);
			    $conMensaje=0;		
			    while($row=mysql_fetch_array($resul)) {
					$conMensaje ++;
				}
				mysql_free_result($resul);
			?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $conMensaje;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Mensajes</li>
             <?php
              $sql="SELECT * FROM des_mensajes where usuarioRecibe like '$usuario' and estado like 'No Leido' order by fechaRegistro DESC";
			   $resul = mysql_query($sql);
			    $conMensaje=0;		
			    while($row=mysql_fetch_array($resul)) {
					$remite = $row["usuarioRemite"];
					$mensaje = $row["mensaje"];
				
			   ?>
              <li><a href="../mensajes/mensajes.php"><i class="fa fa-users text-aqua"></i><?php echo $remite." : ".substr($mensaje, 0, 26)."";?></a></li>
              <?php
			  }
				mysql_free_result($resul);
			  ?>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
           <?php 
		       $temaAyuda ="";$estado="";$i=0;$problema = "";$fechaRegistro = "";$fechaRespuesta ="";$idCliente ="";
			   $sql="SELECT * FROM des_clientes_ayuda where estado like 'Pendiente' order by fechaRegistro ASC";
			   $resul = mysql_query($sql);
			    $con=0;		
			    while($row=mysql_fetch_array($resul)) {
					$con ++;
					$idAyuda = $row["idAyuda"];
					$idCliente = $row["idCliente"];
					$temaAyuda = $row["temaAyuda"];
				}
				mysql_free_result($resul);
			?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $con;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notificaciones Soporte Clientes</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
               <?php
                 $sql="SELECT * FROM des_clientes_ayuda where estado like 'Pendiente' order by fechaRegistro ASC";
                   $resul = mysql_query($sql);
                   while($row=mysql_fetch_array($resul)) {
                        $idAyuda = $row["idAyuda"];
                        $idCliente = $row["idCliente"];
                        $temaAyuda = $row["temaAyuda"];
                ?>
                   <li><a href="../soporte/soporte.php"><i class="fa fa-users text-aqua"></i> <?php echo $idAyuda." : ".$temaAyuda;?></a></li>
                <?php
				   }
				 ?>
                </ul>
              </li>
              <li class="footer"></li>
            </ul>
          </li>
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
                  <a href="../perfil/perfil.php" class="btn btn-default btn-flat">Perfil</a>
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
   
       
        <li>
          <a href="../perfil/perfil.php">
            <i class="fa fa fa-user"></i>
            <span>Perfil</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li class="treeview menu-open">
          <a href="">
            <i class="fa fa-th"></i> <span>Procesos</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="../empleados/empleado.php"><i class="fa fa-circle-o"></i> Empleados</a></li>
             <li ><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
             <li ><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>
             <li ><a href="../procesos/procesos.php"><i class="fa fa-circle-o"></i> Radicado</a></li>
          </ul>
        </li>
         <li>
          <a href="../documentos/documentos.php">
            <i class="fa fa-bar-chart"></i> <span>Documentos</span>
            <span class="pull-right-container">
             
            </span>
          </a>
   
        </li>
        <li>
          <a href="../reportes/reportes.php">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../soporte/soporte.php">
            <i class="fa fa-gavel"></i> <span>Soporte</span>
            <span class="pull-right-container">
             
            </span>
          </a>
          
        </li>
        
        <li class="active treeview menu-open">
          <a href="">
            <i class="fa fa-credit-card"></i> <span>Contabilidad</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../contabilidad/comprasygastos.php"><i class="fa fa-circle-o"></i>Compras/Gastos</a></li>
             <li><a href="../contabilidad/ingresos.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
             <li class="active"><a href="../contabilidad/egresos.php"><i class="fa fa-circle-o"></i> Egresos</a></li>
          </ul>
        </li>
         <li>
          <a href="../usuarios/usuarios.php">
            <i class="fa fa-user-o "></i> <span>Usuarios</span>
            <span class="pull-right-container">
            
            </span>
            
          </a>
        
        </li>
        
        <li>
          <a href="../usuariosClientes/usuarios.php">
            <i class="fa fa-user-md"></i> <span>Accesos Clientes</span>
            <span class="pull-right-container">
            
            </span>
            
          </a>
        
        </li>
        <li>
          <a href="../mensajes/mensajes.php">
            <i class="fa fa-mail-reply-all"></i> <span>Mensajes</span>
            <span class="pull-right-container">
            
            </span>
            
          </a>
        
        </li>
        
         <li class="header"></li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1>Contabilidad - Generación de Pagos Mensuales </h1><br>
        <div class="row">
         
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pago General</h3>
            </div>
            <form name="egresosNomina">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>N° de Comprobante</th>
                  <th><input type="number" class="form-control" id="numComprobante" value="<?php echo $numEstado;?>" disabled></th>
                  <th></th>
                  <th></th>
                </tr>  
                <tr>
                   <th colspan="4">PERIODO A PAGAR<th>
                </tr>
                <tr>
                  <th>Fecha Inicial</th>
                  <th><input type="date" class="form-control" id="fechaInicial" autofocus  require></th>  
                </tr>
                <tr>
                  <th>Fecha Final</th>
                  <th><input type="date" class="form-control" id="fechaFinal" require></th>       
                </tr>
               
                <tr>
                  <th>Descripción</th>
                  <th colspan="3"><input type="text" class="form-control" id="descripcion" required></th>
                  
                </tr>
                
              </table>   
              <div class="box-footer">
              <button title="Generar Pago" type="submit" class="btn btn-primary" onClick="enviarPagosNomina(); return false;">Generar Nomina</button>
             
                 </div>
             </div>
            </form>
            
          </div>
        </div>

        <!-- left column -->
        <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pago Individual</h3>
            </div>
            <form name="egresos">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>N° de Comprobante</th>
                  <th><input type="number" class="form-control" id="numComprobante" value="<?php echo $numEstado;?>" disabled></th>
                  <th></th>
                  <th></th>
                </tr>  
                <tr>
                   <th colspan="4">PERIODO A PAGAR<th>
                </tr>
                <tr>
                  <th>Fecha Inicial</th>
                  <th><input type="date" class="form-control" id="fechaInicial" autofocus  require></th>  
                  <th>Fecha Final</th>
                  <th><input type="date" class="form-control" id="fechaFinal" require></th>       
                </tr>
                <tr>
                  <th>Identidad</th>
                  <th><input onChange="buscarEmpleado(); return false;" type="text" class="form-control" id="identidad" placeholder="Identidad Empleado"></th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <th colspan="4">
                  <div style="background-color:#337DFF; font-size:16px; font-family:Verdana, Geneva, sans-serif; color:#FFF" id="mostrarNombre"></div>
                  </th>
                 
               </tr>
                <tr>
                  <th>Descripción</th>
                  <th colspan="3"><input type="text" class="form-control" id="descripcion" required></th>
                  
                </tr>
                
              </table>   
              <div class="box-footer">
                <button title="Generar Pago" type="submit" class="btn btn-primary" onClick="enviarDatosEgreso(); return false;">Generar</button>
                  </div>
             </div>
            </form>
           
            </div>
           </div> 
          </div> 
          <br>
            <div id="resultado">
            </div> 
              
          <br>
           <div class="box">
           <div class="box-body">
           <?php
           $sql="SELECT distinct (numComprobante),fechaPagada,fechaFinal,descripcion,valor FROM des_pagos_mensuales";
           $resul=mysql_query($sql);
		       $valorTotal=0;
                   
		   ?>
          <div class="table-responsive">
              <h3>Listado Pagos</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#003A75; color:#FFF;">
                  <th>Num Comprobante</th>
                  <th>Descripción</th>
                  <th>Imprimir</th>
                  <th>Imprimir Individual</th>
                </tr>
                </thead> 
                <tbody>
                <?php
                     while($row = mysql_fetch_array($resul)){
                      $numComprobante=$row['numComprobante'];
                      $identidad=$row['idDependiente'];
                      $descripcion=$row['descripcion'];
                      $fechaInicial=$row['fechaPagada'];
                      $fechaFinal=$row['fechaFinal'];
                     
                    ?>
                  <tr style="font-size:11px">
                  <th><?php echo $numComprobante;?></th>
                  <th><?php echo strtoupper($descripcion);?></th>
                 <th><a target="_blank" href="imprimirNomina.php?numComprobante=<?php echo $numComprobante;?>&fechaInicial=<?php echo $fechaInicial;?>&fechaFinal=<?php echo $fechaFinal;?>">imprimir</a></th>
                 <th><a target="_blank" href="imprimirNominaIndividual.php?numComprobante=<?php echo $numComprobante;?>">imprimir</a></th>
    
                </tr>
               <?php
               }
               ?>
                </tbody>
                <tfoot>
                <tr style="background:#003A75; color:#FFF">
                  <th>Num Comprobante</th>
                  <th>Descripción</th>
                  <th>Imprimir</th>
                  <th>Imprimir Individual</th>
                </tr>
                </tfoot>
              </table>
              </div>
               </div>
          </div> 


          


       </section>      
   </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Todos los derechos reservados
  </footer>

  <
  <div class="control-sidebar-bg"></div>
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
  else{
    echo "<script language='javascript'> 
             alert('Usuario no tiene acceso a usuarios...!!');
             location.href='../perfil/perfil.php' </script>";
    }?>
</body>
</html>
