<?php require_once("../seguridad/seguridad.php");
     require_once ('../conexion.php');
     if(!isset($_SESSION)) { session_start(); } 
       $usuario=$_SESSION["usuario"];
	
	   $idEmpleado=$_GET["idEmpleado"];
       $sql=mysql_query("SELECT tipo_usuario FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
			$tipoUsuario = $row["tipo_usuario"];
		}

    mysql_free_result($sql);

    //recojo datos del cliente
 
    $sql=mysql_query("SELECT * FROM des_empleado where id_empleado like '$idEmpleado'");
        while($row=mysql_fetch_array($sql)) {
            $identidad=$row['cedula_empleado'];
			      $tipo=$row['tipo'];
            $empresa=$row['empresa'];
            $nombre=$row['nombre'];
			      $municipio=$row['municipio'];
            $apellido=$row['apellido'];
		      	$direccion=$row['dir_empleado'];
			      $tel=$row['telefono'];
            $celular=$row['celular'];
            $email=$row['email'];
            $fechaNa=$row['fecha_naci'];
            $semestre=$row['semestre'];
            $contrato=$row['tipoContrato'];
            $tipoEm=$row['tipoEmpleado'];
            $salario=$row['salario'];
            $fechaContrato=$row['fechaContrato'];
            
		}
		mysql_free_result($sql);
		
		
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
  <title>.::Actualizar Empleado::.</title>
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
      <section class="content-header">
        <h1>Actualizar Datos Empleado</h1><br>
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <div id="resultado">
            
               </div>
            <form name="empleadoModificar">
             <input name="idEmpleado" id="idEmpleado" type="hidden" value="<?php echo $idEmpleado;?>">
             <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Tipo Documento</th>
                  <th><select id="tipo" class="form-control" disabled>
                    <option value="Nit">Nit</option>
                    <option value="C.C">Cedula De Ciudadania</option>
                    <option selected value="<?php echo $tipo;?>"><?php echo $tipo;?></option>
                    
                  </select></th>
                </tr>
                <tr>
                  <th>Nº Identificación</th>
                  <th><input type="text" class="form-control" id="identidad" disabled value="<?php echo $identidad;?>"></th>
                  <th>Tipo</th>
                  <th><select id="tipoEmpleado" class="form-control" required>
                          <option selected value="<?php echo $tipoEm;?>"><?php echo $tipoEm;?></option>
                          <option value="Asesor Comercial">Asesor Comercial</option>
                          <option value="Dependiente Judicial">Dependiente Judicial</option>
                          <option value="Gerente Comercial">Gerente Comercial</option>
                          <option value="Gerente General">Gerente General</option>
                      </select>
                  
                  </th>
                  </tr>
                  <tr>
                  <th>Empresa</th>
                  <th><input disabled type="text" class="form-control" id="empresa" value="<?php echo $empresa;?>"></th>
                  <th>Nombres</th>
                  <th><input type="text" class="form-control" id="nombre" required value="<?php echo $nombre;?>"></th>
                  </tr>
                  <tr>
                  <th>Apellidos</th>
                  <th><input type="text" class="form-control" id="apellidos" required value="<?php echo $apellido;?>"></th>
             
                  <th>Teléfono</th>
                  <th><input type="number" class="form-control" id="telefono" value="<?php echo $tel;?>"></th>
                  </tr>
                  <tr>
                  <th>Celular</th>
                  <th><input type="number" class="form-control" id="celular" value="<?php echo $celular;?>"></th>
                  <th>Dirección</th>
                  <th> <input type="text" class="form-control" id="direccion" value="<?php echo $direccion;?>"></th>
                  </tr>
                  <tr>
                  <th>Emáil</th>
                  <th><input type="email" class="form-control" id="email" value="<?php echo $email;?>"></th>
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
                  <?php
				       $nombreCiudad="";
					   $sqlCiudad=mysql_query("SELECT * FROM lista_estados where id like '$municipio'");
					   while($rowC=mysql_fetch_array($sqlCiudad)) {
							$nombreCiudad = $rowC["opcion"];
						}
				  ?>
               		<select disabled="disabled" name="estados" id="estados" class="form-control">
    					<option value="<?php echo $municipio;?>"><?php echo $nombreCiudad; ?></option>
    				</select>

				</div></th>
               
                  <th>Fecha Nacimiento</th>
                  <th><input type="date" class="form-control" id="fecha" value="<?php echo $fechaNa;?>"></th>
                  </tr>
                  <tr>
                  <th>Contrato</th>
                  <th><select id="contrato" class="form-control" require>
                      <option selected value="<?php echo $contrato;?>"><?php echo $contrato;?></option>
                       <option value="Prestacion Servicios">Prestación Servicios</option>
                       <option value="Termino Indefinido">Termino Indefinido</option>
                       <option value="Medio Tiempo">Medio Tiempo</option>
                       <option value="Tiempo Completo">Tiempo Completo</option>
                      
                        
                      </select>
                  </th>
                  
                  <th>Semestre</th>
                  <th><select id="semestre" class="form-control">
                       <option selected value="<?php echo $semestre;?>"><?php echo $semestre;?></option>';
                        <?php for ($i=1;$i<=10;$i++) 
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        ?> 
                        
                      </select>
                  </th>
                  </tr>
                 <tr>
               
                  <th>Estado</th>
                  <th><select id="estadoEmple" class="form-control">
                        <option selected value="Activo">Activo</option>
                        <option value="Inactivo">Inactivar</option>
                     </select>
                  </th>
                  <th>Fecha Inicio Contrato</th>
                  <th><input type="date" class="form-control" id="fechaContrato" value="<?php echo $fechaContrato;?>"></th>
                
                </tr>
                <tr>
                  <th>Salario</th>
                  <th><input type="number" class="form-control" id="salario" value="<?php echo $salario;?>"></th>
                </tr>
             </table>   
              <div class="box-footer">
                <button type="submit" style="background-color:#1d1a31" class="btn btn-primary" onClick="modificarDatosEmpleado(); return false;">Actualizar</button>
              </div>
             </div>
            </form>
            <br>
               
             </div>
           </div> 
          </div> 
          <br>
                
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