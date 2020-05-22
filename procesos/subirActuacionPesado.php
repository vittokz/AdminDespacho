<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
	
	   $identidad=$_GET["identidad"];
	   $idProceso=$_GET["idProceso"];
	   $radicado=$_GET["radicado"];
	   $cel=$_GET["cel"];
	   
	    $sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysql_fetch_array($sqlCliente)) {
			$nombre = $rowCliente["nombre"];
			$apellido = $rowCliente["apellido"];
			$municipio = $rowCliente["municipio"];
			$email = $rowCliente["email"];
		}
		mysql_free_result($sqlCliente);
		
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
  <title>.::Subir Actuaciones Mayor tamaño::.</title>
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
        <h1> Procesos\Estados </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr style="background:#E5E5E5">
                  <th>N° Radicado</th>
                  <th style="color:#069"><?php echo $radicado;?></th>
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
           </div>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
             <p style="font-size:18px">Información Actuación</p> 
            </div>
          
             <div class="box-body table-responsive no-padding">
            <form name="actuaciones" method="post" action="registroActuacionPesado.php" enctype="multipart/form-data"> 
            <div class="box-body table-responsive no-padding">
             <table class="table table-hover">
               <tr>
                  <th>N° de Estado</th>
                  <th><input name="email" id="email" type="hidden" value="<?php echo $email;?>">
                  <input name="numEstado" id="numEstado" type="number" class="form-control" required autofocus></th>
                  <th>Fecha</th>
                  <th><input name="fecha" id="fecha" type="date" required class="form-control" required></th>
                 
                  <th><input id="idProceso" name="idProceso" type="hidden" value="<?php echo $idProceso;?>">
                  <input id="identidad" name="identidad" type="hidden" value="<?php echo $identidad;?>">
                  <input id="radicado" name="radicado" type="hidden" value="<?php echo $radicado;?>">
                   <input id="cel" name="cel" type="hidden" value="<?php echo $cel;?>">
                  </th>
               </tr>
               <tr>
                  <th>Descripción Actuación</th>
                  <th colspan="3">
                  <textarea name="actuacion" id="actuacion" cols="10" rows="4"  class="form-control"></textarea></th>
                  <th>Fecha de Auto</th>
                  <th><input name="fechaAuto" id="fechaAuto" size="30" type="date" class="form-control" required></th>
                 
               </tr>
               <tr>
                  <th>Seleccione Archivo</th>
                  <th><input id="archivo" name="archivo" type="file" class="form-control" required></th>
                  <th colspan="2">Fecha Inicio</th>
                  <th colspan="2"><input name="fechaInicio" id="fechaInicio" type="date" class="form-control" required></th>
                  
                  
               </tr>
                  <th>Fecha Fin</th>
                  <th><input name="fechaFin" id="fechaFin" type="date" class="form-control" required></th>
                  
                  <th></th>
                  <th></th>
               <tr>
                 
               </tr>
               <tr>  
                  <th> <div class="box-footer">
                       <button type="submit" class="btn btn-primary">
                       Registrar Actuación</button>
              </div></th>
              <th colspan="5"></th>
               </tr>
              </table> 
              </div>
             </form>
              <div id="resultadoA">
				 
               </div>
              <br>
              
            </div>

            </div>
           </div> 
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