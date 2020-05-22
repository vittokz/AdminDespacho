<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
       $ccCliente=$_GET["iden"];
       $idContrato=$_GET["id"];
       $sql=mysql_query("SELECT * FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
          $tipoUsuario = $row["tipo_usuario"];
          $identidad = $row["cedula_usuario"];
		   }
    mysql_free_result($sql);
    $sql=mysql_query("SELECT * FROM des_empleado where cedula_empleado like '$identidad'");
    while($row = mysql_fetch_array($sql)){
      $logo=$row['logo'];
    }
     
    $sql=mysql_query("SELECT * FROM des_cliente where cedula_cliente like '$ccCliente'");
     while($row = mysql_fetch_array($sql)){
          $empresaCli=$row['empresa'];
          $contactoCli=$row['nombre']." ".$row['apellido'];
     }

    
              $sql="select * from des_contratos_empresas where id like '$idContrato' and estado like 'Activo'";
              $resul = mysql_query($sql) or die('<center><font color="red">Error al realizar la busqueda identidad!!!..</font></center>');
              while($row=mysql_fetch_array($resul)) {
                    $id =$row["id"];
                    $idPlan =$row["idPlan"];
                    $descuento =$row["descuento"];
                    $idContrato =$row["id"];
                    $municipio =$row["municipio"];
                    $usuarioRegistro =$row["usuarioRegistro"];
                    $sqlU="SELECT * FROM des_usuario WHERE nombre_usua like '$usuarioRegistro'";
                  
                    $resU=mysql_query($sqlU);
                        while($rowU=mysql_fetch_array($resU)) {
                          $nombreEmpleado = $rowU["nombre"]." ".$rowU["apellido"];
                          $cedulaEmpleado = $rowU["cedula_usuario"];
                      }

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
              }
            

  $sqlLiq=mysql_query("SELECT * FROM des_liquidar_contratos where idContrato like '$id' order by idLiquida desc limit 1");
  $numContratos = mysql_num_rows($sqlLiq);
      if($numContratos>0){
        while($rowL = mysql_fetch_array($sqlLiq)){
          $periodoInicial=$rowL['periodoInicial'];
          $periodoFin=$rowL['periodoFin'];
          $fechaGen=$rowL['fechaGen'];
        }
      }
      else{
        $sql="select * from des_contratos_empresas where numComprobante like '$idContrato' and estado like 'Activo'";
      
        $resul = mysql_query($sql) or die('<center><font color="red">Error al realizar la busqueda contrato!!!..</font></center>');
            while($rowL = mysql_fetch_array($resul)){
              $periodoFin=$rowL['fecha'];
            }

      }
    //verifico el idActuacion mayor para el numero de estado
		$numRecibo=0;
		$sqlA=mysql_query("SELECT max(idLiquida) as mayor FROM des_liquidar_contratos");
		while($rowA=mysql_fetch_array($sqlA)) {
			$numRecibo = $rowA["mayor"];
		}
		$numRecibo++;
		mysql_free_result($sqlA);	

    if($logo==""){
      $logoImagen="../dist/img/avatar5.png";
     }
     else{
       $logoImagen="../perfil/imgLogos/".$identidad."/".$logo;
     }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Cuenta de Cobro::.</title>
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
  <script src="../push/push.min.js"></script>
  <script type="text/javascript" src="select_dependientes.js"></script>
  <script language="JavaScript" type="text/javascript">
        function cambiar(e)
        {
        var option = e.options[e.selectedIndex];
        document.getElementById('empresa').value = option.value;
        }

        function mostrarValor(e)
        {
        var option = e.options[e.selectedIndex];
        document.getElementById('valorPlan').value = option.value;
        }
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$sql=mysql_query("SELECT * FROM des_email where destinatario like 'asesoria@viacpro.com' and estado like 'Sin leer'");
$can=0;    
while($row=mysql_fetch_array($sql)) 
     {
         $asunto= $row["asunto"];
         $can=$can+1;
     }

     if($can>0){
?>
    <script>
     		Push.create("Notificación Viacpro", { //Titulo de la notificación
      	body: "Hay correos sin leer!!!", //Texto del cuerpo de la notificación
        icon: '../img/mensaje.png', //Icono de la notificación
        timeout: 6000, //Tiempo de duración de la notificación
          onClick: function () {//Función que se cumple al realizar clic cobre la notificación
             window.location = "https://www.viacpro.com/AdminDespacho/pages/mailbox/mailbox.php"; //Redirige a la siguiente web
             this.close(); //Cierra la notificación
          }
        });
    </script>
 <?php
     }
 ?>
