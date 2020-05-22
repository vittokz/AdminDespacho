<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $identidad=$_GET["identidad"];
	   
	   if(isset($_GET['identidad'])){ 
		    $identidad=$_GET["identidad"];
       }
	   if(isset($_POST['identidad'])){ 
		    $identidad=$_POST["identidad"];
       }
     
     
       $banP=0;
       $sql="SELECT * FROM des_procesos where idCliente like '$identidad'";
       $resul=mysql_query($sql);
       $numero_procesos = mysql_num_rows($resul);
       while($row = mysql_fetch_array($resul)){
           $banP=1;
        }
       
       mysql_free_result($resul);
     //fin  contar procesos

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
      $empresa = $rowCliente["empresa"];
      $direccion = $rowCliente["dir_cliente"];
			$apellido = $rowCliente["apellido"];
			$tel = $rowCliente["telefono"];
			$cel = $rowCliente["celular"];
			$email = $rowCliente["email"];
			$municipio = $rowCliente["municipio"];
		}
		mysql_free_result($sqlCliente);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Procesos::.</title>
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
        <span class="sr-only">Toggle navigation</span> <span style="font-size:16px; font-weight:800; font-family:Georgia, 'Times New Roman', Times, serif">VIACPRO </span></a>

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
        <h1>Procesos\Cliente</h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
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
                  <th style="color:#069"><?php echo strtoupper($email);?></th>
              </tr>
              </table>
           </div>
          <br><br>			  
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Proceso</h3>
            </div>
            <form name="procesos">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th colspan="2"><input type="text" class="form-control" id="busqueda" placeholder="Juzgado / Despacho" onKeyUp="buscarJuzgado();"></th>
                  <th colspan="4"><div id="resultadoBusqueda"></div></th>
                </tr>  
                
                <tr>
                  <th>Despacho</th>
                  <th><input id="oculto" type="hidden" value="<?php echo $identidad;?>">
                   <input id="ocultoIdProceso" type="hidden" value="<?php echo $idProceso;?>">
                    <select id="juzgado" class="form-control" autofocus>
                  <?php
		      			    $nomJuzgado="";$idJuzgado="";
						         $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where estado like 'Activo' order by idJuzgado ASC ");
		                while($rowJ=mysql_fetch_array($sqlJuzgado)) {
                                    $nomJuzgado = $rowJ["nombre"];
                                    $idJuzgado = $rowJ["idJuzgado"];
                      ?>
                     
                       <option value="<?php echo $idJuzgado;?>"><?php echo strtoupper($idJuzgado."-".$nomJuzgado);?></option>
                     
                 <?php	
						}
						mysql_free_result($sqlJuzgado);
		  		  ?>
                  </select>
                  </th>
                  <th>Radicado</th>
                  <th><input type="text" class="form-control" id="radicado"></th>
                  <th>Clase de Proceso</th>
                  <th><input type="text" class="form-control" id="tipo" size="40"></th>
               </tr>
               <tr>
                  <th>Demandante</th>
                  <th><input type="text" class="form-control" id="demandante" size="40">
                  <input type="hidden" class="form-control" id="email" value="<?php echo $email;?>"></th>
                  <th>Demandado</th>
                  <th> <input type="text" class="form-control" id="demandado" size="40"></th>
                  <th>Fecha de Proceso</th>
                   <th><input name="fechaProceso" id="fechaProceso" type="date" class="form-control"></th>
                </tr>
                 <tr>
                  
                  <th>Tiempo(Meses)</th>
                  <th><select id="tiempo" class="form-control">
                    <option value="6">6</option>
                     <?php 
                          for($i=7;$i<=36;$i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                          }

                     ?>
                
                  </select>
                  </th>
                  <th>Valor</th>
                  <th> <input type="number" class="form-control" id="valor" required size="20"></th>
                  <th>IVA</th>
                  <th><select id="iva" class="form-control">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                  </th>
                </tr>

                </th>
                  <th>Creado</th>
                  <th> <select id="empleado" class="form-control">
                        <?php 
                              $tipoEm=""; 
                              $sqlTipoEmple=mysql_query("SELECT cedula_empleado,nombre,apellido FROM des_empleado where estado like 'Activo' and tipoEmpleado like 'Oficina'");
                               while($rowE=mysql_fetch_array($sqlTipoEmple)) {
                                   $nombre = $rowE["nombre"]." ".$rowE["apellido"];
                                   $cedula = $rowE["cedula_empleado"];
                          ?> 
                                   <option value="<?php echo $cedula;?>"><?php echo strtoupper($nombre);?></option>
                          <?php
                               }
                          ?>
                        </select>
                  </th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                
                </tr>
               
             </table>  
                 <div class="box-footer">
                  <button type="submit" class="btn btn-primary" onClick="registroProceso(); return false;" title="Crear proceso">Crear Proceso</button>
                </div>
               </div>
            </form>
              <div id="resultado">
				   <?php //require_once("consultar.php");?>
               </div>
            </div>
           </div> 
          </div>
          <div class="box">
           <div class="box-body">
           <?php
		     $demandante="";$demandado ="";$idTipoProceso ="";$idJuzgado ="";$idRadicado ="";$etapa="";
        $sqlProceso="SELECT * FROM des_procesos WHERE idCliente like '$identidad' and estado <> 'Eliminado' and idPlan like '0' order by fechaProceso DESC";
        $resultado =mysql_query($sqlProceso);
		   
		   ?>
         <div class="table-responsive">
             <h2>Listado de Procesos del Cliente</h2>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
                  <th>Radicado</th>
                  <th>Juzgado</th>
                  <th>Municipio</th>
                  <th>Departamento</th>
                  <th>Procesos</th>
                  <th>Editar</th>
                  <th>Estados</th>
                  <th>Oficios/Otros</th>
                  <td align="center">Fijación en Lista</td>
                  <th>Audios/Videos</th>
                  <th>Eliminar</th>
                </tr>
                </thead> 
                <tbody>
                <?php
				 while($rowProceso=mysql_fetch_array($resultado)) {
				    $idProceso = $rowProceso["idProceso"];
					$idRadicado = $rowProceso["idRadicado"];
					$idJuzgado = $rowProceso["idJuzgado"];
					$idTipoProceso = $rowProceso["idTipoProceso"];
					$demandado = $rowProceso["demandado"];
					$demandante = $rowProceso["demandante"];
          $fechaProceso = $rowProceso["fechaProceso"];
          $estadoProceso = $rowProceso["estado"];
          if($estadoProceso=="Cerrado"){
             $color="#FAA4A9";
          }
          else{
            $color="#FEFFEC";
          }
      ?>
              
              <tr style="font-size:11px; background:<?php echo $color;?>">
                  
                  <td><?php echo $idRadicado;?></td>
                  <td>
				      <?php 
					   $nomJuzgado="";
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
                
                  <td><a href="procesoSeleccionado.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                  <img  src='../img/ver.png' width='35' height='22' title="Ver detalle de proceso"></a></td>
                 
                 
                  <th>
                      <?php
                          if($estadoProceso=="Cerrado"){
                      ?>
                    
                      <img  src='../img/actualizar.png' width='28' height='25' title="Editar proceso">
                      <?php
                          }
                       else{
                      ?>
                  <a href="editarProceso.php?idProceso=<?php echo $idProceso;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=260pt,top=50pt,width=800px,height=540px'); return false;">
                  <img  src='../img/actualizar.png' width='28' height='25' title="Editar proceso"></a></th>
                    <?php
                       }
                    ?>
                  <td><a href="subirActuacion.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>&cel=<?php echo $cel;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                  <img  src='../img/subir.png' width='28' height='25' title="Subir Actuacion">SUBIR</a></td>

                  <td><a href="subirOficios.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>&cel=<?php echo $cel;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                  <img  src='../img/subir.png' width='28' height='25' title="Subir Actuacion">SUBIR</a></td>



                  <th><a href="fijacionLista.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=950px,height=550px'); return false;">
                  <img  src='../img/subir.png' width='28' height='25' title="Subir Fijación en lista">SUBIR</a></th>
                 
                 
                  <th><a href="subirArchivo.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>&radicado=<?php echo $idRadicado;?>"target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=210pt,top=70pt,width=960px,height=480px'); return false;">
                  <img  src='../img/subir.png' width='28' height='20' title="Ver multimedia">SUBIR</a></th>
                  
                  
                <?php
				  if($tipoUsuario==1){
				  ?>  
                 <td><a href="eliminarProceso.php?identidad=<?php echo $identidad;?>&idProceso=<?php echo $idProceso;?>">
                   <img  src='../img/borrar.png' width='28' height='25' title="No se puede eliminar proceso"></a></td>
                 <?php
				  }
				  else{
				 ?>
                   <td><img  src='../img/borrar.png' width='28' height='32' title="No tiene permiso para eliminar procesos"></td>
                
                <?php
				  }
				?>
                </tr>
               <?php
				 }
			   ?> 
                </tbody>
                <tfoot>
                <tr style="background:#003A75; color:#FFF;font-size:12px">
                  <th>Radicado</th>
                  <th>Juzgado</th>
                  <th>Municipio</th>
                  <th>Departamento</th>
                  <th>Procesos</th>
                  <th>Editar</th>
                  <th>Estados</th>
                  <th>Oficios/Otros</th>
                  <td align="center">Fijación en Lista</td>
                  <th>Audios/Videos</th>
                  <th>Eliminar</th>
                </tr>
                </tfoot>
              </table>
            </div>
               </div>
          </div>             
       </section> 
          
   </div>
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Actividad Reciente</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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
