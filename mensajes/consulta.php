<?php 
     require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
       $nomUsuario = $_SESSION["usuarioChat"];
	   $auxremite="";$auxRecibe="";$auxMensaje="";$auxFecha=""; $auxIdMensaje="";$auxEstado="";
							$sql="SELECT * FROM des_mensajes where usuarioRemite like '$nomUsuario'";
							   $resul = mysql_query($sql);
								while($row=mysql_fetch_array($resul)) {
									$auxIdMensaje=$row["idMensaje"];
									$auxremite = $row["usuarioRemite"];
									$auxRecibe = $row["usuarioRecibe"];
									$auxMensaje = $row["mensaje"];
									$auxFecha = $row["fechaRegistro"];
									$auxEstado = $row["estado"];
		  }
		  mysql_free_result($resul);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Ver Mensajes::.</title>
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
 <script> setTimeout('document.location.reload()',15000); </script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1> Mensajes </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            
          
             <div class="box-body table-responsive no-padding">
               
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
                  <th>Fecha Envío</th>
                  <th>Mensaje <?php echo $usuario;?></th>
                  <th>Mensaje <?php echo $nomUsuario;?></th>
                </tr>
                </thead> 
                <tbody>
                 <?php
			      $auxremite="";$auxRecibe="";$auxMensaje="";$auxFecha=""; $auxIdMensaje="";$auxEstado="";
					$sql="SELECT * FROM des_mensajes where usuarioRemite like '$nomUsuario' order by fechaRegistro ASC";
				
					   $resul = mysql_query($sql);
						while($row=mysql_fetch_array($resul)) {
							$auxMensaje = $row["mensaje"];
							$auxFecha = $row["fechaRegistro"];
						
		  		?>
                <tr style="font-size:11px; background:#FF9">
                  <th><?php echo $auxFecha;?></th>
                  <th></th>
                  <th><?php echo $auxMensaje;?></th>
                </tr>
             <?php
						}
			 $auxMensaje2="";$auxFecha2=""; 
					$sql2="SELECT * FROM des_mensajes where usuarioRecibe like '$nomUsuario' and usuarioRemite like '$usuario' order by fechaRegistro ASC";
					
					   $resul2 = mysql_query($sql2);
						while($row2=mysql_fetch_array($resul2)) {
							$auxMensaje2 = $row2["mensaje"];
							$auxFecha2 = $row2["fechaRegistro"];
				 
			 ?>
                <tr style="font-size:11px; background:#D6D6D6">
                  <th><?php echo $auxFecha2;?></th>
                  <th><?php echo $auxMensaje2;?></th>
                  <th></th>
             
                </tr>
        	<?php
				 }
			?>
                </tbody>
                <tfoot>
                <tr style="background:#003A75; color:#FFF; font-size:12px">
       		      <th>Fecha Envío</th>
                  <th>Mensaje</th>
                  <th>Mensaje</th>
                </tr>
                </tfoot>
              </table>
              
              
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