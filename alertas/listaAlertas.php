<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad="";$nombre="";$apellido ="";$claveUsuario ="";$tipoUsuario ="";
       $sql=mysql_query("SELECT * FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
          $identidad = $row["cedula_usuario"];
          $nombre = $row["nombre"];
          $apellido = $row["apellido"];
          $nomUsuario = $row["nombre_usua"];
          $claveUsuario = $row["clave_usuario"];
          $tipoUsuario = $row["tipo_usuario"];
	  	}
        mysql_free_result($sql);
        $sql=mysql_query("SELECT * FROM des_empleado where cedula_empleado like '$identidad'");
        while($row = mysql_fetch_array($sql)){
          $logo=$row['logo'];
        }
        
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
  <title>.::Lista Alertas::.</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
   <link rel="shortcut icon" href="../img/icono.ico">
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
  <link rel="stylesheet" href="../css/stilosBanner.css">
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
  <script src="../push/push.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
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
                body: "Aun no actualiza su foto perfil!!!", //Texto del cuerpo de la notificación
                icon: '../img/usuario.png', //Icono de la notificación
                timeout: 8000, //Tiempo de duración de la notificación
                onClick: function () {//Función que se cumple al realizar clic cobre la notificación
                  window.location = ""; //Redirige a la siguiente web
                  this.close(); //Cierra la notificación
                }
              });
            </script>
      <?php
      }
      ?>
<?php
 date_default_timezone_set('America/Bogota');
