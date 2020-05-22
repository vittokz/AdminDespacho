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

//activar plan
function activarPlanEmpresa(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	fechaActivacion=document.activarPlan.fechaActivacion.value;
	id=document.activarPlan.ocultoId.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "activarPlanSql.php",true);
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
	  ajax.send("fechaActivacion="+fechaActivacion+"&id="+id) 
	}
//fin activar plan

//cambiar tipo plan
function cambiarTipoPlan(){
	
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultadoA');
	//recogemos los valores de los inputs
	idContrato=document.cambiar.idContrato.value;
	plan=document.cambiar.plan.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "cambiarTipoPlanSql.php",true);
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
	  ajax.send("idContrato="+idContrato+"&plan="+plan) 
	}
//fin cambiar tipo plan

//buscar juzgado
//buscar cedula
function buscarJuzgado(){
 
	//div donde se mostrará lo resultados
	divResultado = document.getElementById('resultadoBusqueda');
	//recogemos los valores de los inputs
	juzgado=document.procesos.busqueda.value;
	
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
		 // LimpiarCampos();
	  }
   }
	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores a registro.php para que inserte los datos
	  ajax.send("juzgado="+juzgado)
  }


//fin buscar juzgado


//buscar plantilla
function buscarCedula(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  iden=document.busqueda.identidad.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "buscarCedula.php",true);
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
	ajax.send("identidad="+iden) }
//funci�n para limpiar los campos
function LimpiarCampos(){
}

//buscar radicado

function buscarRadicado(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  radicado=document.busqueda.radicado.value;
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "buscarRadicado.php",true);
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
	ajax.send("radicado="+radicado) }
//funci�n para limpiar los campos
function LimpiarCampos(){
}

// asignar proceso

function asignarProceso(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	dependiente=document.asignar.dependiente.value;
	idContrato=document.asignar.oculto.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "asignar.php",true);
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
	  ajax.send("dependiente="+dependiente+"&idContrato="+idContrato) }
  //funci�n para limpiar los campos
  function LimpiarCampos(){
  }


  //activar proceso
   // asignar proceso

function activarProceso(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	fechaActivacion=document.activar.fechaActivacion.value;
	idProceso=document.activar.oculto.value;
	ajax=objetoAjax();
	//uso del medotod POST
   //archivo que realizar� la operacion
   //registro.php
	ajax.open("POST", "activarProcesoSql.php",true);
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
	  ajax.send("fechaActivacion="+fechaActivacion+"&idProceso="+idProceso) 
	}
  //fin activar proceso

//registrar procesos
function registroProceso(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  identidad=document.procesos.oculto.value;
  idProceso=document.procesos.ocultoIdProceso.value;
  idJuzgado=document.procesos.juzgado.value;
  radicado=document.procesos.radicado.value;
  tipo=document.procesos.tipo.value;
  demandante=document.procesos.demandante.value;
  demandado=document.procesos.demandado.value;
  fechaProceso=document.procesos.fechaProceso.value;
  email=document.procesos.email.value;
  tiempo=document.procesos.tiempo.value;
  valor=document.procesos.valor.value;
  iva=document.procesos.iva.value;
  empleado=document.procesos.empleado.value;
  
  cantRadicado = radicado.length;
 // if(cantRadicado<23){
//	alert("Radicado debe tener 23 caracteres..!!!");
	
        
 // }
  //else {
	  
	 if(radicado=="" || demandante=="" || demandado=="" || fechaProceso=="" || valor==""){
		alert("Todos los campos son obligatorios..!!!");
		 }
	 else {
      
  
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
		  ajax.send("identidad="+identidad+"&idJuzgado="+idJuzgado+"&radicado="+radicado+"&tipo="+tipo+"&demandante="+demandante+"&demandado="+demandado+"&fechaProceso="+fechaProceso+"&email="+email+"&tiempo="+tiempo+"&valor="+valor+"&iva="+iva+"&idProceso="+idProceso+"&empleado="+empleado) 
		}

  //}
 }

 //registro procesos nuevos
