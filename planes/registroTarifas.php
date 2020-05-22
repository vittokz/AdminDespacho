<?php //require_once("../seguridad/seguridad.php");?>
<?php
//Configuracion de la conexion a base de datos
   require_once ('../conexion.php');
	 if(!isset($_SESSION)) { session_start(); } 
	 $usuario = $_SESSION["usuario"]; 
	  $ano=$_POST['ano'];
	  date_default_timezone_set('America/Bogota');
      $hoy = date("Y-m-d");
	 
	  //plan 1
	  $plan1=$_POST['plan1'];
	  $ase1=$_POST['ase1'];
	  $gerC1=$_POST['gerC1'];
	  $gerG1=$_POST['gerG1'];
	  $dep1=$_POST['dep1'];
	  $min1=1;
	  $max1=15;
	  $nomPlan1="Plan Profesional 1";
	  $des1="De 1 a 15 procesos a administrar";
      		
     
	  //plan 2
	  $plan2=$_POST['plan2'];
	  $ase2=$_POST['ase2'];
	  $gerC2=$_POST['gerC2'];
	  $gerG2=$_POST['gerG2'];
	  $dep2=$_POST['dep2'];
	  $min2=16;
	  $max2=30;
	  $nomPlan2="Plan Profesional 2";
	  $des2="De 16 a 30 procesos a administrar";
	  
	  //plan 3
	  $plan3=$_POST['plan3'];
	  $ase3=$_POST['ase3'];
	  $gerC3=$_POST['gerC3'];
	  $gerG3=$_POST['gerG3'];
	  $dep3=$_POST['dep3'];
	  $min3=31;
	  $max3=60;
	  $nomPlan3="Plan Profesional 3";
	  $des3="De 31 a 60 procesos a administrar";
	 
	  //plan 4
	  $plan4=$_POST['plan4'];
	  $ase4=$_POST['ase4'];
	  $gerC4=$_POST['gerC4'];
	  $gerG4=$_POST['gerG4'];
	  $dep4=$_POST['dep4'];
	  $min4=61;
	  $max4=100;
	  $nomPlan4="Plan Profesional 4";
	  $des4="De 61 a 100 procesos a administrar";
	  

	  //plan 5
	  $plan5=$_POST['plan5'];
	  $ase5=$_POST['ase5'];
	  $gerC5=$_POST['gerC5'];
	  $gerG5=$_POST['gerG5'];
	  $dep5=$_POST['dep5'];
	  $min5=101;
	  $max5=150;
	  $nomPlan5="Plan Profesional 5";
	  $des5="De 101 a 150 procesos a administrar";
	  

	   //plan 6
	   $plan6=$_POST['plan6'];
	   $ase6=$_POST['ase6'];
	   $gerC6=$_POST['gerC6'];
	   $gerG6=$_POST['gerG6'];
	   $dep6=$_POST['dep6'];
	   $min6=151;
	   $max6=200;
	   $nomPlan6="Plan Profesional 6";
	   $des6="De 151 a 200 procesos a administrar";
	   

	    //plan 7
	  $plan7=$_POST['plan7'];
	  $ase7=$_POST['ase7'];
	  $gerC7=$_POST['gerC7'];
	  $gerG7=$_POST['gerG7'];
	  $dep7=$_POST['dep7'];
	  $min7=201;
	  $max7=250;
	  $nomPlan7="Plan Profesional 7";
	  $des7="De 201 a 250 procesos a administrar";
	  

	   //plan 8
	   $plan8=$_POST['plan8'];
	   $ase8=$_POST['ase8'];
	   $gerC8=$_POST['gerC8'];
	   $gerG8=$_POST['gerG8'];
	   $dep8=$_POST['dep8'];
	   $min8=251;
	   $max8=300;
	   $nomPlan8="Plan Profesional 8";
	   $des8="De 251 a 300 procesos a administrar";
	   
	 
	    //plan 9
		$plan9=$_POST['plan9'];
		$ase9=$_POST['ase9'];
		$gerC9=$_POST['gerC9'];
		$gerG9=$_POST['gerG9'];
		$dep9=$_POST['dep9'];
		$min9=301;
		$max9=350;
		$nomPlan9="Plan Profesional 9";
		$des9="De 301 a 350 procesos a administrar";
		

		 //plan 10
		 $plan10=$_POST['plan10'];
		 $ase10=$_POST['ase10'];
		 $gerC10=$_POST['gerC10'];
		 $gerG10=$_POST['gerG10'];
		 $dep10=$_POST['dep10'];
		 $min10=351;
		 $max10=400;
		 $nomPlan10="Plan Profesional 10";
		 $des10="De 351 a 400 procesos a administrar";
		 

		  //plan 11
		  $plan11=$_POST['plan11'];
		  $ase11=$_POST['ase11'];
		  $gerC11=$_POST['gerC11'];
		  $gerG11=$_POST['gerG11'];
		  $dep11=$_POST['dep11'];
		  $min11=401;
		  $max11=450;
		  $nomPlan11="Plan Profesional 11";
		  $des11="De 401 a 450 procesos a administrar";
		  

		   //plan 12
			$plan12=$_POST['plan12'];
			$ase12=$_POST['ase12'];
			$gerC12=$_POST['gerC12'];
			$gerG12=$_POST['gerG12'];
			$dep12=$_POST['dep12'];
			$min12=451;
			$max12=500;
			$nomPlan12="Plan Profesional 12";
			$des12="De 451 a 500 procesos a administrar";
			
		 
		  //plan 13
		  $plan13=$_POST['plan13'];
		  $ase13=$_POST['ase13'];
		  $gerC13=$_POST['gerC13'];
		  $gerG13=$_POST['gerG13'];
		  $dep13=$_POST['dep13'];
		  $min13=501;
		  $max13=550;
		  $nomPlan13="Plan Profesional 13";
		  $des13="De 501 a 550 procesos a administrar";
		  

		  //plan 14
		  $plan14=$_POST['plan14'];
		  $ase14=$_POST['ase14'];
		  $gerC14=$_POST['gerC14'];
		  $gerG14=$_POST['gerG14'];
		  $dep14=$_POST['dep14'];
		  $min14=551;
		  $max14=650;
		  $nomPlan14="Plan Profesional 14";
		  $des14="De 551 a 650 procesos a administrar";
		  
		 /*
		  $i=1;
		  for($i=1;$i<=14;$i++){
			$sql="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan.$i','$ano','$min.$i','$max.$i','$des.$i','Activo','$plan.$i','$ase.$i','$gerC.$i','$gerG.$i','$dep.$i','$hoy','$usuario')";
			mysql_query($sql) or die(mysql_error());
			 echo $sql;
		  }
          */
		  $sql="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan1','$ano','$min1','$max1','$des1','Activo','$plan1','$ase1','$gerC1','$gerG1','$dep1','$hoy','$usuario')";
		  mysql_query($sql) or die(mysql_error());
		
		  $sql2="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan2','$ano','$min2','$max2','$des2','Activo','$plan2','$ase2','$gerC2','$gerG2','$dep2','$hoy','$usuario')";
		  mysql_query($sql2) or die(mysql_error());
	
	      $sql3="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan3','$ano','$min3','$max3','$des3','Activo','$plan3','$ase3','$gerC3','$gerG3','$dep3','$hoy','$usuario')";
     	  mysql_query($sql3) or die(mysql_error());

		  $sql4="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan4','$ano','$min4','$max4','$des4','Activo','$plan4','$ase4','$gerC4','$gerG4','$dep4','$hoy','$usuario')";
		  mysql_query($sql4) or die(mysql_error());

		  $sql5="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan5','$ano','$min5','$max5','$des5','Activo','$plan5','$ase5','$gerC5','$gerG5','$dep5','$hoy','$usuario')";
		  mysql_query($sql5) or die(mysql_error());
		  
		  $sql6="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan6','$ano','$min6','$max6','$des6','Activo','$plan6','$ase6','$gerC6','$gerG6','$dep6','$hoy','$usuario')";
		  mysql_query($sql6) or die(mysql_error());
		
		  $sql7="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan7','$ano','$min7','$max7','$des7','Activo','$plan7','$ase7','$gerC7','$gerG7','$dep7','$hoy','$usuario')";
	      mysql_query($sql7) or die(mysql_error());

		  $sql8="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan8','$ano','$min8','$max8','$des8','Activo','$plan8','$ase8','$gerC8','$gerG8','$dep8','$hoy','$usuario')";
	      mysql_query($sql8) or die(mysql_error());
          
          $sql9="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan9','$ano','$min9','$max9','$des9','Activo','$plan9','$ase9','$gerC9','$gerG9','$dep9','$hoy','$usuario')";
		  mysql_query($sql9) or die(mysql_error());

		  $sql10="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan10','$ano','$min10','$max10','$des10','Activo','$plan10','$ase10','$gerC10','$gerG10','$dep10','$hoy','$usuario')";
		  mysql_query($sql10) or die(mysql_error());

		  $sql11="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan11','$ano','$min11','$max11','$des11','Activo','$plan11','$ase11','$gerC11','$gerG11','$dep11','$hoy','$usuario')";
		  mysql_query($sql11) or die(mysql_error());

		  $sql12="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan12','$ano','$min12','$max12','$des12','Activo','$plan12','$ase12','$gerC12','$gerG12','$dep12','$hoy','$usuario')";
		  mysql_query($sql12) or die(mysql_error());

          $sql13="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan13','$ano','$min13','$max13','$des13','Activo','$plan13','$ase13','$gerC13','$gerG13','$dep13','$hoy','$usuario')";
		  mysql_query($sql13) or die(mysql_error());

		  $sql14="INSERT INTO des_planes (nombrePlan,ano,minimo,maximo,descripcion,estado,valor,asesorComercial,gerenteComercial,gerenteGeneral,dependiente,fechaRegistro,usuarioRegistra)VALUES('$nomPlan14','$ano','$min14','$max14','$des14','Activo','$plan14','$ase14','$gerC14','$gerG14','$dep14','$hoy','$usuario')";
		  mysql_query($sql14) or die(mysql_error());

		  echo "<script language='javascript'> 
			alert('Se registro nueva tarifa correctamente!!');
			 location.href='planesTarifas.php' </script>";
	
	            
	            
   


?>

