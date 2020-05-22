<?php require_once("../../seguridad/seguridad.php");
    require_once ('../../conexion.php');
   if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
     $fecha1=$_POST['fecha1'];
     $fecha2=$_POST['fecha2'];
     $identidad=$_POST['identidad'];
     $nombre=$_POST['nombre'];
     $usuarioPagar=$_POST['usuarioPagar'];
     
      $apellido ="";$claveUsuario ="";$tipoUsuario ="";
       $sql=mysql_query("SELECT * FROM des_usuario WHERE cedula_usuario like '$identidad' and estado_usuario like 'Activo'");
        while($row=mysql_fetch_array($sql)) {
				$nomUsuario = $row["nombre_usua"];
	   	}
    $sql="SELECT * FROM des_liquidar_contratos where periodoInicial between '$fecha1' and '$fecha2' and idenEmpleado like '$identidad'";
     
     $res=mysql_query($sql);
		   		
?>
      <center>
      <a href="descargarRecibo.php?fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>&identidad=<?php echo $identidad;?>&nombre=<?php echo $nombre;?>" target="_blank">
        <img src="../../img/mirar.png" width="5%">Generar Recibo
      </a>
      <a href="descargarReciboCompleto.php?fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>&identidad=<?php echo $identidad;?>&nombre=<?php echo $nombre;?>" target="_blank">
        <img src="../../img/verificar.png" width="5%">Generar Liquidacion Completa
      </a>
   
      <table border="1" width="80%">
                <tr  style="background:#003A75; color:#FFF">
                  <th><center>Empresa</center></th>
                  <th><center>Contrato</center></th>
                  <th><center>Empleado</center></th>
                  <th><center>Valor</center></th>
                 
                </tr>
             <?php
              while($row=mysql_fetch_array($res)) {
                 $idenCliente =$row["idenCliente"];
                 $idContrato =$row["idContrato"];
                 $sqlContrato="SELECT * FROM des_contratos_empresas where id like '$idContrato'";
                
                 $resContrato=mysql_query($sqlContrato);
                 while($rowContrato = mysql_fetch_array($resContrato)){
                    $usuarioRegistro=$rowContrato['usuarioRegistro'];
                   
                   
                 }

                 $sqlC=mysql_query("SELECT * FROM des_cliente where cedula_cliente like '$idenCliente'");
                        while($rowC = mysql_fetch_array($sqlC)){
                           $empresa=$rowC['empresa'];
                        }
                 $idenEmpleado =$row["idenEmpleado"];
                 $sqlEmple="select * from des_empleado where cedula_empleado like '$idenEmpleado'";
                 $resul2=mysql_query($sqlEmple);
                    while($rowEmple=mysql_fetch_array($resul2)) {
                         $nombre = $rowEmple["nombre"]." ".$rowEmple["apellido"];
                    }
                    
                      $valorBono =$row["valorBono"];
                      $total=$total+$valorBono;   
        		        			
             ?>
                <tr>
                  <td><?php echo strtoupper($empresa);?></td>
                  <td><?php echo strtoupper($idContrato);?></td>
                  <td><?php echo strtoupper($nombre);?></td>
                  <td><?php echo "$ ".number_format($valorBono);?></td>
                </tr>
             <?php
              }
        		mysql_free_result($resul);
             ?>
              </table>
              </center>
         
    
  </div>
</div>
</body>
</html>
