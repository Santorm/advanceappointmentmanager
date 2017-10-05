<?php  ?>

<!DOCTYPE HTML>
<html lang="es">
<head>
<title>Luna Piel | Tratamientos Dermatología | Clínica-Quirúrgica-Estética</title>
<meta name="description" content="Descubre cómo podemos ayudarte a mantener tu piel sana y jóven. Conoce las principales enfermedades y tratamientos en dermatología clínica, estética y quirúrgica."/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="/imagenes/favicon-32x32.png" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/menu_header_footer.css">
<link rel="stylesheet" type="text/css" href="css/tratamientos_estilos.css" media="screen" />
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script defer src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script defer type="text/javascript" src="js/menu_mob.js"></script>
<script defer type="text/javascript" src="js/tab_desp.js"></script>
<!-- ////uso de cookies//// -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script defer src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#eaf7f7",
      "text": "#5c7291"
    },
    "button": {
      "background": "transparent",
      "text": "#56cbdb",
      "border": "#56cbdb"
    }
  },
  "content": {
    "message": "Utilizamos cookies solo para análisis del uso de la página. Si continúa navegando consideramos que acepta el uso de cookies.",
    "dismiss": "Acepto!",
    "link": "Más información"
  }
})});
</script>
</head>
<body>
<div id="overlay"></div>
<header>
<?php include "files/header_lp.html" ?>	
</header>	
<div id="contenedor_trat">
<section id="tratamientos">
	<div id="caja_intro_trat">
		<h2>DERMATOLOGÍA<br><span>Clínica, Quirúrgica y Estética</span></h2>
		<hr>
		<p>Desde una ética médica profesional, en LunaPiel nos especializamos en tratar <strong>desórdenes de piel, pelo y uñas</strong> con varios procedimientos seguros y comprobados. Combinamos los últimos avances tecnológicos en Dermatología con nuestro profundo compromiso en la comprensión de las necesidades de nuestros pacientes.<br>
		Buscamos que experimentes otra forma de cuidar tu piel, y sentirte cada día a gusto con ella. <strong>Sin darte soluciones universales, diseñamos métodos personalizados y de calidad que se adapten a tus propias necesidades</strong>, siendo justamente por ello que funcionan.<br><br>
		A continuación puedes ver los diagnósticos más frecuentes.</p>
	</div>
	<div id="contenido_trat">
	<div id="tab_tratamientos">
			<ul id="lista_trat">
			<a href="?tratamiento=zona_acne#lista_trat"><li name="zona_acne">acné <span> x</span></li></a>
			<a href="?tratamiento=zona_alopecia#lista_trat"><li name="zona_alopecia">alopecia <span> x</span></li></a>
			<a href="?tratamiento=zona_laser#lista_trat"><li name="zona_laser">depilación laser <span> x</span></li></a>
			<a href="?tratamiento=zona_lunares#lista_trat"><li name="zona_lunares">lunares <span> x</span></li></a>
			<a href="?tratamiento=zona_manchas#lista_trat"><li name="zona_manchas">manchas <span> x</span></li></a>
			<a href="?tratamiento=zona_rejuv#lista_trat"><li name="zona_rejuv">rejuvenecimiento <span> x</span></li></a>
			<a href="?tratamiento=zona_rellenos#lista_trat"><li name="zona_rellenos">rellenos <span> x</span></li></a>
			<a href="?tratamiento=zona_rosacea#lista_trat"><li name="zona_rosacea">rosácea <span> x</span></li></a>
			<a href="?tratamiento=zona_verrugas#lista_trat"><li name="zona_verrugas">verrugas <span> x</span></li></a>
		</ul>
	<ul id="zonas_trat">
		<li><img class="zonas" id="zona_acne" src="imagenes/tratamientos/zonas_enf_acne_hover.png" alt="tratamiento acné dermatología"></li>
		<li><img class="zonas" id="zona_alopecia" src="imagenes/tratamientos/zonas_enf_alopecia_hover.png" alt="tratamiento alopecia calvicie dermatología"></li>
		<li><img class="zonas" id="zona_laser" src="imagenes/tratamientos/zonas_enf_laseripl_hover.png" alt="tratamiento láser dermatología"></li>
		<li><img class="zonas" id="zona_lunares" src="imagenes/tratamientos/zonas_enf_lunares_hover.png" alt="tratamiento zonas_enf_lunares_hover dermatología"></li>
		<li><img class="zonas" id="zona_manchas" src="imagenes/tratamientos/zonas_enf_manchas_hover.png" alt="tratamiento manchas dermatología"></li>
		<li><img class="zonas" id="zona_rejuv" src="imagenes/tratamientos/zonas_enf_rejuvenecimiento_hover.png" alt="tratamiento rejuvenecimiento dermatología"></li>
		<li><img class="zonas" id="zona_rellenos" src="imagenes/tratamientos/zonas_enf_rellenos_hover.png" alt="tratamiento rellenos dermatología"></li>
		<li><img class="zonas" id="zona_rosacea" src="imagenes/tratamientos/zonas_enf_rosacea_hover.png" alt="tratamiento rosacea dermatología"></li>
		<li><img class="zonas" id="zona_verrugas" src="imagenes/tratamientos/zonas_enf_verrugas_hover.png" alt="tratamiento verrugas dermatología"></li>
	</ul>
	
	<div id="desc_trat">
<?php 
if(isset($_GET["tratamiento"])){
	$tratamiento= $_GET["tratamiento"];
include "files/contenido_".$tratamiento.".html"; 
}
?>	
	</div>
	</div>

	</div>

</section>		
</div>	
	<footer>
		<?php include "files/footer_lp.html" ?>	
	</footer>
</body>
</html>