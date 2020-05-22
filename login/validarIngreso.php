<HTML>
<HEAD>
<TITLE>.::Validacion datos usuarios::.</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (recibo.jpg) -->
<div align="center">
  <?php  
      	session_start();
    require_once("../conexion.php");
      $usuario=$_POST['usuario'];
	  $clave=$_POST['clave'];
     
        
	$sql ="select * FROM des_usuario WHERE nombre_usua like '$usuario' and clave_usuario like '$clave' and estado_usuario like 'Activo'";
	//Sentencia sql a realizar
	 $result= mysql_query($sql) or die("No se consulto en usuarios");//Ejecuta la sentencia sql.
    	 $result1 = mysql_num_rows ($result);
     	
          while($row=mysql_fetch_array($result)){
						$tipoUsu=$row["tipo_usuario"];
                        //usuario root y gerentes
						if($tipoUsu==1 || $tipoUsu==2){
							$_SESSION["autentificado"]= "SI";
							date_default_timezone_set('America/Bogota'); 
							$fecha= date("Y-m-d g:i a");
							$_SESSION["usuario"] = $usuario;
							echo "<script language='javascript'> location.href='../index.php' </script>";
						}

						//usuario asesores
						if($tipoUsu==3){
							$_SESSION["autentificado"]= "SI";
							date_default_timezone_set('America/Bogota'); 
							$fecha= date("Y-m-d g:i a");
							$_SESSION["usuario"] = $usuario;
							echo "<script language='javascript'> location.href='../index.php' </script>";
						}

						if($tipoUsu==4){
							session_start();
							$_SESSION["autentificado"]= "SI";
							date_default_timezone_set('America/Bogota'); 
							$fecha= date("Y-m-d g:i a");
							$_SESSION["usuario"] = $usuario;
							echo "<script language='javascript'> location.href='../index.php' </script>";
						}
					



		  			
	    		   
						
                        
           }
		if($result1 == 0){
			
			echo "<script language='javascript'> 
			alert('Validacion de datos incorrecta...!!');
			location.href='../login.html' </script>";
       		
	    }
    mysql_free_result($result);
   ?>
</div>
</BODY>
</HTML>