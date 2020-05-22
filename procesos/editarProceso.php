<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');

	   $idProceso=$_GET["idProceso"];
	   
	   $sqlProceso=mysql_query("SELECT * FROM des_procesos WHERE idProceso like '$idProceso'");
		while($rowProceso=mysql_fetch_array($sqlProceso)) {
        $radicado = $rowProceso["idRadicado"];
        $idJuzgado = $rowProceso["idJuzgado"];
        $demandado = $rowProceso["demandado"];
        $demandante = $rowProceso["demandante"];
        $descripcion = $rowProceso["descripcion"];
        $tiempo = $rowProceso["tiempo"];
        $valor= $rowProceso["valor"];
        $total= $rowProceso["total"];
        $fechaProceso = $rowProceso["fechaProceso"];
        $iva= $rowProceso["iva"];
        
		}
    mysql_free_result($sqlProceso);	
    
    $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where idJuzgado like '$idJuzgado'");
		  while($rowJ=mysql_fetch_array($sqlJuzgado)) {
			  $nomJuzgado = $rowJ["nombre"];
      }
      mysql_free_result($sqlJuzgado);	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.::Editar Proceso::.</title>
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
        <h1>  Editar Proceso </h1><br>
        <div id="resultado">
              
        </div>
        
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr style="background:#E5E5E5">
                  <th>N° Radicado</th>
                  <th style="color:#069"><?php echo $radicado;?></th>
                 
               </tr>
              </table>
           </div>
           <form name="procesos">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <tr>
                  <th>Radicado</th>
                  <th><input type="text" class="form-control" id="radicado"  value="<?php echo $radicado;?>"></th>
              </tr>
               
                <tr>
                  <th>Despacho</th>
                  <th><input id="oculto" type="hidden" value="<?php echo $idProceso;?>">
                    <select id="juzgado" class="form-control" autofocus>
                    <option selected value="<?php echo $idJuzgado;?>"><?php echo strtoupper($nomJuzgado);?></option>
                  <?php
		      			$nomJuzgado2="";$idJuzgado2="";
					         	$sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where estado like 'Activo' order by ciudad ");
		                while($rowJ=mysql_fetch_array($sqlJuzgado)) {
						     	      $nomJuzgado2 = $rowJ["nombre"];
                         $idJuzgado2=$rowJ["idJuzgado"]
?>
                     
                <option value="<?php echo $idJuzgado2;?>"><?php echo strtoupper($nomJuzgado2);?></option> 
                     
                 <?php	
            }
            ?>
            <option value="<?php echo $idJuzgado;?>"><?php echo strtoupper($nomJuzgado);?></option>
            <?php
						mysql_free_result($sqlJuzgado);
		  		  ?>
                  </select>
                  </th>
        
               </tr>
               <tr>
                  <th>Demandante</th>
                  <th>
                    <input type="text" class="form-control" id="demandante"  value="<?php echo strtoupper($demandante);?>">
                  </th>
               </tr>
               <tr>
                  <th>Demandado</th>
                  <th> <input type="text" class="form-control" id="demandado" value="<?php echo strtoupper($demandado);?>"></th>
              </tr>
              <tr>
                  <th>Fecha de Proceso</th>
                   <th><input name="fechaProceso" id="fechaProceso" type="date" class="form-control" value="<?php echo $fechaProceso;?>"></th>
              </tr>
               <tr>
                  
                  <th>Tiempo(Meses)</th>
                  <th><select id="tiempo" class="form-control">
                    <option value="<?php echo $tiempo;?>"><?php echo $tiempo;?></option>
                     <?php 
                          for($i=6;$i<=36;$i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                          }

                     ?>
                
                  </select>
                  </th>
            </tr> 
                <tr>
                  <th>Valor</th>
                  <th> <input type="number" class="form-control" id="valor" required size="20" value="<?php echo $total;?>"></th>
                  <th>IVA</th>
                  <th><select id="iva" class="form-control">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                  </th>
                </tr>
                
               
             </table>   
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" onClick="modificarProceso(); return false;" title="Modificar proceso">Editar Proceso</button>
              </div>
             </div>
            </form>
          
           
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