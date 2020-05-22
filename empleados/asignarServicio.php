<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
	
	   $idEmpleado=$_GET["idEmpleado"];
     $nomCompleto=$_GET["nombre"]." ".$_GET["apellido"];
     $identidad=$_GET["identidad"];
	   
	    $sqlCliente=mysql_query("SELECT * FROM des_cliente WHERE cedula_cliente like '$identidad' and estado like 'Activo'");
        while($rowCliente=mysql_fetch_array($sqlCliente)) {
			$nombre = $rowCliente["nombre"];
			$apellido = $rowCliente["apellido"];
			$municipio = $rowCliente["municipio"];
			$email = $rowCliente["email"];
		}
		mysql_free_result($sqlCliente);
    
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
  <title>.::Asignar Servicio a dependiente::.</title>
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
   <script language="JavaScript" type="text/javascript">
        function opcionOnChange(sel) {
           
            if (sel.value=="3"){
             
                document.asignarServicio.minutos.value="bien";
                document.getElementById("folios")=disabled;
                
            }if(sel.value=="7"){
              document.getElementById("folios")=enable;
              document.getElementById("minutos")=disabled;
            }
}

   </script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
      <section class="content-header" style="width:100%">
        <h1> Asignar Servicios a Dependiente </h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr style="background:#E5E5E5">
                  <th>Nombre</th>
                  <th style="color:#069"><?php echo strtoupper($nomCompleto);?></th>
                  <th>Identidad</th>
                  <th style="color:#069"><?php echo $identidad;?></th>
				     
               </tr>
              
              </table>
           </div>
          <!-- general form elements -->
          <div class="box box-primary">
            <hr>
          
             <div class="box-body table-responsive no-padding">
            <form name="asignarServicio"> 
            <input id="ocultoIdEmpleado" type="hidden" value="<?php echo $idEmpleado;?>">
            <div class="box-body table-responsive no-padding">
             <table class="table table-hover">
              <tr>
              <th>Servicio</th>
                <th colspan="2"><select id="servicio" onChange="opcionOnChange(this)" class="form-control" require> 
                    <option value="NINGUNO">SELECCIONE</option>
                      <?php 
                          $nomServicio="";
                          $sqlServicio=mysql_query("SELECT idServicio,nomServicio FROM des_servicios where estado like 'Activo'");
                         while($rowS=mysql_fetch_array($sqlServicio)) {
                                $idServicio = $rowS["idServicio"];
                                $nomServicio = $rowS["nomServicio"];
                              
                           ?>
                           <option value="<?php echo $idServicio;?>"><?php echo strtoupper($nomServicio);?></option>
                     <?php
                         }
                     ?>
                  </select>       
                
                </th>
                <th>Fecha</th>
                <th><input type="date" id="fecha" class="form-control" require></th>
               </tr>
               <tr>
                  <th>Departamento</th>
                  <th>
                    <div style="width:350px;">
          			    <div><?php generaDepartamentos(); ?></div>
                    </div>
                  </th>
                  
               </tr>
               
                <tr>
                  <th>Municipio</th>
                  <th><div>
               		<select disabled="disabled" name="estados" id="estados" class="form-control">
    					         <option value="0">Selecciona opci&oacute;n...</option>
    			      	</select>
            			</div>
                </th>
                <th>Juzgado</th>
                <th>
                <select id="juzgado" class="form-control" autofocus>
                  <?php
		      			    $nomJuzgado="";$idJuzgado="";
						         $sqlJuzgado=mysql_query("SELECT * FROM des_juzgados where estado like 'Activo' order by ciudad ");
		                while($rowJ=mysql_fetch_array($sqlJuzgado)) {
                                    $nomJuzgado = $rowJ["nombre"];
                                    $idJuzgado = $rowJ["idJuzgado"];
                      ?>
                     
                       <option value="<?php echo $idJuzgado;?>"><?php echo strtoupper($nomJuzgado);?></option>
                     
                 <?php	
						}
						mysql_free_result($sqlJuzgado);
		  		  ?>
                  </select>
                </th>
                <th colspan="2"></th>
                
               </tr>
               <tr>     
                  <th >Minutos Transcritos</th>
                  <th><input type='number' id='minutos' class="form-control"></th>
                  <th >N° Folios</th>
                  <th> <input type='number' id='folios' class="form-control"></th>
               </tr>
                <tr>
                <th colspan="5">
                  <button type="submit" class="btn btn-primary" onClick="asignarServicios(); return false;">
                  Asignar</button>
                </th>
                <th colspan="4"></th>
                </tr>
              </table> 
              </div>
             </form>
              <div id="resultado">
				 
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