<center> <div style="width:100%; height:15%; background-image:url('../img/FondoNuevo2.jpg')">
<center><span style="font-size:26px; color:#FFF; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIGILANCIA DE ACTUACIONES PROCESALES
<br><img src="../img/viacproSombra.png" style="width:15%">
</span></center>
</div></center>
<?php
  if($logo==""){
   
?>  
    <script>
    //Todo el código que se encuentra aquí se auto explica 
    Push.create("Notificación Viacpro", { //Titulo de la notificación
      body: "Aun no actualiza su foto de perfil", //Texto del cuerpo de la notificación
      icon: '../img/fotos.png', //Icono de la notificación
      timeout: 8000, //Tiempo de duración de la notificación
      onClick: function () {//Función que se cumple al realizar clic cobre la notificación
        window.location = "https://www.viacpro.com/AdminDespacho/perfil/perfil.php"; //Redirige a la siguiente web
        this.close(); //Cierra la notificación
      }
    });
  </script>
<?php
  }
?>
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
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
            include("../menuGerentes/menuViacpro.php");
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1>Crear Cuenta de Cobro</h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
           
            <form name="cuentaCobro">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Tipo</th>
                  <th><select id="tipo" class="form-control">
                      <option value="Factura de Venta">Factura de Venta N° <?php echo $numRecibo;?> </option>
                   </select></th>
                  <th>Cliente</th>
                  <th colspan="3">
                  <input type="hidden" class="form-control" id="idCliente" value="<?php echo $ccCliente;?>">
                  <input disabled type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $empresaCli;?>"></th>
                 <th>
                </th>
                </tr>
                <tr>
                  <th>Medio de Pago</th>
                  <th><select id="medio" class="form-control" autofocus>
                     <?php   
                       $sql=mysql_query("SELECT * FROM des_medio_pago where estado like 'Activo'");
                           while($row = mysql_fetch_array($sql)){
                               $idMedio=$row['idMedio'];   
                               $nombreCuenta=$row['nombre'];
                               $numCuenta=$row['cuenta'];
                
                      ?>
                      <option value="<?php echo $idMedio;?>"><?php echo strtoupper($nombreCuenta)."|".$numCuenta;?></option>
                    <?php
                           }
                    ?>
                   </select></th>
                   <th>Fecha Elaboración</th>
                   <th><input type="date" class="form-control" id="fechaEla" required></th>
                   <th>Fecha Vencimiento</th>
                   <th><input type="date" class="form-control" id="fechaVence" required></th>
               
               </tr>
               <tr>
               <th>Vendedor</th>
                  <th><select  id="vendedor" name="vendedor" class="form-control">
                             <option value="<?php echo $usuarioRegistro;?>"><?php echo strtoupper($nombreEmpleado);?></option>
                       
                      </select>
                  
                  </th>
                  <th>Producto</th>
                  <th colspan="3">
                  <input type="hidden" class="form-control" id="idPlan" value="<?php echo $idPlan;?>">
                  <input type="hidden" class="form-control" id="nomPlan" value="<?php echo $nombrePlan;?>">
                  <input type="hidden" class="form-control" id="valorPlan" value="<?php echo $valorPlan;?>">
                  <input type="hidden" class="form-control" id="idContrato" value="<?php echo $idContrato;?>">
                  <input disabled type="text" class="form-control" id="producto" name="producto" value="<?php echo $nombrePlan." - ".$nombreCiudad." - $ ".number_format($valorPlan);?>">
                  </th>
                    
                </tr>
                <tr>
                  <th>Descuento</th>
                  <th><input type="descuento" class="form-control" id="descuento" value="<?php echo $descuento;?>%"></th>
             
                </tr>
                <tr>
                 <td colspan="6" style="background-color:#022237; color:#ffffff"><center>PERIODO DE PAGO</center></td>
                </tr>
                <tr>
                  <th>Ultimo Pago</th>
                  <th><input type="date" class="form-control" id="fechaInicial" value="<?php echo $periodoFin;?>"></th>
                  <th>Pagar Hasta</th>
                  <th><input type="date" class="form-control" id="fechaFin" value=""></th>
                   <th>
                   </th>
                </tr>
               
             </table>   
              <div class="box-footer">
                <button title="Guadar" style="background-color:#1d1a31" type="submit" class="btn btn-primary" onClick="guardarCuentaCobro(); return false;">Guardar</button>
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
                 
       </section>      
   </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
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
</body>
</html>
