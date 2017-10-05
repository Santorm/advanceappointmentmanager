<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Usuario:</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/menu_header_footer.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script src="http://code.jquery.com/jquery.js"></script>
	<style type="text/css">
		div.wraper {
			text-align: center;
			font-family: 'Montserrat', sans-serif;
			width:500px; 
			/*border:2px solid black; */
			border-radius:5px; 
			text-align:justify; padding:20px; 
			margin:auto;
			/*background-color: aliceblue;*/
		}
		label {
			width: 120px;
			display: inline-block;
		}

		input{
			color: #345555;
    		font-size: 16px;
    		border: solid 1px grey;
    		width: 250px;
    		height: 24px;
    		line-height: 40px;
    		border-radius: 3px;
    		background-color: transparent;
   
		}

	</style>
	<script type="text/javascript">

	$(document).ready(inicio);
	function inicio(){
		//evento que dispara ajax
		$('#btn_alta').on('click', alta_usuario);
		
		//alta de usuarios
	}

	function alta_usuario(){
				//recupero informacion del formulario
			var usuario=$('#usuario').val();
			var nombre=$('#nombre').val();
			var apellidos=$('#apellidos').val();
			var email=$('#email').val();
			var password=$('#password').val();

			if(usuario.trim()=='' || nombre.trim()=='' ||apellidos.trim()=='' ||email.trim()=='' ||password.trim()==''){
			
				$('#notificacion').css('display','block');
				
				$('#notificacion').html("Debe completar todos los campos <br><button id='btn_aceptar_notificacion'>Aceptar</button>");
				$('#btn_aceptar_notificacion').on('click', function(){
				
					$('#notificacion').css('display','none');
				})

			}else{


				$.ajax({
			url: "alta_bbdd_reserva_pacientes.php",
			type: "post",
			data: {'usuario':usuario, 'nombre':nombre, 'apellidos':apellidos, 'email':email, 'password':password,},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					//$("#notificacion").html(respuesta);

				$('#notificacion').css('display','block');
				
				if(respuesta=='Usuario dado de alta correctamente'){
					$('#notificacion').html(respuesta+"<br><button id='btn_aceptar_notificacion'>Entrar</button>");
					$('#btn_aceptar_notificacion').on('click', function(){
						window.location.href = "reserva_login.php";
					$('#notificacion').css('display','none');
				})
				}else{
					$('#notificacion').html(respuesta+"<br><button id='btn_aceptar_notificacion'>Aceptar</button>");
					$('#btn_aceptar_notificacion').on('click', function(){
					$('#notificacion').css('display','none');
				})

				}
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})

		}
	}


	function enviar_mail(){

			var usuario=$('#usuario').val();
			var nombre=$('#nombre').val();
			var apellidos=$('#apellidos').val();
			var email=$('#email').val();
			var password=$('#password').val();

			if(usuario.trim()=='' || nombre.trim()=='' ||apellidos.trim()=='' ||email.trim()=='' ||password.trim()==''){
				$('#notificacion').css('display','block');
				
				$('#notificacion').html("Debe completar todos los campos <br><button id='btn_aceptar_notificacion'>Aceptar</button>");
				$('#btn_aceptar_notificacion').on('click', function(){
					//alert("funcia")
					$('#notificacion').css('display','none');
				})
				
			}else{


				$.ajax({
			url: "enviar_mail.php",
			type: "post",
			data: {'usuario':usuario, 'nombre':nombre, 'apellidos':apellidos, 'email':email, 'password':password},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {

				$('#notificacion').css('display','block');
				
				if(respuesta=='Mensaje enviado correctamente'){
					$('#notificacion').html(respuesta+"<br><button id='btn_aceptar_notificacion'>Entrar</button>");
					$('#btn_aceptar_notificacion').on('click', function(){
						window.location.href = "reserva_login.php";
					$('#notificacion').css('display','none');
				})
				}else{
					$('#notificacion').html(respuesta+"<br><button id='btn_aceptar_notificacion'>Aceptar</button>");
					$('#btn_aceptar_notificacion').on('click', function(){
					$('#notificacion').css('display','none');
				})

				}
				
				
					
							
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})

		}



	}


	</script>
</head>
<body>
<header>
	<?php include "files/header_lp.html" ?>	
</header>
	<div class='wraper'> 
		<h2>Alta de usuarios reserva LunaPiel</h2><br>
		<div id='notificacion'> </div><br>
		<h4 id='notificacion_mail'> </h4><br>
		<form id="formulario_alta" method="post" action="enviar_mail.php" name="formulario_mail"> 
			<label>Usuario: </label><input id="usuario" type="text" name="usuario"><br><br>
			<label>Nombre: </label><input id="nombre" type="text" name="nombre"><br><br>
			<label>Apellidos: </label><input id="apellidos" type="text" name="apellidos"><br><br>
			<label>Email: </label><input id="email" type="email" name="email"><br><br>
			<label>Password: </label><input id="password" type="password" name="password"><br><br>
			<input id='btn_alta' type="button" name="alta" value="Alta usuario" />
		</form><br><br>
		
		<a href="reserva_login.php">Volver a login</a>
	</div><br>
	<footer>
		<?php include "files/footer_lp.html" ?>	
</footer>
</body>
</html>