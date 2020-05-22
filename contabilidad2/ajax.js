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

//enviar pagos nomina

function enviarPagosNomina(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	numComprobante=document.egresosNomina.numComprobante.value;
	descripcion=document.egresosNomina.descripcion.value;
	fechaInicial=document.egresosNomina.fechaInicial.value;
	fechaFinal=document.egresosNomina.fechaFinal.value;
	if(descripcion =="")
	{
		alert("Todos los campos son necesarios");
	    ajax.open("POST", "egresos.php",true);
	}
	else{
		
		ajax=objetoAjax();
		//uso del medotod POST
	//archivo que realizar� la operacion
	//registro.php
		ajax.open("POST", "registroPagosNomina.php",true);
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
		ajax.send("numComprobante="+numComprobante+"&descripcion="+descripcion+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal) 
      }
	}


//fin pagos nomina


function enviarDatosGasto(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  numGasto=document.compras.numGasto.value;
  descripcion=document.compras.descripcion.value;
  fecha=document.compras.fecha.value;
  valor=document.compras.valor.value;
  ajax=objetoAjax();
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
	ajax.send("numGasto="+numGasto+"&descripcion="+descripcion+"&fecha="+fecha+"&valor="+valor) 
}
///enviar datos ingreso
function enviarDatosIngreso(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  numComprobante=document.ingresos.numComprobante.value;
  identidad=document.ingresos.identidad.value;
  descripcion=document.ingresos.descripcion.value;
  fechaInicial=document.ingresos.fechaInicial.value;
  fechaFinal=document.ingresos.fechaFinal.value;
  valor=document.ingresos.valor.value;
  if(identidad =="" || descripcion =="" || valor=="" || fechaInicial=="" || fechaFinal=="")
  {
	  alert("Todos los campos son necesarios");
	
  }
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "registroIngreso.php",true);
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
	ajax.send("numComprobante="+numComprobante+"&descripcion="+descripcion+"&fechaInicial="+fechaInicial+"&valor="+valor+"&identidad="+identidad+"&fechaFinal="+fechaFinal) 
}
//findatos ingreso

///enviar datos egreso
function enviarDatosEgreso(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	numComprobante=document.egresos.numComprobante.value;
	descripcion=document.egresos.descripcion.value;
	identidad=document.egresos.identidad.value;
	fechaInicial=document.egresos.fechaInicial.value;
	fechaFinal=document.egresos.fechaFinal.value;
	if(descripcion =="")
	{
		alert("Todos los campos son necesarios");
	    ajax.open("POST", "egresos.php",true);
	}
	else{
			ajax=objetoAjax();
			//uso del medotod POST
		//archivo que realizar� la operacion
		//registro.php
			ajax.open("POST", "generarPagos.php",true);
			//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
			ajax.onreadystatechange=function() {
				//la funci�n responseText tiene todos los datos pedidos al servidor
				if (ajax.readyState==4) {
					//mostrar resultados en esta capa
				divResultado.innerHTML = ajax.responseText
					//llamar a funcion para limpiar los inputs
				LimpiarCamposEgr();
			}
		}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			//enviando los valores a registro.php para que inserte los datos
			ajax.send("numComprobante="+numComprobante+"&descripcion="+descripcion+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&identidad="+identidad) 
       }
	}

  function LimpiarCamposEgr(){
	document.egresos.identidad.value="";
	document.egresos.fechaInicial.value="";
	document.egresos.fechaFinal.value="";
	document.egresos.fechaInicial.autofocus();
  }
  //findatos ingreso
//buscar cedula del campo input de nit
//buscar cedula
function buscarCedula(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('mostrarNombre');
  //recogemos los valores de los inputs
  identidad=document.ingresos.identidad.value;
  
   ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "buscar.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarCampos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("identidad="+identidad)
}

//reporte egreso
function reporteEgreso(){
 
	//div donde se mostrará lo resultados
	divResultado = document.getElementById('mostrarNombre');
	//recogemos los valores de los inputs
	
	
	 ajax=objetoAjax();
   
	//uso del medotod POST
	//archivo que realizará la operacion
	//registro.php
	ajax.open("POST", "reportePagos.php",true);
	//cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
	ajax.onreadystatechange=function() {
		//la función responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
		  divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
		  LimpiarCampos();
	  }
   }
	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores a registro.php para que inserte los datos
	  ajax.send()
  }

//fin reporte egreso
//buscar Empleado

//buscar cedula
function buscarEmpleado(){
 
	//div donde se mostrará lo resultados
	divResultado = document.getElementById('mostrarNombre');
	//recogemos los valores de los inputs
	identidad=document.egresos.identidad.value;
	fechaInicial=document.egresos.fechaInicial.value;
    fechaFinal=document.egresos.fechaFinal.value;
	 ajax=objetoAjax();
   
	//uso del medotod POST
	//archivo que realizará la operacion
	//registro.php
	ajax.open("POST", "buscarEmpleado.php",true);
	//cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
	ajax.onreadystatechange=function() {
		//la función responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
		  divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
		  
	  }
   }
	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores a registro.php para que inserte los datos
	  ajax.send("identidad="+identidad+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal)
  }

  function LimpiarCamposE(){
	document.egresos.identidad.value="";
	document.egresos.identidad.autofocus();
  }






