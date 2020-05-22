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

//insertar clientes
function enviarDatosCliente(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  tipo=document.clientes.tipo.value;
  empresa=document.clientes.empresa.value;
  iden=document.clientes.identidad.value;
  nom=document.clientes.nombre.value;
  ape=document.clientes.apellidos.value;
  tel=document.clientes.telefono.value;
  cel=document.clientes.celular.value;
  dir=document.clientes.direccion.value;
  email=document.clientes.email.value;
  municipio=document.clientes.estados.value;
  fecha=document.clientes.fecha.value;
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
		ajax.send("iden="+iden+"&nombre="+nom+"&ape="+ape+"&tel="+tel+"&cel="+cel+"&dir="+dir+"&email="+email+"&municipio="+municipio+"&fecha="+fecha+"&tipo="+tipo+"&empresa="+empresa)
  }
}

//modificar clientes
function modificarDatosCliente(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  
  idCliente=document.clientesModificar.idCliente.value;
  tipo=document.clientesModificar.tipo.value;
  empresa=document.clientesModificar.empresa.value;
  iden=document.clientesModificar.identidad.value;
  nom=document.clientesModificar.nombre.value;
  ape=document.clientesModificar.apellidos.value;
  tel=document.clientesModificar.telefono.value;
  cel=document.clientesModificar.celular.value;
 
  dir=document.clientesModificar.direccion.value;
  email=document.clientesModificar.email.value;
   
  municipio=document.clientesModificar.estados.value;
  fecha=document.clientesModificar.fecha.value;
  estado=document.clientesModificar.estado.value;
  ajax=objetoAjax();
  if( nom=="" || ape==""){
	   alert("nombres y apellidos son campos obligatorios");
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
		ajax.send("iden="+iden+"&nombre="+nom+"&ape="+ape+"&tel="+tel+"&cel="+cel+"&dir="+dir+"&email="+email+"&municipio="+municipio+"&fecha="+fecha+"&tipo="+tipo+"&empresa="+empresa+"&idCliente="+idCliente+"&estado="+estado)
  }
}


//funci�n para limpiar los campos
function LimpiarCampos(){
 document.clientes.identidad.focus();
 document.clientes.identidad.value="";
 document.clientes.nombre.value="";
 document.clientes.apellidos.value="";
 document.clientes.telefono.value="";
 document.clientes.celular.value="";
 document.clientes.direccion.value="";
 document.clientes.email.value="";
 document.clientes.fecha.value="";
}