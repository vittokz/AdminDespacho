<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad=$_GET["identidad"];
	   $idProceso=$_GET["idProceso"];
       $sql=mysql_query("SELECT tipo_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
		}
		mysql_free_result($sql);
		
		$nombre="";$apellido ="";$tel ="";$cel ="";$email ="";$ban=0;$municipio="";
		$sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysql_fetch_array($sqlCliente)) {
			$ban=1;
			$nombre = $rowCliente["nombre"];
			$apellido = $rowCliente["apellido"];
			$tel = $rowCliente["telefono"];
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
             <li ><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
             <li ><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>
             <li class="active"><a href="../procesos/procesos.php"><i class="fa fa-circle-o"></i> Procesos</a></li>
          </ul>
        </li>
        <li class="active">
          <a href="../actuaciones/actuaciones.php">
            <i class="fa fa-newspaper-o"></i>
            <span>Actuaciones</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li>
        <li>
          <a href="../audiencias/audiencias.php">
            <i class="fa fa-video-camera"></i>
            <span>Videos Audicencias</span>
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
        <li>
          <a href="../usuarios/usuarios.php">
            <i class="fa fa-user-o "></i> <span>Usuarios</span>
            <span class="pull-right-container">
            
            </span>
            
          </a>
        
        </li>
        <li>
          <a href="../usuariosClientes/usuarios.php">
            <i class="fa fa-user-md"></i> <span>Usuarios Clientes</span>
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
        <h1> <a href="actuaciones.php">
        <img  src='../img/atras.png' width='38' height='35' title="Volver a lista de procesos"></a>Actuaciones\Proceso </h1><br>
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
                  <th style="color:#069"><?php echo $identidad;?></th>
                  <th>Nombre Completo</th>
                  <th style="color:#069"><?php echo $nombre." ".$apellido;?></th>
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
                  <th><input id="oculto" type="hidden" value="<?php echo $idProceso;?>">
                  <select id="juzgado" class="form-control" autofocus>
                  <?php
		      			$nomJuzgado="";
						$sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado' and estado like 'Activo' order by ciudad ");
		                while($rowJ=mysql_fetch_array($sqlJuzgado)) {
							$nomJuzgado = $rowJ["nombre"];
							$idJuzgado = $rowJ["idJuzgado"];
						}
						mysql_free_result($sqlProceso);
				   ?>
                       <option value="<?php echo $idJuzgado;?>"><?php echo strtoupper($nomJuzgado);?></option>
                     
                 <?php	
						$nomJuzgado="";
						$sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where estado like 'Activo' order by ciudad ");
		                while($rowJ=mysql_fetch_array($sqlJuzgado)) {
							$nomJuzgado = $rowJ["nombre"];
							$idJuzgado = $rowJ["idJuzgado"];
				  ?>
                       <option value="<?php echo $idJuzgado;?>"><?php echo strtoupper($nomJuzgado);?></option>
                     
                 <?php
						}
						mysql_free_result($sqlProceso);
		  		  ?>
                  </select>
                  </th>
                  <th>Radicado</th>
                  <th><input type="text" class="form-control" id="radicado" size="25" value="<?php echo $idRadicado;?>"></th>
                  <th>Clase de proceso</th>
                  <th colspan="2"><input type="text" id="tipo" class="form-control" size="40" value="<?php echo $idTipoProceso;?>"></th>
                   
               </tr>
               <tr>
                  <th>Demandante</th>
                  <th><input type="text" class="form-control" id="demandante" size="40" value="<?php echo $demandante;?>"></th>
                  <th>Demandado</th>
                  <th> <input type="text" class="form-control" id="demandado" size="40" value="<?php echo $demandado;?>"></th>
                  <th>Fecha de Proceso</th>
                 <th><input type="date" class="form-control" id="fechaProceso" size="40" value="<?php echo $fechaProceso;?>"></th>
                </tr>
                
                <tr>
                  <th>Descripción Actuación</th>
                   <th colspan="2">
                      <textarea name="descripcion" cols="20" rows="5" class="form-control"><?php echo $descripcion;?></textarea>
                   </th>
                   
                  
                   <th colspan="3"></th>
                </tr>
             </table>   
              <div class="box-footer">
               <?php
			   if($tipoUsuario==1){
			   ?>
                <button type="submit" class="btn btn-primary" onClick="modificarProceso(); return false;">
                Actualizar Datos Proceso</button>
              <?php
			   }
			   else{
			  ?>
              <button type="submit" disabled class="btn btn-primary" onClick="modificarProceso(); return false;">
                Actualizar Datos Proceso</button>
              <?php
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
             <p style="font-size:18px">Actuaciones</p>
            <form name="actuaciones">
             <table class="table table-hover">
               <tr>
                  <th>N° de Estado</th>
                  <th><input name="numEstado" id="numEstado" type="number" class="form-control" 
                  value="<?php echo $numEstado;?>" disabled></th>
                  <th>Fecha</th>
                  <th><input name="fecha" id="fecha" type="date" required class="form-control"></th>
                  <th>Tipo Actuación</th>
                  <th><input id="oculto" type="hidden" value="<?php echo $idProceso;?>">
                  <input name="tipo" id="tipo" size="30" type="text" class="form-control" required></th>
               </tr>
               <tr>
                  <th>Descripción Actuación</th>
                  <th colspan="3">
                  <textarea name="actuacion" id="actuacion" cols="10" rows="4"  class="form-control"></textarea></th>
                  <th>Fecha de Auto</th>
                  <th><input name="fechaAuto" id="fechaAuto" size="30" type="date" class="form-control" required></th>
                 
               </tr>
               <tr>  
                  <th> <div class="box-footer">
                       <button type="submit" class="btn btn-primary" onClick="registrarActuacion(); return false;">
                       Registrar Actuación</button>
              </div></th>
              <th colspan="5">
               </tr>
              </table> 
             </form>
              <div id="resultadoA">
				 
               </div>
               <div class="box">
           <div class="box-body">
           <?php
		       $sql="SELECT * FROM des_actuaciones where idProceso like '$idProceso' order by fechaRegistro ASC";
		       $resul=mysql_query($sql) or die ("No hay datos");
		   ?>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr style="background:#003A75; color:#FFF">
                  <th>N° de Estado</th>
                  <th>Fecha</th>
                  <th>Tipo Actuación</th>
                  <th>Descripción Actuación</th>
                  <th>Fecha Auto</th>
                  <th>Fotos</th>
                  <th>Eliminar</th>
                </tr>
                </thead> 
                <tbody>
                 <?php
				 $idActuacion="";
				 while($row = mysql_fetch_array($resul)){
					$idActuacion=$row['idActuacion'];
				?>
                <tr style="font-size:11px">
                  <th><?php echo $idActuacion;?></th>
                  <th><?php echo $row['fecha'];?></th>
                  <th><?php echo $row['tipo'];?></th>
                  <th><?php echo $row['actuacion'];?></th>
                  <th><?php echo $row['fechaAuto'];?></th>
                  <th align="right"><a href="subirFoto.php?idProceso=<?php echo $idProceso;?>&idActuacion=<?php echo $idActuacion;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=150pt,top=50pt,width=1100px,height=650px'); return false;">
                 <img  src='../img/fotos.png' width='32' height='32' title="Fotos actuación">Ver</a>
                    </th>
                 <th>
                 <?php
				 
			  		 if($tipoUsuario==1){
						 
			   	  ?>
                  <a style="text-decoration:none" href="eliminarActuacion.php?idActuacion=<?php echo $row['idActuacion'];?>&identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                   <img  src='../img/borrar.png' width='28' height='25' title="Eliminar Actuación">
                  </a>
                  <?php
					}
					else{
						 
				  ?>	
					
                   <img  src='../img/borrar.png' width='28' height='25' title="Eliminar Actuación">
                  
				<?php	
					}
				  ?>
                  </th>
                </tr>
        	<?php
				 }
			?>
                </tbody>
                <tfoot>
                <tr style="background:#003A75; color:#FFF">
       		      <th>N° de Estado</th>
                  <th>Fecha</th>
                  <th>Tipo Actuación</th>
                  <th>Descripción Actuación</th>
                  <th>Fecha Auto</th>
                  <th>Fotos</th>
                  <th>Eliminar</th>
                </tr>
                </tfoot>
              </table>
               </div>
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

</body>
</html>