
<?php
//Configuracion de la conexion a base de datos
require_once ('../conexion.php');
//consulta todos los empleados
   if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"];
	 $numComprobante = $_POST["numComprobante"];
	 $descripcion = $_POST["descripcion"];
	 $fecha = $_POST["fecha"];
	 $fechaInicial = $_POST["fechaInicial"];
	 $fechaFinal = $_POST["fechaFinal"];
?>
   <div class="box">
     <div class="box-body">
	       <div class="table-responsive">
		      
              <h3>Listado De Pagos</h3>
              <table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr style="background:#003A75; color:#FFF;">
								<th><center>Radicado</center></th>
								<th><center>Juzgado</center></th>
								<th><center>Dependiente</center></th>
								<th><center>Fecha</center></th>
						</tr>
					</thead> 
			<?php
					$sql="select idProceso,idEmpleado from des_asignacion_procesos ORDER BY idEmpleado ASC";
					$result=mysql_query($sql) or die('<center>No se realizo la busqueda en asignacion de procesos!!..</center>');
					$número_filas = mysql_num_rows($result);
					while($row = mysql_fetch_array($result)){
						$idProceso = $row["idProceso"];
						$idEmpleado = $row["idEmpleado"];
						
						$sqlE="select nombre,apellido from des_empleado where id_empleado like '$idEmpleado'";
						$resultE=mysql_query($sqlE) or die('<center>No se realizo la busqueda en procesos!!..</center>'); 
						while($rowE = mysql_fetch_array($resultE)){
							$nombre = $rowE["nombre"]." ".$rowE["apellido"];
						}
						mysql_free_result($resultE);

						$sqlP="select idRadicado,idJuzgado,fechaProceso from des_procesos where idProceso like '$idProceso' and fechaProceso between '$fechaInicial' and '$fechaFinal'";
						$resultP=mysql_query($sqlP) or die('<center>No se realizo la busqueda en procesos!!..</center>'); 
						while($rowP = mysql_fetch_array($resultP)){
							$idRadicado = $rowP["idRadicado"];
							$fechaProceso = $rowP["fechaProceso"];
							$idJuzgado = $rowP["idJuzgado"];

							$sqlJ="select nombre from des_juzgados where idJuzgado like '$idJuzgado'";
								$resultJ=mysql_query($sqlJ) or die('<center>No se realizo la busqueda de juzgados!!..</center>'); 
								while($rowJ = mysql_fetch_array($resultJ)){
									$nombreJ = $rowJ["nombre"];
								}
								mysql_free_result($resultJ);
			?>
                          <tbody>
                     		<tr style="font-size:11px">
									<th><?php echo $idRadicado;?></th>
									<th><?php echo strtoupper($nombreJ);?></th>
									<th><?php echo strtoupper($nombre);?></th>
									<th><?php echo $fechaProceso;?></th>
					    	</tr>
			    		  </tbody>
            <?php
                        }
	                }
		            mysql_free_result($result);
            ?>
              
               
						<tfoot>
								<tr style="background:#003A75; color:#FFF;">
										<th><center>Radicado</center></th>
										<th><center>Juzgado</center></th>
										<th><center>Dependiente</center></th>
										<th><center>Fecha</center></th>
								</tr>
						</tfoot>
                    </table>
                 </div>
            </div>
          </div>  


	</body>
</html>
		   
