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


function enviar(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  remitente=document.chat.remitente.value;
  destinatario=document.chat.destinatario.value;
  mensaje=document.chat.mensajeChat.value;
  ajax=objetoAjax();
  if(mensaje==""){
       alert("Escriba mensaje");
  }
       else{
			ajax.open("POST", "enviarMensaje.php",true);
			//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
			ajax.onreadystatechange=function() {
				//la funci�n responseText tiene todos los datos pedidos al servidor
				if (ajax.readyState==4) {
					//mostrar resultados en esta capa
					divResultado.innerHTML = ajax.responseText
					//llamar a funcion para limpiar los inputs
					LimpiarCamposTareas();
				}
		    }
 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("remitente="+remitente+"&destinatario="+destinatario+"&mensaje="+mensaje) 
	}
}

function LimpiarCamposTareas(){
	document.tareas.cliente.value="";
	document.tareas.descripcion.value="";
	document.tareas.fecha.value="";
	document.tareas.hora.value="";
}

