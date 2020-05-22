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


function registrarLlamada(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  cliente=document.llamadas.cliente.value;
  email=document.llamadas.email.value;
  celular=document.llamadas.celular.value;
  contacto=document.llamadas.contacto.value;
  fecha=document.llamadas.fecha.value;

  ajax=objetoAjax();
  if(cliente=="" || celular==""){
       alert("Todos los campos son obligatorios!!!");
  }
  else{
			//uso del medotod POST
			//archivo que realizar� la operacion
			//registro.php
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
	ajax.send("cliente="+cliente+"&email="+email+"&celular="+celular+"&contacto="+contacto+"&fecha="+fecha) 
	}
}

function LimpiarCampos(){
  document.llamadas.cliente.value="";
  document.llamadas.cliente.focus();
  document.llamadas.email.value="";
  document.llamadas.celular.value="";
  document.llamadas.contacto.value="";
  document.llamadas.fecha.value="";
  document.llamadas.observacion.value="";
}

//buscar llamadas
function buscarLlamada(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultadoLlamadas');
  //recogemos los valores de los inputs
  clienteL=document.buscarLLamada.clienteL.value;
 
  ajax=objetoAjax();
  if(clienteL==""){
       alert("Campos son obligatorios!!!");
  }
  else{
			//uso del medotod POST
			//archivo que realizar� la operacion
			//registro.php
			ajax.open("POST", "buscarLlamadas.php",true);
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
	ajax.send("clienteL="+clienteL) 
	}
}

