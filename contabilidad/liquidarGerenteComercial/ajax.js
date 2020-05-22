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
function generarPago(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  fecha1=document.pagos.fecha1.value;
  fecha2=document.pagos.fecha2.value;
  
  ajax=objetoAjax();
  if(fecha1==""){
	   alert("fechas son necesarias");
	   
  }
  else{
	 
	  ajax.open("POST", "generarPago.php",true);
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
		ajax.send("fecha1="+fecha1+"&fecha2="+fecha2)
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