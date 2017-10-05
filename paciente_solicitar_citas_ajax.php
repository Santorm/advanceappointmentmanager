<?php 
//	session_start()

//RECUPERAR VARIABLE DE SESSION PARA PERSONA
session_start();

if(isset($_SESSION['lunapiel_nombre'])){
		$id_persona=$_SESSION['lunapiel_id_persona'];
}

include "conexion_bbdd_lp.php";






		
	//conexión a la base de datos
	//recuperar opcion de consulta
	//	responsable':responsable, 'datos_ciudad':datos_ciudad, 'combo_tratamiento':combo_tratamiento, 'fecha_calendario':fecha_calendario
	

	//$id_persona=$_POST['id_persona'];
	$id_centro=$_POST['id_centro'];
	$id_servicio=$_POST['id_servicio'];
	$fecha=$_POST['fecha'];
	$id_horario=$_POST['id_horario'];
	//$id_cita='';


////CONSULTA DE REPETIDOS PARA EVITGAR DUPLICAR LA RESERVA /////

$sql2="SELECT id_responsable, id_cita
		FROM citas_disponibles 
		WHERE id_centro=$id_centro AND id_servicio=$id_servicio AND fecha='$fecha' AND id_horario=$id_horario AND estado='Disponible'";
$result=mysqli_query($conexionLp, $sql2) or die(mysqli_error($conexionLp));
	
	//antes del bucle creamos un array vacío
	$arrayCitas=array();
	while($fila = mysqli_fetch_assoc($result)){


array_push($arrayCitas, array('id_responsable'=>$fila['id_responsable'], 'id_cita'=>$fila['id_cita']));
		
	};

$id_cita_unica=$arrayCitas[0]['id_cita'];


	//validacion desde php

	if($id_persona=='' || $id_centro=='' || $id_servicio=='' || $fecha=='' || $id_horario==''){
		$mensaje='El campo no puede estar vacío';
	}else{

$sql = "UPDATE citas_disponibles SET estado='Reservada', id_persona=$id_persona WHERE id_cita=$id_cita_unica AND id_centro=$id_centro AND id_servicio=$id_servicio AND id_horario=$id_horario AND fecha='$fecha';";
mysqli_query($conexionLp, $sql) or
die(mysqli_error($conexionLp));
$mensaje= 'Su cita ha sido reservada';
	
	}
	echo $mensaje;

 ?>