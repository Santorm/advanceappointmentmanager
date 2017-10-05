<?php

//en este archivo multiidioma, recupero la url enviada desde el enlace ca o es y guardo esa info en cookkies
$lang = "es"; //idioma por defecto
$idiomasPermitidos=array('es','en');//idiomas definidos

if (isset($_GET["lang"])){
	if(in_array($_GET['lang'], $idiomasPermitidos)){
	$lang = $_GET["lang"]; //asignamos el idioma seleccionado
	setcookie('nombrecookie',$lang,time()+3600*24);
	}else{
		header("Location: reserva_login.php?lang=$lang");
	}
}else if(isset($_COOKIE['nombrecookie'])){
		$lang=$_COOKIE['nombrecookie'];
	}else{
		if(in_array(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ,$idiomasPermitidos)) {

		$lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		
		}
	}
include("multiidioma/idiomas_$lang.php");

?>