<?php
 function Conectarse() {
  if(!($link=mysql_connect("localhost","viacpro2018","despacho18"))){
    echo "ERROR CONECTANDO CON EL SERVIDOR DE MYSQL";
    exit();
  }
   if(!mysql_select_db("despacho_viacpro",$link)){
    echo "ERROR SELECCIONANDO LA BASE DE DATOS";
	exit();
   }
    return $link;
 }
Conectarse();
?>

