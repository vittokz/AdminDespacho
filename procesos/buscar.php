<?php
//Archivo de conexión a la base de datos
 require_once('../conexion.php');
    
//Variable de búsqueda
$juzgado = $_POST['juzgado'];



//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

if (isset($juzgado)) {
	   $consulta="SELECT idJuzgado,nombre FROM des_juzgados WHERE nombre like '%$juzgado%'";
	 
	   $resul=mysql_query($consulta);
	$filas = mysql_num_rows($consulta);
	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No existe ningún Juzgado </p>";
	} else {
	
		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysql_fetch_array($resul)) {
			$nombre = $resultados['nombre'];
			$idJuzgado = $resultados['idJuzgado'];
		    echo '<p><strong>' .$idJuzgado." - ".$nombre. '</strong><br>';

		}//Fin while $resultados

	} //Fin else $filas	      
}
?>