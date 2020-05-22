<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
	
	   $idActuacion=$_GET["idActuacion"];
	   $idProceso=$_GET["idProceso"];
	   
	    $sql="SELECT * FROM des_actuaciones where idActuacion like '$idActuacion'";
		$resul=mysql_query($sql) or die ("No hay datos");
		  while($row = mysql_fetch_array($resul)){
				$idActuacion=$row['idActuacion'];
				$fecha=$row['fecha'];
				$tipo=$row['tipo'];
				$actuacion=$row['actuacion'];
		  }
		  mysql_free_result($resul);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Subir fotos o archivos::.</title>
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


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1> Procesos\Actuación </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Actuación</h3>
            </div>
          
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
               <tr style="background:#E5E5E5">
                  <th>Fecha</th>
                  <th style="color:#069"><?php echo $fecha;?></th>
                  <th>Tipo Actuación</th>
                  <th style="color:#069"><?php echo $tipo;?></th>
                  <th>Descripción Actuación</th>
                  <th style="color:#069"><?php echo $actuacion;?>
                  </th>
               </tr>
              </table> 
              <br>
              <form name="fotos" method="post" enctype="multipart/form-data" action="registroFoto.php">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Seleccione Archivo</th>
                  <th><input id="oculto" name="oculto" type="hidden" value="<?php echo $idProceso;?>">
                     <input id="ocultoIdActuacion" name="ocultoIdActuacion" type="hidden" value="<?php echo $idActuacion;?>">
                     <input id="archivo" name="archivo" type="file" class="form-control" required>
                   </th>
               </tr>
             </table>   
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Subir Archivo</button>
              </div>
             </div>
            </form>
              <div id="resultado">
				 
               </div>
            </div>

            </div>
           </div> 
          </div> 
          
           <?php
		       $sql="SELECT * FROM des_fotosactuacion where idActuacion like '$idActuacion' order by fechaRegistro ASC";
		       $resul=mysql_query($sql) or die ("No hay datos");
			   $i=0;
		   ?>
           <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
                  <th></th>
                  <th>Fecha Registro</th>
                  <th>Nombre Archivo</th>
                  <th>Ver</th>
                  <th>Eliminar</th>
                </tr>
                </thead> 
                <tbody>
                 <?php
				 while($row = mysql_fetch_array($resul)){
					$idFoto= $row['idFoto'];
					$idActuacion= $row['idActuacion'];
					$nombre=$row['nombre'];
					$i++;
				?>
                <tr style="font-size:11px">
                  <th><?php echo $i;?></th>
                  <th><?php echo $row['fechaRegistro'];?></th>
                  <th><?php echo $row['nombre'];?></th>
                  <th align="right"><a target="_blank" href="img/actuaciones<?php echo $idActuacion;?>/<?php echo $nombre;?>" target="popup"
onClick="window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=330pt,top=50pt,width=700px,height=550px'); return false;">
                 <img  src='../img/ver.png' width='32' height='26' title="Ver archivo"></a>
                    </th>
                  <th>
                 <?php
				  if($tipoUsuario==1){
				  ?> 
                  <a style="text-decoration:none" href="eliminarFoto.php?idFoto=<?php echo $idFoto;?>&idProceso=<?php echo $idProceso;?>&idActuacion=<?php echo $idActuacion;?>">
                   <img  src='../img/borrar.png' width='28' height='22' title="Eliminar Foto">
                  </a>
                <?php
				  }
				  else{
				?> 
                 <img  src='../img/borrar.png' width='28' height='22' title="Eliminar Foto">
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
       		      <th></th>
                  <th>Fecha Registro</th>
                  <th>Nombre Archivo</th>
                  <th>Ver</th>
                  <th>Eliminar</th>
                </tr>
                </tfoot>
              </table>
            </div>  
               </div>
          </div>     
            </div>
          </div>        
       </section>      



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