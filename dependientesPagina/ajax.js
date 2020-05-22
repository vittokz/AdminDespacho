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
	//cambiar estado
function cambiarEstado(){
	
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	idCot=document.cambiar.ocultoId.value;
	estado=document.cambiar.estado.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "cambiarEstadoSql.php",true);
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
	  ajax.send("idCot="+idCot+"&estado="+estado) 
	}

//funci�n para limpiar los campos
function LimpiarCampos(){
	document.tareas.descripcion.value="";

}

//registrar cliente empresa

function enviarDatosRegistro(){
	
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	cliente=document.registrar.nombre.value;
	email=document.registrar.email.value;
	telefono=document.registrar.telefono.value;
	ciudad=document.registrar.ciudad.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "insertarClienteEmpSql.php",true);
	//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
	ajax.onreadystatechange=function() {
		//la funci�n responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
		  divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
		  LimpiarCamposR();
	  }
   }
	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores a registro.php para que inserte los datos
	  ajax.send("cliente="+cliente+"&email="+email+"&telefono="+telefono+"&ciudad="+ciudad) 
	}

//funci�n para limpiar los campos
function LimpiarCamposR(){
	document.registrar.nombre.value="";
	document.registrar.email.value="";
	document.registrar.telefono.value="";
	document.registrar.ciudad.value="";

}

//registrar cliente empresa

function editarDatosRegistro(){
	
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultadoA');
	//recogemos los valores de los inputs
	id=document.registrar.id.value;
	cliente=document.registrar.nombre.value;
	email=document.registrar.email.value;
	telefono=document.registrar.telefono.value;
	ciudad=document.registrar.ciudad.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "modificarClienteEmpSql.php",true);
	//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
	ajax.onreadystatechange=function() {
		//la funci�n responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
		  divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
		 
	  }
   }
	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores a registro.php para que inserte los datos
	  ajax.send("cliente="+cliente+"&email="+email+"&telefono="+telefono+"&ciudad="+ciudad+"&id="+id) 
	}
