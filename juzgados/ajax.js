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


function enviarDatosJuzgado(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  nom=document.juzgados.nombre.value;
  municipio=document.juzgados.estados.value;
  ajax=objetoAjax();
  if(nom==""){
	   alert("Nombre es un campo obligatorio");
	   ajax.open("POST", "juzgados.php",true);
  }
  else{
	  ajax.open("POST", "registro.php",true);
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
		ajax.send("nombre="+nom+"&municipio="+municipio)
  }
}

//modificar datos juzgado

function modificarJuzgado(){
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  idJuzgado=document.juzgados.oculto.value;
  nom=document.juzgados.nombre.value;
  municipio=document.juzgados.estados.value;
  ajax=objetoAjax();
  if(nom==""){
	   alert("Nombre es un campo obligatorio");
	   ajax.open("POST", "juzgados.php",true);
  }
  else{
	  ajax.open("POST", "modificar.php",true);
	  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
	  ajax.onreadystatechange=function() {
		  //la función responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
		//	LimpiarCampos();
		}
	 }
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores a registro.php para que inserte los datos
		ajax.send("nombre="+nom+"&municipio="+municipio+"&idJuzgado="+idJuzgado)
  }
}


//función para limpiar los campos
function LimpiarCampos(){
 document.juzgados.nombre.focus();
 document.juzgados.direccion.value="";
 document.juzgados.nombre.value="";
}