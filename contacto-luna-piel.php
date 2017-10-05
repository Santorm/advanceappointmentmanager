<!DOCTYPE HTML>
<html lang="es">
<head>
<title>Luna Piel Dermatología | Contacto Quito-Ambato</title>
<meta name="description" content="¿Tienes dudas sobre el cuidado de tu piel? Queremos responder a tus preguntas. Ponte en contacto para pedir una cita o responder a tus inquietudes sobre nuestros tratamientos estéticos y dermatológicos"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="/imagenes/favicon-32x32.png" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/menu_header_footer.css">
<link rel="stylesheet" type="text/css" href="css/contact_estilos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script defer type="text/javascript" src="js/menu_mob.js"></script>
<script defer type="text/javascript" src="js/cont_val.js"></script>
<script defer src='https://www.google.com/recaptcha/api.js?hl=es'></script>
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
<div id="contenedor">
<header>
<?php include "files/header_lp.html" ?>	
</header>
<section id="contenedor_formul">
<h2 id="tit_contacto">PONTE EN<br><span>CONTACTO</span></h2>
<p id="indicaciones">Rellena el formulario o envíanos directamente un correo. Te contestaremos lo más pronto posible.</p>
<div id="contacto">
<div id="caja_form">
	<form id="formulario_contacto" onsubmit="ga('send', 'event', 'formularios', 'enviar', 'contacto web');">
	<img id="icono_nombre" src="imagenes/iconos_nombre_formulario.png">
	<input class="form_confirm" id="form_nombre" name="nombre" type="text" placeholder="nombre y apellido" required><br>
	<img id="icono_tel" src="imagenes/iconos_telf_footer.png">
	<input class="form_confirm" id="form_tel" name="telefono" type="tel" placeholder="teléfono" required><br>
	<img id="icono_email" src="imagenes/iconos_email_footer.png">
	<input class="form_confirm" name="emailremitente" id="form_email" type="email" placeholder="e-mail" required><br>
	<img id="icono_mensaje" src="imagenes/iconos_mensaje_formulario.png">
	<textarea class="form_confirm" id="form_mensaje" name="mensaje" type="text" placeholder="escribe aquí tu mensaje" required></textarea><br>
	<input type="hidden" id="pagina_formulario" name="pagina_formulario" value="PAGINA CONTACTO">
	
	<button id='boton_enviar' onclick="ga('send', 'event', 'formularios', 'enviar', 'contacto web')">ENVIAR</button>

	<span id="notificacion"></span>
	<!-- <img id="boton_enviar" src="imagenes/reserv_cita_gold.png"> -->
	<!-- <input id="boton_enviar" type="image" src="imagenes/reserv_cita_gold.png"> -->
	</form>

	
	<!-- <input id="boton_enviar" type="image" src="imagenes/reserv_cita_gold.png" onclick="validar()"> -->
</div>
<div id="horarios">
	<br>
	<p class="tit_horario" id="tit_horario_1">NUESTROS</p>
	<P class="tit_horario" id="tit_horario_2">HORARIOS DE</p>
	<p class="tit_horario" id="tit_horario_3">ATENCIÓN</P>
	<br><br><br>
	<p class="ciudad_horario">Quito</p>
	<p class="dias_horario">Lunes a Jueves: 10h00 - 19h30</p>
	<p class="dias_horario">Viernes: 10h00 - 18h00</p>
	<p class="dias_horario">Sábados: 10h00 - 13h30</p>
	<br><br>
	<p class="ciudad_horario">Ambato</p>
	<p class="dias_horario">Martes a Viernes: 15h00 - 18h00</p>
	<p class="dias_horario">*Sábados: 10h00 - 18h00</p>
	<p id="atencion">*Atención consultas cada 15 días</p>
</div>
</div>

</section>

<footer>
	<?php include "files/footer_lp.html" ?>	
</footer>
</div>
</body>
</html>