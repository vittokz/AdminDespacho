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


function registrarTarea(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  cliente=document.tareas.cliente.value;
  des=document.tareas.descripcion.value;
  fecha=document.tareas.fecha.value;
  hora=document.tareas.hora.value;
  ajax=objetoAjax();
  if(des=="" || hora==""){
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
					LimpiarCamposTareas();
				}
		    }
 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("des="+des+"&fecha="+fecha+"&cliente="+cliente+"&hora="+hora) 
	}
}

function LimpiarCamposTareas(){
	document.tareas.cliente.value="";
	document.tareas.descripcion.value="";
	document.tareas.fecha.value="";
	document.tareas.hora.value="";
}

	//cambiar estado
function cambiarEstado(){
	
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	idTarea=document.cambiar.ocultoId.value;
	estado=document.cambiar.estado.value;
	des=document.cambiar.descripcion.value;
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
	  ajax.send("idTarea="+idTarea+"&estado="+estado+"&des="+des) 
	}

//funci�n para limpiar los campos
function LimpiarCampos(){
	document.tareas.descripcion.value="";

}