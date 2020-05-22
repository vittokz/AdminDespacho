<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	  $usuario = $_SESSION["usuario"]; 
	  $numComprobante=$_GET['numComprobante'];
	   
	  $sqlN="select * from des_pagos_mensuales where numComprobante like '$numComprobante'";
		$resultN=mysql_query($sqlN) or die('<center>No se consulto Comprobante!!..</center>');
		while($rowN = mysql_fetch_array($resultN))
		  {
            $fechaInicial=$rowN["fechaPagada"];
			$fechaFinal=$rowN["fechaFinal"];
		  }
		  mysql_free_result($resultN);
	  echo "<center>
	  <table width='80%' border=1 style='border-collapse:separate;border-spacing:5px; '>
									<tr align='center'>
										<td colspan='6'><img src='../img/viacpro.png' width='20%'></td>
									</tr>
	                                <tr align='center'>
									   <td colspan='6'>PERIODO DE PAGO: ".$fechaInicial."/".$fechaF." COMPROBANTE DE PAGO N°: ".$numComprobante."</td>
									</tr>
	  								<tr align='CENTER' style='font-weight:bold; background-color:#039CD2; color:#FFFFFF'>
										<td width='150%'>Nombre</td> 
										<td width='100%'>Identidad</td>
										<td width='100%'>Descripcion</td>
								    	<td width='250%'>Detalle</td>
										
										<td width='80%'>Valor</td>
										<td width='80%'>Imprimir</td>
									</tr>
							";
		$sql2="select cedula_empleado,nombre,apellido from des_empleado where estado like 'Activo'";
		$result2=mysql_query($sql2) or die('<center>No se consulto empleado!!..</center>');
		while($row2 = mysql_fetch_array($result2))
		  {
			$nomEmpleado=$row2["nombre"]." ".$row2["apellido"];
            $identidad=$row2["cedula_empleado"];
    	            $cadena="";$valorTotal=0;$ban=0;
					$sqlPagos="select fechaPagada,fechaFinal,descripcion,detalle,valor,diasTrab,usuarioRegistra from des_pagos_mensuales where numComprobante like '$numComprobante' and idDependiente like '$identidad'";
					$result=mysql_query($sqlPagos) or die('<center>No se consulto pagos!!..</center>');
						while($row = mysql_fetch_array($result))
							{
								$ban=1;
								$fechaPagada=$row["fechaPagada"];
								$fechaFinal=$row["fechaFinal"];
								$descripcion=$row["descripcion"];
								$detalle=$row["detalle"];
								$valor=$row["valor"];
								$diasTrab=$row["diasTrab"];
								$usuarioRegistra=$row["usuarioRegistra"];
								$cadena=$cadena.$detalle;
								$valorTotal=$valorTotal+$valor;
						    }	
							mysql_free_result($result);
							if($ban==1){
									echo"
									<tr align='RIGHT'>
										<td>".$nomEmpleado."</td>
										<td>".$identidad."</td>								
										<td>".$descripcion."</td>	
										<td>".$cadena."</td>
									
										<td> $ ".number_format($valorTotal)."</td>
										<td> <a href='generaRecibo.php?numComprobante=".$numComprobante."&identidad=".$identidad."'>Imprimir<a></td>
									</tr>";		
							}
		}
		mysql_free_result($result2);
			  
		echo "</table></center>";
			

		
	  