<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $idJuzgado=$_GET["idJuzgado"];
	   
	
	   
       $sql=mysql_query("SELECT tipo_usuario,cedula_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
      $tipoUsuario = $row["tipo_usuario"];
      $cedula = $row["cedula_usuario"];
		}
		mysql_free_result($sql);
    
    $sql=mysql_query("SELECT * FROM des_empleado where cedula_empleado like '$cedula'");
    while($row = mysql_fetch_array($sql)){
      $logo=$row['logo'];
    }
     
    if($logo==""){
      $logoImagen="../dist/img/avatar5.png";
     }
     else{
       $logoImagen="../perfil/imgLogos/".$cedula."/".$logo;
     }
		

		$nombreJuz="";
		$sqlJuzgado=mysql_query("SELECT * FROM des_juzgados WHERE idJuzgado like '$idJuzgado' and estado like 'Activo'");
        while($rowJuzgado=mysql_fetch_array($sqlJuzgado)) {
			$nombreJuz = $rowJuzgado["nombre"];
			$ciudadJuz = $rowJuzgado["ciudad"];
		}
		mysql_free_result($sqlJuzgado);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Procesos por juzgado::.</title>
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
  <link rel="shortcut icon" href="../img/icono.ico">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  
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
<center> <div style="width:100%; height:15%; background-image:url('../img/FondoNuevo2.jpg')">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<br><img src="../img/viacproSombra.png" style="width:15%">
</span></center>
</div></center>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo" style="background-image:url('../img/azulOscuro.png')">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">ABOGADOS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-image:url('../img/azulOscuro.png')">
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
              <img src="<?php echo $logoImagen;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $logoImagen;?>" class="img-circle" alt="User Image">

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
          <img src="<?php echo $logoImagen;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
     
      <?php
            include("../menuGerentes/menuViacpro.php");
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1>Juzgados\Procesos</h1><br>
        <div class="row">
          <!-- left column -->
           <div class="col-md-12">
             <!-- general form elements -->
                  <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                          <tr style="background:#E5E5E5">
                              <th>Nombre del Juzgado</th>
                              <th style="color:#069"><?php echo $nombreJuz;?></th>
                              <th>Municipio</th>
                              <th style="color:#069">
                        <?php 
                        $nombreCiudad="";
                        $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$ciudadJuz'");
                        while($rowC=mysql_fetch_array($sqlCiudad)) {
                          $nombreCiudad = $rowC["opcion"];
                        }
                        echo $nombreCiudad;
                      ?>
                              </th>
                          </tr>
                          </table>
                    </div>
          <br><br>			  
        
          <div class="box">
           <div class="box-body">
           <?php
		     $demandante="";$demandado ="";$idTipoProceso ="";$idRadicado ="";$etapa="";
				$sqlProceso=mysql_query("SELECT * FROM des_procesos WHERE idJuzgado like '$idJuzgado' order by fechaProceso DESC");
		   
		   ?>
                  <div class="table-responsive">
                      <h3>Procesos Asignados al Juzgado</h3>
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr style="background:#1d1a31; color:#FFF;font-size:12px">
                            <th>Radicado</th>
                            <th>Juzgado</th>
                            <th>Municipio</th>
                            <th>Departamento</th>
                            <th>Clase de Proceso</th>
                            <th>Demandado</th>
                            <th>Demandante</th>
                            <th>Procesos</th>
                            <th>Estados</th>
                            <td align="center">Fijación en Lista</td>
                            <th>Audios/Videos</th>
                            <th>Eliminar</th>
                          </tr>
                          </thead> 
                          <tbody>
                          <?php
                  while($rowProceso=mysql_fetch_array($sqlProceso)) {
                      $idProceso = $rowProceso["idProceso"];
                    $idRadicado = $rowProceso["idRadicado"];
                    $identidad = $rowProceso["idCliente"];
                    $idJuzgado = $rowProceso["idJuzgado"];
                    $idTipoProceso = $rowProceso["idTipoProceso"];
                    $demandado = $rowProceso["demandado"];
                    $demandante = $rowProceso["demandante"];
                    $fechaProceso = $rowProceso["fechaProceso"];
                  ?>
                            <tr style="font-size:11px">
                            <td><?php echo $idRadicado;?></td>
                            <td>
                        <?php 
                      $nomJuzgado="";$municipio="";
                      $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado'");
                      while($rowC=mysql_fetch_array($sqlJuzgado)) {
                        $nomJuzgado = $rowC["nombre"];
                        $municipio  = $rowC["ciudad"];
                          $sqlM="select opcion,relacion from lista_estados where id like '$municipio'";
                                              $resM=mysql_query($sqlM);
                                                $nomCiudad="";$depar="";
                                      
                                              while($rowM=mysql_fetch_assoc($resM)){
                                                  $nomCiudad= $rowM["opcion"]; 
                              $relacion= $rowM["relacion"]; 
                              
                              $sqlR="select opcion from lista_paises where id like '$relacion'";
                              $resRe=mysql_query($sqlR);
                              
                                while($rowRe=mysql_fetch_assoc($resRe)){
                                $depar= $rowRe["opcion"]; 
                                }
                            }
                        
                      }
                      echo strtoupper($nomJuzgado);
                      
                      
                      ?>
                                
                            </td>
                            <td><?php echo strtoupper($nomCiudad);?></td>
                            <td><?php echo strtoupper($depar);?></td>
                            <td><?php echo strtoupper($idTipoProceso);?></td>
                            <td><?php echo strtoupper($demandado);?></td>
                            <td><?php echo strtoupper($demandante);?></td>
                            <td><a href="procesoSeleccionado.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                            <img  src='../img/ver.png' width='35' height='22' title="Ver detalle de proceso"></a></td>
                            <th><a href="subirActuacion.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>"target="popup"
          onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                            <img  src='../img/subir.png' width='28' height='25' title="Subir Actuacion">SUBIR</a></th>
                            
                            <th><a href="fijacionLista.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>"target="popup"
          onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                            <img  src='../img/subir.png' width='28' height='25' title="Subir Fijación en lista">SUBIR</a></th>
                            
                            <th><a href="subirArchivo.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>"target="popup"
          onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=380px'); return false;">
                            <img  src='../img/subir.png' width='28' height='25' title="Subir multimedia">SUBIR</a></th>
                          <?php
                    if($tipoUsuario==1){
                    ?>  
                          <td><a href="eliminarProceso.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                            <img  src='../img/borrar.png' width='28' height='25' title="Eliminar Proceso"></a></td>
                          <?php
                    }
                    else{
                  ?>
                            <td><img  src='../img/borrar.png' width='28' height='32' title="Eliminar Proceso"></td>
                          
                          <?php
                    }
                  ?>
                          </tr>
                        <?php
                  }
                  ?> 
                          </tbody>
                          <tfoot>
                          <tr style="background:#1d1a31; color:#FFF;font-size:12px">
                            <th>Radicado</th>
                            <th>Juzgado</th>
                            <th>Municipio</th>
                            <th>Departamento</th>
                            <th>Clase de Proceso</th>
                            <th>Demandado</th>
                            <th>Demandante</th>
                            <th>Procesos</th>
                            <th>Estados</th>
                            <th>Fijación en Lista</th>
                            <th>Audios/Videos</th>
                            <th>Eliminar</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div><!-- div resposive-->
               </div><!-- div box-->
          </div>   <!-- div box-->    
          </div><!-- div box-->
          </div>   <!-- div box-->         
       </section> 
          
   </div>
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<footer style="background-image:url('../img/FondoNuevo.jpg')">
  <center><img src="../img/viacpro.png"></center>
  </footer>
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

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
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
