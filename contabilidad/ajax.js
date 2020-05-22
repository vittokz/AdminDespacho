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

//enviar liquidar
function liquidar(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs

	fechaFin=document.pagar.fechaFin.value;
	fechaInicial=document.pagar.fechaInicial.value;
	idContrato=document.pagar.idContrato.value;
	idCliente=document.pagar.idCliente.value;
	valorPlan=document.pagar.valorPlan.value;
	empleado=document.pagar.empleado.value;
	idPlan=document.pagar.idPlan.value;
	descuento=document.pagar.descuento.value;
	usuarioRegistro=document.pagar.usuarioRegistro.value;
	if(fechaFin =="")
	{
		alert("Fecha final es un campo necesario!!!");
    }
	else{
	    ajax=objetoAjax();
	    //registro.php
		ajax.open("POST", "registroLiquidaEmpresa.php",true);
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
		ajax.send("fechaFin="+fechaFin+"&fechaInicial="+fechaInicial+"&idContrato="+idContrato+"&idCliente="+idCliente+"&valorPlan="+valorPlan+"&empleado="+empleado+"&idPlan="+idPlan+"&usuarioRegistro="+usuarioRegistro+"&descuento="+descuento) 
      }
	}


//fin liquidar

//enviar liquidar dependiente
function liquidarDependiente(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs

	fechaFin=document.pagar.fechaFin.value;
	fechaInicial=document.pagar.fechaInicial.value;
	idContrato=document.pagar.idContrato.value;
	idCliente=document.pagar.idCliente.value;
	valorPlan=document.pagar.valorPlan.value;
	empleado=document.pagar.empleado.value;
	idPlan=document.pagar.idPlan.value;
	if(fechaFin =="")
	{
		alert("Fecha final es un campo necesario!!!");
    }
	else{
	    ajax=objetoAjax();
	    //registro.php
		ajax.open("POST", "registroLiquidaDependiente.php",true);
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
		ajax.send("fechaFin="+fechaFin+"&fechaInicial="+fechaInicial+"&idContrato="+idContrato+"&idCliente="+idCliente+"&valorPlan="+valorPlan+"&empleado="+empleado+"&idPlan="+idPlan) 
      }
	}


//fin liquidar dependiente

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
		LimpiarCamposEgresos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("descripcion="+descripcion+"&fecha="+fecha+"&valor="+valor) 
}

function LimpiarCamposEgresos(){
	document.compras.fecha.value="";
	document.compras.valor.value="";
	document.compras.descripcion.value=""
	document.compras.fecha.autofocus();
  }

///enviar datos ingreso
function enviarDatosIngreso(){
	//div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  numComprobante=document.ingresos.numComprobante.value;
  identidad=document.ingresos.identidad.value;
  descripcion=document.ingresos.descripcion.value;
  fecha=document.ingresos.fecha.value;
  plan=document.ingresos.plan.value;
  opcion=document.ingresos.opcion.value;

  if(opcion=="Si") {
	municipio=document.ingresos.estados.value;
  }
  else{
	municipio="0"; 
  }
 
  if(fecha=="")
  {
	  alert("Todos los campos son necesarios");
	
  }
  else{
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "registroContrato.php",true);
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
	ajax.send("numComprobante="+numComprobante+"&descripcion="+descripcion+"&fecha="+fecha+"&plan="+plan+"&identidad="+identidad+"&municipio="+municipio) 
}
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

//validamos cedula y nombre
//validar identidad

function validarEmpresa(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
	tipo=document.empresas.tipo.value;
	buscar=document.empresas.buscar.value;
	
   ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "buscarEmpresa.php",true);
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
	ajax.send("buscar="+buscar+"&tipo="+tipo) 
}


//validar empresa otros servicios
function validarEmpresaOtros(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultadoOtros');
	//recogemos los valores de los inputs
	  tipo=document.empresasOtros.tipo.value;
	  buscar=document.empresasOtros.buscar.value;
	  
	 ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "buscarEmpresaOtros.php",true);
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
	  ajax.send("buscar="+buscar+"&tipo="+tipo) 
  }
  

//otros servicios
//validar empleado

function validarEmpleado(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	  tipo=document.empleado.tipo.value;
	  buscar=document.empleado.buscar.value;
	 
	 ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "buscarEmpleadoIndividual.php",true);
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
	  ajax.send("buscar="+buscar+"&tipo="+tipo) 
  }




