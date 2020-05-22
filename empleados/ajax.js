function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
   try {

		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

	} catch (E) {

		xmlhttp = false;
	}
}
 if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//asignar servicios

//modificar empleados
function asignarServicios(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  idEmpleado=document.asignarServicio.ocultoIdEmpleado.value;
  servicio=document.asignarServicio.servicio.value;
  fecha=document.asignarServicio.fecha.value;
  municipio=document.asignarServicio.estados.value;
  juzgado=document.asignarServicio.juzgado.value;
  
  ajax=objetoAjax();
  if(fecha==""){
	   alert("fecha es un campo obligatorio");
	   ajax.open("POST", "asignarServicio.php",true);
  }
  else{
	 
	  ajax.open("POST", "asignar.php",true);
	  //cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
	  ajax.onreadystatechange=function() {
		  //la funci�n responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
			//LimpiarCampos();
		}
	 }
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores a registro.php para que inserte los datos
		ajax.send("idEmpleado="+idEmpleado+"&servicio="+servicio+"&fecha="+fecha+"&municipio="+municipio+"&juzgado="+juzgado)
  }
}


//insertar clientes
function enviarDatosEmpleado(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  tipo=document.empleado.tipo.value;
  empresa=document.empleado.empresa.value;
  iden=document.empleado.identidad.value;
  nom=document.empleado.nombre.value;
  ape=document.empleado.apellidos.value;
  tel=document.empleado.telefono.value;
  cel=document.empleado.celular.value;
  dir=document.empleado.direccion.value;
  email=document.empleado.email.value;
  municipio=document.empleado.estados.value;
  fecha=document.empleado.fecha.value;
  semestre=document.empleado.semestre.value;
  contrato=document.empleado.contrato.value;
  fechaContrato=document.empleado.fechaContrato.value;
  tipoEmpleado=document.empleado.tipoEmpleado.value;

  salario=document.empleado.salario.value;
  ajax=objetoAjax();
  if(iden=="" || nom=="" || ape==""){
	   alert("Identidad, nombres y apellidos son campos obligatorios");
	   ajax.open("POST", "clientes.php",true);
  }
  else{
	  ajax.open("POST", "registro.php",true);
	  //cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
	  ajax.onreadystatechange=function() {
		  //la funci�n responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
			LimpiarCampos();
		}
	 }
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores a registro.php para que inserte los datos
		ajax.send("iden="+iden+"&nombre="+nom+"&ape="+ape+"&tel="+tel+"&cel="+cel+"&dir="+dir+"&email="+email+"&municipio="+municipio+"&fecha="+fecha+"&tipo="+tipo+"&empresa="+empresa+"&semestre="+semestre+"&contrato="+contrato+"&tipoEmpleado="+tipoEmpleado+"&fechaContrato="+fechaContrato+"&salario="+salario)
  }
}

//modificar empleados
function modificarDatosEmpleado(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  
  idEmpleado=document.empleadoModificar.idEmpleado.value;
  tipo=document.empleadoModificar.tipo.value;
  empresa=document.empleadoModificar.empresa.value;
  iden=document.empleadoModificar.identidad.value;
  nom=document.empleadoModificar.nombre.value;
  ape=document.empleadoModificar.apellidos.value;
  tel=document.empleadoModificar.telefono.value;
  cel=document.empleadoModificar.celular.value;
  dir=document.empleadoModificar.direccion.value;
  email=document.empleadoModificar.email.value;
  municipio=document.empleadoModificar.estados.value;
  fecha=document.empleadoModificar.fecha.value;
  semestre=document.empleadoModificar.semestre.value;
  contrato=document.empleadoModificar.contrato.value;
  fechaContrato=document.empleadoModificar.fechaContrato.value;
  estadoEmple=document.empleadoModificar.estadoEmple.value;
  salario=document.empleadoModificar.salario.value;
  tipoEmple=document.empleadoModificar.tipoEmpleado.value;
  
  ajax=objetoAjax();
  if(iden=="" || nom=="" || ape==""){
	   alert("Identidad, nombres y apellidos son campos obligatorios");
	   ajax.open("POST", "modificar.php",true);
  }
  else{
	 
	  ajax.open("POST", "actualizar.php",true);
	  //cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
	  ajax.onreadystatechange=function() {
		  //la funci�n responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
			//LimpiarCampos();
		}
	 }
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores a registro.php para que inserte los datos
		ajax.send("iden="+iden+"&nombre="+nom+"&ape="+ape+"&tel="+tel+"&cel="+cel+"&dir="+dir+"&email="+email+"&municipio="+municipio+"&fecha="+fecha+"&tipo="+tipo+"&empresa="+empresa+"&idEmpleado="+idEmpleado+"&semestre="+semestre+"&contrato="+contrato+"&estadoEmple="+estadoEmple+"&fechaContrato="+fechaContrato+"&tipoEmple="+tipoEmple+"&salario="+salario)
  }
}


//funci�n para limpiar los campos
function LimpiarCampos(){
 document.empleado.identidad.focus();
 document.empleado.identidad.value="";
 document.empleado.nombre.value="";
 document.empleado.apellidos.value="";
 document.empleado.telefono.value="";
 document.empleado.celular.value="";
 document.empleado.direccion.value="";
 document.empleado.email.value="";
 document.empleado.fecha.value="";
}