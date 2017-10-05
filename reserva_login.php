<?php

include("multiidioma/multiidioma.php");
		session_start();
	$notificacion='';
	$nombre='';
	$apellidos='';
	$tipousuario='';
	$usuario='';
	$usuario_conectado='';
	//si existe la variable de sesión de la conexión anterior ir directamente a la pantalla de menu
	if(isset($_SESSION['lunapiel_reserva'])){
		
		// $usuario=$_SESSION['examen'];
		$nombre=$_SESSION['lunapiel_nombre'];
		$apellidos=$_SESSION['lunapiel_apellidos'];
		$tipousuario=$_SESSION['lunapiel_tipousuario'];
		$usuario_conectado=$_SESSION['lunapiel_reserva'];
		//if($_SESSION['tipousuario']=='AD'){
		//	header("location:re.php");
		//}

	}

	// else{
	
	// conexión a la base de datos
	require 'conexion_bbdd_lp.php';

	//comprobar si hemos apretado login
	if (isset($_POST['logon'])){
		//recuperar usuario y password sin espacios en blanco antes y despues
		$usuario=addslashes($_POST['usuario']);
		$password=$_POST['password'];		
		//validar usuario y password informados
		if(trim($usuario)=='' || trim($password)==''){
			$notificacion='Introduzca usuario y password';
		}else{

		//recuperar idusuario y passowrd de la base de datos
	$sql="SELECT password, nombre, apellidos, id_persona, tipousuario FROM pacientes WHERE usuario='$usuario';";
			$result= mysqli_query($conexionLp,$sql) or die (mysqli_error($conexionLp));
					$row = mysqli_fetch_assoc($result);
	 		//validar si passowrd coincide (error en caso contrario)
					if($password ==$row['password']){
						$_SESSION['lunapiel_reserva']=$usuario;
						$_SESSION['lunapiel_nombre']=$row['nombre'];
						$_SESSION['lunapiel_apellidos']=$row['apellidos'];
						$_SESSION['lunapiel_id_persona']=$row['id_persona'];
						$_SESSION['lunapiel_tipousuario']=$row['tipousuario'];

						$nombre=$_SESSION['lunapiel_nombre'];
						$apellidos=$_SESSION['lunapiel_apellidos'];
						$tipousuario=$_SESSION['lunapiel_tipousuario'];
						$usuario_conectado=$_SESSION['lunapiel_examen'];
						if($tipousuario=='AD'){
							header("location:gestionar_cita.php");
						}else{
						header("location:pedir_cita_pacientes.php");
						}
					}else{
						$notificacion= 'Compruebe el usuario o contraseña';
					}
	 		
	 		//alta de la variable de sesión con el id del usuario conectado y redirigir a pantalla de menu

		}
		
		//recuperar idusuario y passowrd de la base de datos

	 		//validar si passowrd coincide (error en caso contrario)
	 		
	 		//alta de la variable de sesión con el id del usuario conectado y redirigir a pantalla de menu
	 			
	}
// }

	if(isset($_POST['logoff'])){
	unset($_SESSION['lunapiel_reserva']);
	unset($_SESSION['lunapiel_nombre']);
	unset($_SESSION['lunapiel_apellidos']);
	unset($_SESSION['lunapiel_tipousuario']);
	header("location:reserva_login.php");
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ingreso Reserva Citas LunaPiel</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/menu_header_footer.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">


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

		.btn_gestionar{
			margin: 20px 0;
			text-align: center;

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
		#texto_seccion_3 {
    		font-size: 1em;
    		font-family: 'Lato', sans-serif;
    		color: #000;
    		line-height: 25px;
    		margin-top: 30px;
    		text-align: justify;
    		margin-right: 30px;
    		font-weight: 300;
		}
	</style>
</head>
<body>
<header>
	<?php include "files/header_lp.html" ?>	
</header>
	<div class='wraper'> 
	<a class='btn_log' id="catalan" href="reserva_login.php?lang=en">English</a>&nbsp&nbsp<a class='btn_log' id="español" href="reserva_login.php?lang=es">Español</a>

			<?php 
			include("multiidioma/log_section_contenido_".$lang.".html"); 
			//cargamos el fichero del idioma
			?>
	
		<h2>LOGIN RESERVA LP</h2><br>
		<div><?php if($tipousuario=='AD'){ echo 'USUARIO ADMINISTRADOR<a href="gestionar_cita.php"><div class="btn_gestionar">'.$gestionar_citas.'</div></a>';}?></div><br>

		<!-- <h4><?php //if($tipousuario=='AD'){ //echo '<a href="gestionar_cita.php">Gestionar Citas</a>';}?></h4> -->
		<!-- <h4><?php //echo $usuario_conectado ?> </h4> -->
		<h4><?php echo $notificacion ?> </h4><br>
		<form method="post" action="#"> 
			<label><?php echo $usuario_trad ?></label><input type="text" name="usuario"><br><br>
			<label><?php echo $contrasenya; ?> </label><input type="password" name="password"><br><br>
			<input class="btn_log" type="submit" name="logon" value="<?php echo $iniciar_sesion ?>" >
			<input class="btn_log" type="submit" name="logoff" value="<?php echo $iniciar_sesion ?>" >
		</form><br><br>

		<a href="reserva_alta.php"><?php echo $click_registro ?></a><br>
		
					
	</div><br>
<footer>
		<?php include "files/footer_lp.html" ?>	
</footer>
</body>


</html>