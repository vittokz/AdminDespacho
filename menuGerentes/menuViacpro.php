<!-- sidebar menu: : style can be found in sidebar.less -->

<?php

   require_once ('../conexion.php');

   if(!isset($_SESSION)) { session_start(); } 

     $usuario=$_SESSION["usuario"];

     $sql=mysql_query("SELECT * FROM des_usuario WHERE nombre_usua like '$usuario' and estado_usuario like 'Activo'");

        while($row=mysql_fetch_array($sql)) {

       

          $tipoUsuario = $row["tipo_usuario"];

	  	  }

       mysql_free_result($sql);

   if($tipoUsuario==1){

?>

<ul class="sidebar-menu" data-widget="tree">

   

       

   <li>

     <a href="../perfil/perfil.php">

       <i class="fa fa fa-user"></i>

       <span>Perfil</span>

       <span class="pull-right-container">

       

       </span>

     </a>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa fa-book fa-fw"></i> <span>Alertas</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

       <li><a href="../alertas/alertas.php"><i class="fa fa-circle-o"></i> Crear Alerta</a></li>

        <li><a href="../alertas/listaAlertas.php"><i class="fa fa-circle-o"></i> Ver Alertas</a></li>

      

     </ul>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa-th"></i> <span>Procesos</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

       <li><a href="../empleados/empleado.php"><i class="fa fa-circle-o"></i> Empleados</a></li>

        <li><a href="../clientes/crearClientes.php"><i class="fa fa-circle-o"></i> Crear Cliente</a></li>

        <li><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>

         <li><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>

         <li><a href="../radicado/radicado.php"><i class="fa fa-circle-o"></i> Radicado</a></li> 

     </ul>

   </li>



   <li class="treeview">

     <a href="">

       <i class="fa fa-book fa-fw"></i><span>Planes</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

        <li><a href="../planes/planesActivos.php"><i class="fa fa-circle-o"></i>Activos</a></li>

        <li><a href="../planes/planesInactivos.php"><i class="fa fa-circle-o"></i>Inactivos</a></li>

       

     </ul>

   </li>



   <li>

     <a href="../documentos/documentos.php">

       <i class="fa fa-bar-chart"></i> <span>Documentos</span>

       <span class="pull-right-container">

        

       </span>

     </a>



   </li>

   <li>

     <a href="../reportes/reportes.php">

       <i class="fa fa-bar-chart"></i> <span>Reportes</span>

       <span class="pull-right-container">

        

       </span>

     </a>

    

   </li>

   <li>

     <a href="../soporte/soporte.php">

       <i class="fa fa-gavel"></i> <span>Soporte</span>

       <span class="pull-right-container">

        

       </span>

     </a>

     

   </li>

   <li>

<a href="../noticias/noticias.php">

  <i class="fa fa fa-book fa-fw"></i> <span>Noticias</span>

  <span class="pull-right-container">

   

  </span>

</a>



</li>

   <li class="treeview">

     <a href="">

       <i class="fa fa-credit-card"></i> <span>Contabilidad</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

        <li><a href="../contabilidad/ingresos.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>

        <li><a href="../contabilidad/egresos.php"><i class="fa fa-circle-o"></i>Pago nómina</a></li>

        <li><a href="../contabilidad/egresosComprobante.php"><i class="fa fa-circle-o"></i>Egresos</a></li>

        <li><a href="../factura/factura.php"><i class="fa fa-circle-o"></i>Factura</a></li>

     </ul>

   </li>



   <li>

     <a href="../usuarios/usuarios.php">

       <i class="fa fa-user-o "></i> <span>Usuarios</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li>

     <a href="../usuariosClientes/usuarios.php">

       <i class="fa fa-user-md"></i> <span>Usuarios Clientes</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li>

     <a href="../mensajes/mensajes.php">

       <i class="fa fa-mail-reply-all"></i> <span>Mensajes</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li>

     <a href="../asesores/asesores.php">

       <i class="fa fa-user-o "></i> <span>Asesores</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa-credit-card"></i> <span>Página Web</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

        <li><a href="../dependientesPagina/dependientes.php"><i class="fa fa-circle-o"></i> Dependientes</a></li>

        <li><a href="../dependientesPagina/asesores.php"><i class="fa fa-circle-o"></i> Asesores</a></li>

        <li><a href="../dependientesPagina/abogados.php"><i class="fa fa-circle-o"></i> Abogados</a></li>

        <li><a href="../dependientesPagina/Cotizaciones.php"><i class="fa fa-circle-o"></i> Cotizaciones</a></li>
        <li><a href="../dependientesPagina/registroAbogados.php"><i class="fa fa-circle-o"></i> Registro Abogados</a></li>
     </ul>

   </li>



    <li class="header"></li>

 

 </ul>

 <?php

   }



   //permisos asesores comerciales 

   if($tipoUsuario==3){

?>

<ul class="sidebar-menu" data-widget="tree">

   

       

   <li>

     <a href="../perfil/perfil.php">

       <i class="fa fa fa-user"></i>

       <span>Perfil</span>

       <span class="pull-right-container">

       

       </span>

     </a>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa fa-book fa-fw"></i> <span>Alertas</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

       <li><a href="../alertas/alertas.php"><i class="fa fa-circle-o"></i> Crear Alerta</a></li>

        <li><a href="../alertas/listaAlertas.php"><i class="fa fa-circle-o"></i> Ver Alertas</a></li>

      

     </ul>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa-th"></i> <span>Procesos</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">


    <li><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>

         <li><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>

         <li><a href="../radicado/radicado.php"><i class="fa fa-circle-o"></i> Radicado</a></li> 

     </ul>

   </li>



  



   <li>

     <a href="../documentos/documentos.php">

       <i class="fa fa-bar-chart"></i> <span>Documentos</span>

       <span class="pull-right-container">

        

       </span>

     </a>



   </li>

  
   <li>

<a href="../soporte/soporte.php">

  <i class="fa fa-gavel"></i> <span>Soporte</span>

  <span class="pull-right-container">

   

  </span>

</a>



</li>
   <li>

     <a href="../mensajes/mensajes.php">

       <i class="fa fa-mail-reply-all"></i> <span>Mensajes</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li>

     <a href="../asesores/asesores.php">

       <i class="fa fa-user-o "></i> <span>Asesores</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

   <li class="header"></li>

 

 </ul>



<?php



   }



  //permisos asesores Digitadores

  if($tipoUsuario==4){

  ?>

   <ul class="sidebar-menu" data-widget="tree">

   

       

   <li>

     <a href="../perfil/perfil.php">

       <i class="fa fa fa-user"></i>

       <span>Perfil</span>

       <span class="pull-right-container">

       

       </span>

     </a>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa fa-book fa-fw"></i> <span>Alertas</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

       <li><a href="../alertas/alertas.php"><i class="fa fa-circle-o"></i> Crear Alerta</a></li>

        <li><a href="../alertas/listaAlertas.php"><i class="fa fa-circle-o"></i> Ver Alertas</a></li>

      

     </ul>

   </li>

   <li class="treeview">

     <a href="">

       <i class="fa fa-th"></i> <span>Procesos</span>

       <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

       </span>

     </a>

     <ul class="treeview-menu">

        <li><a href="../clientes/crearClientes.php"><i class="fa fa-circle-o"></i> Crear Cliente</a></li>

        <li><a href="../clientes/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>

         <li><a href="../juzgados/juzgados.php"><i class="fa fa-circle-o"></i> Juzgados</a></li>

         <li><a href="../radicado/radicado.php"><i class="fa fa-circle-o"></i> Radicado</a></li> 

     </ul>

   </li>



  

  

   <li>

     <a href="../mensajes/mensajes.php">

       <i class="fa fa-mail-reply-all"></i> <span>Mensajes</span>

       <span class="pull-right-container">

       

       </span>

       

     </a>

   

   </li>

  

    <li class="header"></li>

 

 </ul>

  <?php

   }

 ?>