function registroProcesoNuevos(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	identidad=document.procesos.oculto.value;
	idPlan=document.procesos.idPlan.value;
	idProceso=document.procesos.ocultoIdProceso.value;
	idContrato=document.procesos.idContrato.value;
	idJuzgado=document.procesos.juzgado.value;
	radicado=document.procesos.radicado.value;
	tipo=document.procesos.tipo.value;
	demandante=document.procesos.demandante.value;
	demandado=document.procesos.demandado.value;
	fechaProceso=document.procesos.fechaProceso.value;
	email=document.procesos.email.value;
	empleado=document.procesos.empleado.value;
	cantRadicado = radicado.length;
 //	if(cantRadicado<23){
	 //  alert("Radicado debe tener 23 caracteres..!!!");
	  
 //	}
 //	else {
		
	   if(radicado=="" || demandante=="" || demandado=="" || fechaProceso==""){
		  alert("Todos los campos son obligatorios..!!!");
		   }
	   else {

		  ajax=objetoAjax();
		  //uso del medotod POST
		 //archivo que realizar� la operacion
		 //registro.php
		  ajax.open("POST", "registroNuevos.php",true);
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
			ajax.send("identidad="+identidad+"&idJuzgado="+idJuzgado+"&radicado="+radicado+"&tipo="+tipo+"&demandante="+demandante+"&demandado="+demandado+"&fechaProceso="+fechaProceso+"&email="+email+"&idProceso="+idProceso+"&empleado="+empleado+"&idPlan="+idPlan+"&idContrato="+idContrato) 
		  } 
 //	}	
	}
 //fin registro procesos

//modificar procesos
function modificarProceso(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  radicado=document.procesos.radicado.value; 
  idProceso=document.procesos.oculto.value;
  idJuzgado=document.procesos.juzgado.value;
  demandante=document.procesos.demandante.value;
  demandado=document.procesos.demandado.value;
  fechaProceso=document.procesos.fechaProceso.value;
  tiempo=document.procesos.tiempo.value;
  valor=document.procesos.valor.value;
  iva=document.procesos.iva.value;
  
  cantRadicado = radicado.length;
  //if(cantRadicado<23){
//	alert("Radicado debe tener 23 caracteres..!!!");
 //}

 // else 
  // { 
	ajax=objetoAjax();
	//uso del medotod POST
	//archivo que realizar� la operacion
	//registro.php
	ajax.open("POST", "modificar.php",true);
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
		ajax.send("idProceso="+idProceso+"&idJuzgado="+idJuzgado+"&tiempo="+tiempo+"&valor="+valor+"&demandante="+demandante+"&demandado="+demandado+"&fechaProceso="+fechaProceso+"&iva="+iva+"&radicado="+radicado) 

	//}
}

//modificar procesos nuevos
//modificar procesos
function modificarProcesoNuevos(){
	//div donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	//recogemos los valores de los inputs
	radicado=document.procesos.radicado.value; 
	idProceso=document.procesos.oculto.value;
	idJuzgado=document.procesos.juzgado.value;
	demandante=document.procesos.demandante.value;
	demandado=document.procesos.demandado.value;
	fechaProceso=document.procesos.fechaProceso.value;
		
	cantRadicado = radicado.length;
//	if(cantRadicado<23){
	//  alert("Radicado debe tener 23 caracteres..!!!");
//	}
  
//	else 
//	 { 
	  ajax=objetoAjax();
	  //uso del medotod POST
	  //archivo que realizar� la operacion
	  //registro.php
	  ajax.open("POST", "modificarNuevos.php",true);
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
		  ajax.send("idProceso="+idProceso+"&idJuzgado="+idJuzgado+"&demandante="+demandante+"&demandado="+demandado+"&fechaProceso="+fechaProceso+"&radicado="+radicado) 
  
	//  }
  }


//


//registrar actuaciones
function registrarActuacion(){
  //div donde se mostrar� lo resultados
  divResultado = document.getElementById('resultadoA');
  //recogemos los valores de los inputs
  fecha=document.actuaciones.fecha.value;
  idProceso=document.actuaciones.oculto.value;
  actuacion=document.actuaciones.actuacion.value;

  tipo=document.actuaciones.tipo.value;
  fechaAuto=document.actuaciones.fechaAuto.value;
  
  if(actuacion==""){
	 alert("Actuacion es un campo obligatorio!!!");
	 ajax.open("POST", "procesoSeleccionado.php",true); 
  }
  
  ajax=objetoAjax();
  //uso del medotod POST
 //archivo que realizar� la operacion
 //registro.php
  ajax.open("POST", "registroActuacion.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
  ajax.onreadystatechange=function() {
	  //la funci�n responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarCamposA();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("idProceso="+idProceso+"&actuacion="+actuacion+"&fecha="+fecha+"&tipo="+tipo+"&fechaAuto="+fechaAuto) 
}
//funci�n para limpiar los campos
function LimpiarCamposA(){
	document.actuaciones.actuacion.focus();
	document.actuaciones.actuacion.value="";
}

//funci�n para limpiar los campos
function LimpiarCampos(){
	document.procesos.juzgado.focus();
	document.procesos.radicado.value="";
	document.procesos.tipo.value="";
    document.procesos.demandante.value="";
	document.procesos.demandado.value="";
	document.procesos.descripcion.value="";
	document.procesos.actuaciones.value="";
}
