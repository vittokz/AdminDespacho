<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
       $identidad=$_GET['iden'];
   
       $nombre="";$apellido ="";$tel ="";$cel ="";$email ="";$ban=0;$municipio="";
		$sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysql_fetch_array($sqlCliente)) {
            $nombre = $rowCliente["nombre"];
            $empresa = $rowCliente["empresa"];
            $direccion = $rowCliente["dir_cliente"];
            $apellido = $rowCliente["apellido"];
            $tel = $rowCliente["telefono"];
            $cel = $rowCliente["celular"];
            $email = $rowCliente["email"];
            $municipio = $rowCliente["municipio"];
		}
		mysql_free_result($sqlCliente);

       $sql=mysql_query("SELECT * FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
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
		
	//verifico el idActuacion mayor para el numero de estado
  $numEstado=0;
  $sqlA=mysql_query("SELECT max(numComprobante) as mayor FROM des_contratos_empresas");
  while($rowA=mysql_fetch_array($sqlA)) {
    $numCompro= $rowA["mayor"];
  }
 
  $numCompro++;
  mysql_free_result($sqlA);		

  function generaDepartamentos(){
		$consulta=mysql_query("SELECT id, opcion FROM lista_paises");
		// Voy imprimiendo el primer select compuesto por los paises
		echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
		echo "<option value='0'>Elige</option>";
		while($registro=mysql_fetch_row($consulta))
		{
			echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
		}
		echo "</select>";
  }
 


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Contratos viacpro::.</title>
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
  <script type="text/javascript" src="select_dependientes.js"></script>
  <script type="text/javascript">
  function cambiarEstado(obj){
   
        if(obj[ obj.selectedIndex ].value == "Si") {
            var container = document.getElementById("mostrarMuni") ;
            container.style.display='block';
         
        }else{
          var container = document.getElementById("mostrarMuni") ;
          container.style.display='none';  
    
        }
      }
  </script>

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
        <h1>Contabilidad - Creación Factura Cliente </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <form name="ingresos" method="post" action="registroContrato.php">
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

                    <tr style="background:#E5E5E5">
                        <th>Empresa</th>
                        <th style="color:#069"><?php echo strtoupper($empresa);?></th>
                        <th>Dirección</th>
                        <th style="color:#069"><?php echo strtoupper($direccion);?></th>
                        <th>Movil</th>
                        <th style="color:#069"><?php echo $cel;?></th>
                    </tr>
                    <tr style="background:#E5E5E5">
                        <th>Email</th>
                        <th colspan="5" style="color:#069"><?php echo strtoupper($email);?></th>
                    </tr>
              </table>


              <table class="table table-hover">
                
                <tr>
                  
        
                  <th>Fecha</th>
                  <th>
                  <input type="hidden" class="form-control" name="descripcion" id="descripcion">
                  <input type="hidden" class="form-control" name="numComprobante" value="<?php echo $numCompro;?>">  
                  <input type="date" class="form-control" name="fecha" id="fecha" required autofocus>
                    <input type="hidden" name ="identidad" id="identidad" value="<?php echo $identidad;?>">
                  
                    </th>
                </tr>
                <tr>
                  <th colspan="4" style="background-color:#f9f9f9; color:#aa0606"><center>
                    Seleccione el Municipio donde se registrarán los procesos.</center></th>
                </tr>
                <tr>
                <tr>
                     <th>Con Municipio</th>
                     <th> <select name="opcion" id="opcion" class="form-control" onchange="cambiarEstado(this);">
                              <option value="Seleccione">Seleccione</option>
                              <option value="Si">Si</option>
                              <option value="No">No</option>
                          </select></th>
                </tr>
              </table>
                
                <div id="mostrarMuni" style="display:none;">
                    <table class="table table-hover">
                    <tr>
                      <th>Departamento</th>
                        <th>
                          <div style="width:350px;">
                              <div><?php generaDepartamentos(); ?></div>
                        </div>
                        </th>
                        <th>Municipio</th>
                        <th>
                          <div>
                                <select disabled="disabled" name="estados" id="estados" class="form-control">
                                    <option value="0">Selecciona opci&oacute;n...</option>
                                </select>

                          </div>
                      </th>
                    </tr>
                    </table>
                </div>
                
                <table class="table table-hover">
                <tr>
                  <th>Plan</th>
                  <th>
                  <select id="plan" name="plan" class="form-control">
                  <?php
		      			     $nomPlan="";$idPlan="";$valorPlan=0;
						         $sqlPlan=mysql_query("SELECT * FROM des_planes where estado like 'Activo' order by idPlan ASC ");
		                while($rowP=mysql_fetch_array($sqlPlan)) {
                               $nomPlan = $rowP["nombrePlan"];
                               $idPlan = $rowP["idPlan"];
                               $valor = $rowP["valor"];
                               $descripcion = $rowP["descripcion"];
                      ?>
                     
                       <option value="<?php echo $idPlan;?>"><?php echo strtoupper($descripcion);?></option>
                     
                 <?php	
						}
						mysql_free_result($sqlPlan);
		  		  ?>
                  </select>
                  
                  </th>
          </tr>
                  <tr>
                    <th>Descuento</th>
                     <th>
                         <select id="descuento" name="descuento" class="form-control">
                            <option selected value="0">No</option>
                            <option value="5">5%</option>
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                            <option value="20">20%</option>
                            <option value="20">30%</option>
                            <option value="30">40%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                         </select>
                     </th>
                </tr>
            </table>   
              <div class="box-footer">
                <button title="Registrar Contrato" style="background-color:#1d1a31" type="submit" class="btn btn-primary">Registrar</button>
              </div>
             </div>
            </form>
            <br>
               <div id="resultado">
            
               </div>
            </div>
           </div> 
          </div> 
          <br>
           <div class="box">
           <div class="box-body">
           <?php
		       $sql=mysql_query("SELECT * FROM des_contratos_empresas where identidad like '$identidad' and estado like 'Activo' order by numComprobante ASC ");
		   
		   ?>
          <div class="table-responsive">
              <h3>Listado Planes del Cliente</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#1d1a31; color:#FFF;">
                  <th>Descripción</th>
                  <th>Descuento</th>
                  <th>Plan</th>
                  <th>Municipio</th>
                  <th>Fecha Contrato</th>
                  <th>Liquidar</th>
                </tr>
                </thead> 
                <tbody>
                <?php
                  while($row = mysql_fetch_array($sql)){
                    $numComprobante=$row['numComprobante'];
                    $identidad=$row['identidad'];
                    $idContrato=$row['id'];
                    $descripcion=$row['descripcion'];
                    $idPlan=$row['idPlan'];

                    $sqlP=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan' and estado like 'Activo'");
                          while($rowP = mysql_fetch_array($sqlP)){
                              $descripcion=$rowP['descripcion'];
                              $valor=$rowP['valor'];

                          }
                          mysql_free_result($sqlP);
                    $municipio=$row['municipio'];
                    $fecha=$row['fecha'];
                    $descuento=$row['descuento'];
                    $usuarioRegistro=$row['usuarioRegistro'];
                    $idCiudad=$municipio;
                        $nombreCiudad="";
                        $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
                        while($rowC=mysql_fetch_array($sqlCiudad)) {
                          $nombreCiudad = $rowC["opcion"];
                        }
                       

                  ?>
                  <tr style="font-size:11px">
                  <th><?php echo $descripcion;?></th>
                  <th><?php echo $descuento." %";?></th>
                  <th><?php echo $idPlan;?></th>
                  <th><?php echo $nombreCiudad;?></th>
                  <th><?php echo $fecha;?></th>
                  <?php
                    if($tipoUsuario==1 || $tipoUsuario==2){
                  ?>
                  <th><a href="liquidarContrato.php?identidad=<?php echo $identidad;?>&idPlan=<?php echo $idPlan;?>&fecha=<?php echo $fecha;?>&idContrato=<?php echo $idContrato;?>&empleado=<?php echo $usuarioRegistro;?>&descuento=<?php echo $descuento;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                  Liquidar</a></th>
                  <?php
                    }
                    else{
                  ?>
                  <th>Sin Acceso</th>
                  <?php
                    }
                  ?>
                </tr>
               <?php
				 }
			   ?> 
                </tbody>
                <tfoot>
                <tr style="background:#1d1a31; color:#FFF">
                   <th>Descripción</th>
                   <th>Descuento</th>
                   <th>Plan</th>
                   <th>Municipio</th>
                   <th>Fecha Contrato</th>
                  <th>Liquidar</th>
                </tr>
                </tfoot>
              </table>
              </div>
               </div>
          </div>        
       </section>      
   </div>
  <!-- /.content-wrapper -->


  <div class="control-sidebar-bg"></div>
</div>
<footer style="background-image:url('../img/FondoNuevo.jpg')">
  <center><img src="../img/viacpro.png"></center>
  </footer>
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
