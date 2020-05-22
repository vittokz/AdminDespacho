<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad="";
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
     
    if($logo==""){
      $logoImagen="../dist/img/avatar5.png";
     }
     else{
       $logoImagen="../perfil/imgLogos/".$identidad."/".$logo;
     }
		
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
 
  if($tipoUsuario==1 || $tipoUsuario==2){

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Empleados viacpro::.</title>
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
      <ul class="sidebar-menu" data-widget="tree">
   
       
        <li>
          <a href="../perfil/perfil.php">
            <i class="fa fa fa-user"></i>
            <span>Perfil</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa fa-book fa-fw"></i> <span>Alertas</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../alertas/alertas.php"><i class="fa fa-circle-o"></i> Crear Alerta</a></li>
             <li><a href="../alertas/listaAlertas.php"><i class="fa fa-circle-o"></i> Ver Alertas</a></li>
           
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class="fa fa-th"></i> <span>Procesos</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../empleados/empleado.php"><i class="fa fa-circle-o"></i> Empleados</a></li>
             <li><a href="../clientes/crearClientes.php"><i class="fa fa-circle-o"></i> Crear Cliente</a></li>
             <li><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
             <li><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>
             <li><a href="../radicado/radicado.php"><i class="fa fa-circle-o"></i> Radicado</a></li> 
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-book fa-fw"></i><span>Planes</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../planes/planesActivos.php"><i class="fa fa-circle-o"></i>Activos</a></li>
             <li><a href="../planes/planesInactivos.php"><i class="fa fa-circle-o"></i>Inactivos</a></li>
            
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
        
        <li class="treeview">
          <a href="">
            <i class="fa fa-credit-card"></i> <span>Contabilidad</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../contabilidad/ingresos.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
             <li><a href="../contabilidad/egresos.php"><i class="fa fa-circle-o"></i> Pago nómina</a></li>
             <li><a href="../contabilidad/egresosComprobante.php"><i class="fa fa-circle-o"></i>Egresos</a></li>
             <li><a href="../factura/factura.php"><i class="fa fa-circle-o"></i>Factura</a></li>
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
        <li>
          <a href="../asesores/asesores.php">
            <i class="fa fa-user-o "></i> <span>Asesores</span>
            <span class="pull-right-container">
            
            </span>
          </a>
        <li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-credit-card"></i> <span>Página Web</span>
            <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="../dependientesPagina/dependientes.php"><i class="fa fa-circle-o"></i> Dependientes</a></li>
             <li><a href="../dependientesPagina/asesores.php"><i class="fa fa-circle-o"></i> Asesores</a></li>
             <li><a href="../dependientesPagina/abogados.php"><i class="fa fa-circle-o"></i> Abogados</a></li>
             <li><a href="../dependientesPagina/Cotizaciones.php"><i class="fa fa-circle-o"></i> Cotizaciones</a></li>
             
          </ul>
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
        <h1>Empleados-Dependientes Judiciales</h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <form name="empleado">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Tipo Documento</th>
                  <th><select id="tipo" class="form-control" autofocus>
                    <option value="Nit">Nit</option>
                    <option selected value="C.C">Cedula De Ciudadania</option>
                  </select></th>
                  <th>Nº Identificación</th>
                  <th><input type="number" class="form-control" id="identidad" required></th>
                  <th>Tipo</th>
                  <th><select id="tipoEmpleado" class="form-control" require>
                          <option selected value="Ninguno">Seleccione</option>
                          <option value="Asesor Comercial">Asesor Comercial</option>
                          <option value="Dependiente Judicial">Dependiente Judicial</option>
                          <option value="Gerente Comercial">Gerente Comercial</option>
                          <option value="Gerente General">Gerente General</option>
                      </select>
                  
                  </th>
                </tr>
                <tr>
                  <th>Empresa</th>
                  <th><input disabled type="text" class="form-control" id="empresa" value="VIACPRO"></th>
                  <th>Nombres</th>
                  <th><input type="text" class="form-control" id="nombre" required></th>
                  <th>Apellidos</th>
                  <th><input type="text" class="form-control" id="apellidos" required></th>
               </tr>
               <tr>
                  <th>Dirección</th>
                  <th> <input type="text" class="form-control" id="direccion"></th>
                  <th>Teléfono</th>
                  <th><input type="number" class="form-control" id="telefono"></th>
                  <th>Celular</th>
                  <th><input type="number" class="form-control" id="celular"></th>
                  
                </tr>
                
                <tr>
                  <th>Emáil</th>
                  <th><input type="email" class="form-control" id="email"></th>
                  <th>Departamento</th>
                  <th>
                    <div style="width:350px;">
          			<div><?php generaDepartamentos(); ?></div>
                   </div>
                  </th>
                  <th>Municipio</th>
                  <th><div>
               		<select disabled="disabled" name="estados" id="estados" class="form-control">
    					<option value="0">Selecciona opci&oacute;n...</option>
    				</select>

				</div></th>
                </tr>
                
                <tr>
                  <th>Fecha Nacimiento</th>
                  <th><input type="date" class="form-control" id="fecha"></th>
                  <th>Contrato</th>
                  <th><select id="contrato" class="form-control" require>
                      <option value="Ninguno">Seleccione</option>
                       <option value="Prestacion Servicios">Prestación Servicios</option>
                       <option value="Termino Indefinido">Termino Indefinido</option>
                       <option value="Medio Tiempo">Medio Tiempo</option>
                       <option value="Tiempo Completo">Tiempo Completo</option>
                      
                        
                      </select>
                  </th>
                  <th>Semestre</th>
                  <th><select id="semestre" class="form-control">
                        <?php for ($i=1;$i<=10;$i++) 
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        ?> 
                        
                      </select>
                  </th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <th>Fecha Inicio Contrato</th>
                  <th><input type="date" class="form-control" id="fechaContrato"></th>
                  <th>Salario</th>
                  <th><input type="number" class="form-control" id="salario"></th>
                </TR>
             </table>   
              <div class="box-footer">
                <button title="Crear nuevo empleado" style="background-color:#1d1a31" type="submit" class="btn btn-primary" onClick="enviarDatosEmpleado(); return false;">Crear Empleado</button>
              </div>
             
             </div>
            </form>
            <div class="box-footer">
                <a title="Listado empleados Inactivos" style="background-color:#1d1a31" href="empleadosInactivos.php" class="btn btn-primary">Listar Empleados Inactivos</a>
              </div>
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
		       $sql=mysql_query("SELECT * FROM des_empleado where estado like 'Activo' order by municipio ");
		   
		   ?>
          <div class="table-responsive">
              <h3>Listado de Empleados</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#1d1a31; color:#FFF;">
                  <th>Nº Identificación</th>
                  <th>Nombre</th>
                  <th>Municipio</th>
                  <th>Contrato</th>
                  <th>Cargo</th>
                  <th>Ver Empleado</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                </tr>
                </thead> 
                <tbody>
                <?php
				 while($row = mysql_fetch_array($sql)){
           $identidad=$row['cedula_empleado'];
           $idEmpleado=$row['id_empleado'];
           $tipoEmpleado=$row['tipoEmpleado'];
           $estado=$row['estado'];
           if($estado=="Activo")
                $color="";
           if($estado=="Inactivo")
                $color="#FFB4A4";    
				?>
              <tr style="background-color:<?php echo $color;?>;font-size:11px">
               
                  <th><?php echo $row['cedula_empleado'];?></th>
                  <th><?php echo $row['nombre'].' '.$row['apellido'];?></th>
                   <th>
				    <?php 
					   $idCiudad=$row['municipio'];
					   $nombreCiudad="";
					   $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$idCiudad'");
					   while($rowC=mysql_fetch_array($sqlCiudad)) {
							$nombreCiudad = $rowC["opcion"];
						}
					   echo $nombreCiudad;
					   
					   
					?>
                    
                  </th>
                  <th><?php echo $row['tipoContrato'];?></th>
                  <th><?php echo $row['tipoEmpleado'];?></th>
                 <th><a href="empleadoDetalle.php?idEmpleado=<?php echo $idEmpleado;?>"><img  src='../img/usuario.png' width='22' height='22' title="Ver Información Empleado">VER</a></th>
                  <?php
				  if($tipoUsuario==1){
				  ?>
                  <th><a href="modificar.php?idEmpleado=<?php echo $idEmpleado;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=190pt,top=20pt,width=1050px,height=600px'); return false;">
                  <img  src='../img/actualizar.png' width='25' height='27' title="Modificar Empleado"></a></th>
                  <th><a href="eliminar.php?idEmpleado=<?php echo $idEmpleado;?>">
                  <img  src='../img/borrar.png' width='28' height='25' title="Eliminar Empleado"></a></th>
                 <?php
				  }
				  else{
				  ?>
                  <th><img  src='../img/actualizar.png' width='25' height='27' title="No puede Modificar Empleado"></th>
                  <th><img  src='../img/borrar.png' width='28' height='25' title="No puede Eliminar Empleado"></th>
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
                <th>Nº Identificación</th>
                  <th>Nombre</th>
                  <th>Municipio</th>
                  <th>Contrato</th>
                  <th>Cargo</th>
                  <th>Ver Empleado</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                </tr>
                </tfoot>
              </table>
              </div>
               </div>
          </div>        
       </section>      
   </div>
  <!-- /.content-wrapper -->

  <
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
<?php
  }
  else{
    echo "<script language='javascript'> 
             alert('Usuario no tiene acceso a empleados...!!');
             location.href='../perfil/perfil.php' </script>";
    }?>
</body>
</html>
