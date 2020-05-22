<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidadCliente=$_GET["identidad"];
	   $idProceso=$_GET["idProceso"];
       $sql=mysql_query("SELECT tipo_usuario,cedula_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
        $tipoUsuario = $row["tipo_usuario"];
        $cc = $row["cedula_usuario"];
		}
		mysql_free_result($sql);
    
    $sql=mysql_query("SELECT * FROM des_empleado where cedula_empleado like '$cc'");
    while($row = mysql_fetch_array($sql)){
      $logo=$row['logo'];
    }
     
    if($logo==""){
      $logoImagen="../dist/img/avatar5.png";
     }
     else{
       $logoImagen="../perfil/imgLogos/".$identidad."/".$logo;
     }
     $sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidadCliente'");
     while($rowCliente=mysql_fetch_array($sqlCliente)) {
          $ban=1;
          $nombre = $rowCliente["nombre"];
          $apellido = $rowCliente["apellido"];
          $empresa = $rowCliente["empresa"];
          $cel = $rowCliente["celular"];
          $email = $rowCliente["email"];
          $municipio = $rowCliente["municipio"];
 }
 mysql_free_result($sqlCliente);
	    //recojo datos del proceso
		$sqlProceso=mysql_query("SELECT * FROM des_procesos WHERE idProceso like '$idProceso'");
		while($rowProceso=mysql_fetch_array($sqlProceso)) {
			$idRadicado = $rowProceso["idRadicado"];
			$idJuzgado = $rowProceso["idJuzgado"];
			$idTipoProceso = $rowProceso["idTipoProceso"];
			$demandado = $rowProceso["demandado"];
			$demandante = $rowProceso["demandante"];
			$descripcion = $rowProceso["descripcion"];
      $fechaProceso = $rowProceso["fechaProceso"];
      $tiempo = $rowProceso["tiempo"];
      $valor = $rowProceso["valor"]; 
      $iva = $rowProceso["iva"]; 
      $estadoProceso = $rowProceso["estado"]; 
		}
		mysql_free_result($sqlProceso);	
	
	    //verifico el idActuacion mayor para el numero de estado
		$numEstado=0;
		$sqlA=mysql_query("SELECT max(idActuacion) as mayor FROM des_actuaciones");
		while($rowA=mysql_fetch_array($sqlA)) {
			$numEstado = $rowA["mayor"];
		}
		$numEstado++;
		mysql_free_result($sqlA);	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Proceso Detallado::.</title>
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
<center> <div style="width:100%; height:15%; background-image:url('../img/FondoNuevo2.jpg')">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<br><img src="../img/viacproSombra.png" style="width:15%">
</span></center>
</div></center>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo" style="background-image:url('../img/azulOscuro.png')">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-family:Georgia, 'Times New Roman', Times, serif;font-size:16px; font-weight:800;">ABOGADOS</span>
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
          <img src="<?php echo $logoImagen;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuario;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
   
      
        
         <li>
         <?php
             if($tipoUsuario==4){
         ?>
          <a href="digitador.php">
          <?php
             }
             if($tipoUsuario==5){
          ?>
             <a href="digitadorTotal.php">
             <?php
             }
             ?>
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
        <h1> Procesos\Cliente </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
          
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
               <tr style="background:#E5E5E5">
                  <th>Identificación</th>
                  <th style="color:#069"><?php echo $identidadCliente;?></th>
                  <th>Nombre Completo</th>
                  <th style="color:#069"><?php echo $empresa;?></th>
                  <th>Municipio</th>
                  <th style="color:#069">
				     <?php 
					   $idCiudad=$municipio;
					   $nombreCiudad="";
					   $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$idCiudad'");
					   while($rowC=mysql_fetch_array($sqlCiudad)) {
							$nombreCiudad = $rowC["opcion"];
						}
					   echo $nombreCiudad;
					 ?>
                  </th>
                 
               </tr>
              </table> 
              <br>
              <form name="procesos">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Despacho</th>
                  <th>                 
                  <?php
		      			  $nomJuzgado="";
                  $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado' and estado like 'Activo' order by ciudad ");
                          while($rowJ=mysql_fetch_array($sqlJuzgado)) {
                              $nomJuzgado = $rowJ["nombre"];
                              $idJuzgado = $rowJ["idJuzgado"];
                          }
                  mysql_free_result($sqlProceso);
				         ?>
                      <?php echo strtoupper($nomJuzgado);?>
               
                  </th>
                  <th>Fecha de Proceso</th>
                 <th><?php echo $fechaProceso;?></th>
            
                  <th></th>
                  <th colspan="2"></th>
                   
               </tr>
               <tr>
                  <th>Demandante</th>
                  <th><?php echo $demandante;?></th>
                  <th>Demandado</th>
                  <th> <?php echo $demandado;?></th>
                   </tr>
                
                  
             </table>   
              <div class="box-footer">
               <?php
			  
            if($estadoProceso=="Cerrado")
             {
               echo "
                 <div align=center style='margin:5px;background:RED; font-size=22px; color:white; font-weight: bold'>PROCESO CERRADO</div>
               ";

             }
			   ?>
              
              </div>
             </div>
            </form>
              <div id="resultado">
				 
               </div>
            </div>

            </div>
           </div> 
          </div> 
          <br>
           <div class="box">
           <div class="box-body">
             
               <div class="box">
           <div class="box-body">
           <?php
		       $sqlD="SELECT idEmpleado FROM des_asignacion_procesos where idProceso like '$idProceso' and estado like 'Activo' order by fechaRegistro DESC";
		       $resulD=mysql_query($sqlD) or die ("Error en consulta de dependientes");
		       ?>
          <div class="table-responsive">
             <h3>Dependientes Asignados</h3>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr style="background:#1d1a31; color:#FFF">
                  <th>Identidad</th>
                  <th>Nombre</th>
                  <th>Celular</th>
                  <th>Municipio</th>
                </tr>
                </thead> 
                <tbody>
                <?php
                   while($rowD = mysql_fetch_array($resulD)){
                      $idEmpleado=$rowD['idEmpleado'];
                        $sqlEM="SELECT * FROM des_empleado where id_empleado like '$idEmpleado' and estado like 'Activo' order by fechaRegistro DESC";
                        $resulEM=mysql_query($sqlEM) or die ("Error en consulta de dependientes");  
                           while($rowEM = mysql_fetch_array($resulEM)){
                            $cedulaEmp=$rowEM['cedula_empleado'];
                            $celularEmp=$rowEM['celular'];
                            $emailEmp=$rowEM['email'];
                            $nomEmp=$rowEM['nombre']." ".$rowEM['apellido'];
                  ?>
                         <tr style="font-size:12px">
                          <th align="right"><?php echo $cedulaEmp;?></th>
                          <th><?php echo strtoupper($nomEmp);?></th>
                          <th><?php echo $celularEmp;?></th>
                          <th><?php echo "";?></th>
                        </tr>
                    <?php
                           }
                          }
                    ?>
                </tbody>
                <tfoot>
                <tr style="background:#1d1a31; color:#FFF">
                    <th>Identidad</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Municipio</th>
                </tr>
                </tfoot>
            </table>
        </div> 
           
           
           
           <?php
		       $sql="SELECT * FROM des_actuaciones where idProceso like '$idProceso' and tipo like 'estados' and estado like 'Activo' order by fechaRegistro DESC";
           
           $resul=mysql_query($sql) or die ("No hay datos");
		   ?>
        
        <div class="table-responsive">
             <h3>Listado de Estados</h3>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr style="background:#1d1a31; color:#FFF">
                  <th>N° de Estado</th>
                 
                  <th>Descripción Actuación</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Hora</th>
                  <th>Foto</th>
               
                </tr>
                </thead> 
                <tbody>
                 <?php
                      $idActuacion="";
                      while($row = mysql_fetch_array($resul)){
                        $idActuacion=$row['numEstado'];
                        $nombreArchivo=$row['nombreArchivo'];
			          	?>
                <tr style="font-size:12px">
                  <th align="right"><?php echo $idActuacion;?></th>
                  
                  <th><?php echo $row['actuacion'];?></th>
                  <th><?php echo $row['fechaAuto'];?></th>
                  <th><?php echo $row['fechaInicio'];?></th>
                  <th><?php echo $row['fechaFin'];?></th>
                  <th><?php echo $row['hora'];?></th>
                  <th align="right"><a href="../procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $nombreArchivo;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=330pt,top=50pt,width=700px,height=550px'); return false;">
                 <img  src='../img/ver.png' width='32' height='26' title="Ver archivo"></a>
                    </th>
                 <th>
                 
				  
                  </th>
                </tr>
        	<?php
				 }
				 mysql_free_result($resul);
			?>
                </tbody>
                <tfoot>
                <tr style="background:#1d1a31; color:#FFF">
       		      <th>N° de Estado</th>
                  
                  <th>Descripción Actuación</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Hora</th>
                  <th>Foto</th>
           
                </tr>
                </tfoot>
              </table>
              <br><br>
              <?php
		       $sql="SELECT * FROM des_actuaciones where idProceso like '$idProceso' and tipo like 'fijacionlista' and estado like 'Activo' order by fechaRegistro DESC";
		       $resul=mysql_query($sql) or die ("No hay datos");
		      ?>
              <h3>Listado Fijación en Lista</h3>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr style="background:#1d1a31; color:#FFF">
                  <th>N° Fijación en lista</th>
                   <th>Asunto</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Foto</th>
                  
                </tr>
                </thead> 
                <tbody>
                 <?php
				 $idActuacion="";
				 while($row = mysql_fetch_array($resul)){
					$idActuacion=$row['numEstado'];
					$nombreArchivo=$row['nombreArchivo'];
				?>
                <tr style="font-size:12px">
                  <th align="right"><?php echo $idActuacion;?></th>
                    <th><?php echo $row['actuacion'];?></th>
                  <th><?php echo $row['fechaAuto'];?></th>
                  <th><?php echo $row['fechaInicio'];?></th>
                  <th><?php echo $row['fechaFin'];?></th>
                  <th align="right"><a href="../procesos/imgProcesos/proceso<?php echo $idProceso;?>/actuaciones/<?php echo $nombreArchivo;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=330pt,top=50pt,width=700px,height=550px'); return false;">
                 <img  src='../img/ver.png' width='32' height='26' title="Ver archivo"></a>
                    </th>
                 <th>
                 <?php
				 }
				 mysql_free_result($resul);
			?>  
                </tbody>
                <tfoot>
                <tr style="background:#1d1a31; color:#FFF">
       		      <th>N° Fijación en lista</th>
                  <th>Asunto</th>
                  <th>Fecha Auto</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Foto</th>
             
                </tr>
                </tfoot>
              </table>
              <br><br>
              <?php
		       $sql="SELECT * FROM des_audiosvideos where idProceso like '$idProceso' and estado like 'Activo' order by fechaRegistro DESC";
		       $resul=mysql_query($sql) or die ("No hay datos");
		   ?>
               <h3>Listado de Audios/Videos</h3>
              <table id="example1" class="table table-bordered table-striped">
             
                <thead>
                <tr style="background:#1d1a31; color:#FFF">
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Nombre Archivo</th>
                  <th>Ver</th>
                 
                </tr>
                </thead> 
                <tbody>
                 <?php
				 $id="";
				 while($row = mysql_fetch_array($resul)){
					$id=$row['id'];
					$nombreArchivo=$row['nombreArchivo'];
				?>
                <tr style="font-size:12px">
                  <th><?php echo $row['fecha'];?></th>
                  <th><?php echo $row['tipo'];?></th>
                  <th><?php echo $row['detalle'];?></th>
                  <th><?php echo $row['nombreArchivo'];?></th>
                  <th align="right"><a href="../procesos/imgProcesos/proceso<?php echo $idProceso;?>/multimedia/<?php echo $nombreArchivo;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=330pt,top=50pt,width=700px,height=550px'); return false;">
                 <img  src='../img/ver.png' width='32' height='26' title="Ver archivo"></a>
                    </th>
               
       
        	<?php
				 }
				 mysql_free_result($resul);
			?>
                </tbody>
                <tfoot>
                <tr style="background:#1d1a31; color:#FFF">
       		      <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Nombre Archivo</th>
                  <th>Ver</th>
                 
                </tr>
                </tfoot>
              </table>
            </div>
           </div> 
        </div>

          </div>     
          </div>
          </div>        
       </section>      
   </div>
  <!-- /.content-wrapper -->
 
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<footer style="background-image:url('../img/FondoNuevo.jpg')">
  <center><img src="../img/viacpro.png"></center>
  </footer>
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