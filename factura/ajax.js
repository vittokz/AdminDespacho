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
function guardarCuentaCobro(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs

	tipoCuenta=document.cuentaCobro.tipo.value;
	idCliente=document.cuentaCobro.idCliente.value;
	empresa=document.cuentaCobro.empresa.value;
	medio=document.cuentaCobro.medio.value;
	fechaEla=document.cuentaCobro.fechaEla.value;
	fechaVence=document.cuentaCobro.fechaVence.value;
	ccEmpleado=document.cuentaCobro.vendedor.value;
	idPlan=document.cuentaCobro.idPlan.value;
	nomPlan=document.cuentaCobro.nomPlan.value;
	valorPlan=document.cuentaCobro.valorPlan.value;
	descuento=document.cuentaCobro.descuento.value;
	fechaInicial=document.cuentaCobro.fechaInicial.value;
	fechaFin=document.cuentaCobro.fechaFin.value;
	idContrato=document.cuentaCobro.idContrato.value;
	vendedor=document.cuentaCobro.vendedor.value;
	
	if(fechaFin =="")
	{
		alert("Fecha final es un campo necesario!!!");
    }
	else{
	    ajax=objetoAjax();
	    //registro.php
		ajax.open("POST", "generaCuentaCobro.php",true);
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
		ajax.send("tipoCuenta="+tipoCuenta+"&idCliente="+idCliente+"&empresa="+empresa+"&medio="+medio+"&fechaEla="+fechaEla+"&fechaVence="+fechaVence+"&ccEmpleado="+ccEmpleado+"&idPlan="+idPlan+"&nomPlan+"+nomPlan+"&valorPlan="+valorPlan+"&descuento="+descuento+"&fechaInicial="+fechaInicial+"&fechaFin="+fechaFin+"&idContrato="+idContrato+"&vendedor="+vendedor) 
      }
	}


//fin liquidar

//buscar cedula
function buscarCedula(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  identidad=document.busqueda.cliente.value;
  
   ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "buscarEmpresa.php",true);
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