$sql=mysql_query("SELECT * FROM des_email where destinatario like 'asesoria@viacpro.com' and estado like 'Sin leer'");
    while($row=mysql_fetch_array($sql)) 
     {
         $asunto= $row["asunto"];
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

<?php
 $hoy = date("Y-m-d");	
 $nuevafecha = strtotime ( '+3 day' , strtotime ( $hoy ) ) ;
 $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$sql=mysql_query("SELECT * FROM des_tareas where fecha between '$hoy' and '$hoy' and hora like '$horaCompleta2' and usuarioRegistro like '$usuario'");
    while($row=mysql_fetch_array($sql)) 
     {
         $descri= $row["descripcion"];
?>
    <script>
     		Push.create("Notificación  Viacpro", { //Titulo de la notificación
      	body: "Revisar Alertas!!!", //Texto del cuerpo de la notificación
        icon: '../img/adver.jpg', //Icono de la notificación
        timeout: 8000, //Tiempo de duración de la notificación
          onClick: function () {//Función que se cumple al realizar clic cobre la notificación
             window.location = "https://www.viacpro.com/AdminDespacho/alertas/listaAlertas.php"; //Redirige a la siguiente web
             this.close(); //Cierra la notificación
          }
        });
    </script>
<?php
     }
?>
<?php
 $hoy = date("Y-m-d");	
 $bandera=0;
$sql="SELECT * FROM des_cotizacion where fechaRegistro like '%$hoy%'";
  $res=mysql_query($sql);
    while($row=mysql_fetch_array($res)) 
     {
         $bandera=1;
     }
     if($bandera==1){
?>
    <script>
     		Push.create("Notificación  Viacpro", { //Titulo de la notificación
      	body: "Nuevas Cotizaciones Verifique !!!", //Texto del cuerpo de la notificación
        icon: '../img/fondoHome.png', //Icono de la notificación
        timeout: 8000, //Tiempo de duración de la notificación
          onClick: function () {//Función que se cumple al realizar clic cobre la notificación
             window.location = "https://www.viacpro.com/AdminDespacho/dependientesPagina/Cotizaciones.php"; //Redirige a la siguiente web
             this.close(); //Cierra la notificación
          }
        });
    </script>
 <?php
       
     }
 ?>
<div class="wrapper"  >

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
        <h1>Alertas</h1><br>
        <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
          
            <!-- /.box-header -->
            <div class="box-body">
             <H3 style="color:red">ALERTAS</H3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color:#1d1a31;color:#FFFFFE">
                  <th>Cliente</th>
                  <th>Descripción</th>
                  <th>Fecha y Hora Vencimiento</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Procesar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                echo "usuario:".$usuario;
                    date_default_timezone_set('America/Bogota');
                    $hoy = date("Y-m-d");	
                    $nuevafecha = strtotime ( '+5 day' , strtotime ( $hoy ) ) ;
                    $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                    if($tipoUsuario=="Gerentes" || $tipoUsuario=="Desarrollador" ){
                      $sql="SELECT * FROM des_tareas where fecha between '$hoy' and '$nuevafecha' and estado like 'Pendiente' order by fecha ASC";
                    }
                    else{
                      $sql="SELECT * FROM des_tareas where fecha between '$hoy' and '$nuevafecha' and estado like 'Pendiente' and usuarioRegistro like '$usuario' order by fecha ASC";
                    }
                    $res=mysql_query($sql);
                    while($row=mysql_fetch_array($res)) {
                        $descripcion = $row["descripcion"];
                        $cliente = $row["cliente"];
                       
                        $fecha = $row["fecha"];
                        $idTarea = $row["idTarea"];
                        $estado= $row["estado"];
                        $hora= $row["hora"];
                        $usuarioRegistro= $row["usuarioRegistro"];
                        $municipio= $row["municipio"];
                        $nombreCiudad="";
                            $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
                            while($rowC=mysql_fetch_array($sqlCiudad)) {
                              $nombreCiudad = $rowC["opcion"];
                            }
                        if($estado=="Pendiente") 
                           $colorFila="#ffc2c2";
                        else  
                           $colorFila="#78c582";
                       
                ?>
                    <tr style="background-color:<?php echo $colorFila;?>">
                    
                      <td><?php echo strtoupper($cliente);?></td>
                      <td><?php echo strtoupper($descripcion);?></td>
                      <td><?php echo $fecha." | ".$hora;?></td>
                      <td><?php echo $usuarioRegistro;?></td>
                      <td>
                      <?php  
                         if($estado=="Pendiente") {
                      ?>     
                          <button class="btn btn-danger"><span style="text-decoration:blink;"><?php echo strtoupper($estado);?></span></button>
                      <?php
                         }
                         if($estado=="Realizada") {
                         ?>
                        <button title="Cambiar estado" class="btn btn-primary">
                <a style="text-decoration: none; color:WHITE" href="verificarObservacion.php?idTarea=<?php echo $idTarea;?>" target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1,status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=350pt,top=70pt,width=750px,height=420px'); return false;" >
                <?php echo strtoupper($estado);?></a></button>
                         <?php
                         }
                         ?>
                      </td>
                      <td><button title="Cambiar estado" class="btn btn-success">
                <a style="text-decoration: none; color:WHITE" href="cambiarEstado.php?idTarea=<?php echo $idTarea;?>" target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1,status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=350pt,top=70pt,width=750px,height=420px'); return false;" >
                Cambiar</a></button>
                      
                    </tr>
                <?php
                    }
                    mysql_free_result($res);
                ?>
                </tbody>
                <tfoot>
                <tr style="background-color:#1d1a31;color:#FFFFFE">
                   <th>Cliente</th>
                  <th>Descripción</th>
                  <th>Fecha y Hora Vencimiento</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Procesar</th>
                </tr>
                </tfoot>
              </table>

              <H3 style="color:red">FACTURAS POR CANCELAR EMPRESAS</H3>
             
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr style="background-color:#1d1a31;color:#FFFFFE">
                        <th>Cliente</th>
                        <th>Fecha Ultimo Pago</th>
                        <th>Municipio</th>
                        <th>Dias Vencimiento</th>
                        <th>Ir</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    date_default_timezone_set('America/Bogota');
                    $hoy = date("Y-m-d");	
                    $sql=mysql_query("SELECT * FROM des_contratos_empresas where estado like 'Activo' order by identidad ASC ");
                      while($row = mysql_fetch_array($sql)){
                          $numComprobante=$row['numComprobante'];
                          $idContrato=$row['id'];
                          $identidadC=$row['identidad'];
                          $idPlan=$row['idPlan'];
                          $municipio=$row['municipio'];
                          $usuarioRegistro=$row['usuarioRegistro'];
                          $nombreCiudad="";
                          $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
                             while($rowC=mysql_fetch_array($sqlCiudad)) {
                                $nombreCiudad = $rowC["opcion"];
                          }
                          $sqlP=mysql_query("SELECT * FROM des_planes where idPlan like '$idPlan' and estado like 'Activo'");
                          while($rowP = mysql_fetch_array($sqlP)){
                              $descripcion=$rowP['descripcion'];
                              $valor=$rowP['valor'];

                          }
                          mysql_free_result($sqlP);
                          $empresa="";
                          $sqlC=mysql_query("SELECT * FROM des_cliente where cedula_cliente like '$identidadC' and estado like 'Activo'");
                             while($rowE = mysql_fetch_array($sqlC)){
                                 $empresa=$rowE['empresa'];
                              }
                              if($empresa!="")
                                //  echo $empresa."Identidad:".$identidadC."<br>";
                          $fechaContrato=$row['fecha'];
                          $sqlLiq=mysql_query("SELECT * FROM des_liquidar_contratos where idContrato like '$idContrato' and idenCliente like '$identidadC' order by idLiquida desc limit 1");
                          $numContratos = mysql_num_rows($sqlLiq);
                         
                                                 
                                          
                          if($numContratos > 0){
                              while($rowL = mysql_fetch_array($sqlLiq)){
                                    $periodoInicial=$rowL['periodoInicial'];
                                    $periodoFin=$rowL['periodoFin'];
                                    $empleado=$rowL['idenEmpleado'];
                                    $fechaGen=$rowL['fechaGen'];
                                    $diasT	= (strtotime($periodoFin)-strtotime($hoy))/86400;
                                   // $diasT 	= abs($diasT); 
                                   // $dias = floor($diasT);	
                                   
                                    if($diasT>25){
                   ?>
                                    <form method="post" action="registroLiquidaEmpresa.php">       
                                      <tr>
                                         
                                          <th><?php echo $empresa;?></th>
                                          <th><?php echo  $periodoFin;?></th>
                                          <th><?php echo $nombreCiudad;?></th>
                                          <?php
                                          $auxDias=$diasT-(30);
                                          
                                             if($auxDias<0)
                                                          $color="GREEN";
                                                    else 
                                                          $color="RED";
            
                                          ?>
                                          <th style="color:<?php echo $color;?>"><?php echo $auxDias." dias";?></th>
                                         <th><a target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1,status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=300pt,top=70pt,width=900px,height=600px'); return false;"  href="../contabilidad/liquidarContrato.php?identidad=<?php echo $identidadC;?>&idPlan=<?php echo $idPlan;?>&fecha=<?php echo $periodoFin;?>&idContrato=<?php echo $numComprobante;?>&empleado=<?php echo $usuarioRegistro;?>">Ir</a></th>
                                      </tr>
                                    </form>
                                  
                  <?php
                                    }  
                              }
                                mysql_free_result($sqlLiq);
                          }
                          if($numContratos<=0 && $empresa!=""){
                            $diasT	= (strtotime($fechaContrato)-strtotime($hoy))/86400;
                            $diasT 	= abs($diasT); 
                            $dias = floor($diasT);
                     
                            if($dias>25){
                   ?>
                  
                                <form method="post" action="registroLiquidaEmpresa.php">    
                                      <tr>
                                          <th><?php echo $empresa;?></th>
                                          <th><?php echo $fechaContrato;?></th>
                                          <th><a href="../contabilidad/liquidarContrato.php">
                                          <?php echo $nombreCiudad;?></a></th>
                                          <?php
                                          
                                          $auxDias=$dias-(30);
                                          if($dias<0)
                                              $color="GREEN";
                                           else 
                                              $color="RED";
            
                                          ?>
                                          <th style="color:<?php echo $color;?>"><?php echo $dias-(30)." dias";?></th>
                                        <th><a target="popup" onClick="window.open(this.href, this.target, 'toolbar=0 , location=1,status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=300pt,top=70pt,width=900px,height=600px'); return false;"  href="../contabilidad/liquidarContrato.php?identidad=<?php echo $identidadC;?>&idPlan=<?php echo $idPlan;?>&fecha=<?php echo $fechaContrato;?>&idContrato=<?php echo $numComprobante;?>&empleado=<?php echo $usuarioRegistro;?>">Ir</a></th>
                                      </tr>
                                    </form>
                                    

                   <?php
                            }
                          }
                         
                       }
                       mysql_free_result($sql);
                           
                   ?>
                </tbody>
                <tfoot>
                <tr style="background-color:#1d1a31;color:#FFFFFE">
                    <th>Cliente</th>
                    <th>Fecha Ultimo Pago</th>
                    <th>Municipio</th>
                    <th>Vence en</th>
                    <th>Ir</th>
                </tr>
                </tfoot>
              </table>
              <div id="resultado"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        
       </section>      
   </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
   
    </div>
  
  </footer>

  
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
</div>
</body>
</html>
