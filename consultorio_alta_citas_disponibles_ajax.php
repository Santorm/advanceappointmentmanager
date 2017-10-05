<?php 
		include "conexion_bbdd_lp.php";
		
	//conexión a la base de datos
	//recuperar opcion de consulta
	//	responsable':responsable, 'datos_ciudad':datos_ciudad, 'combo_tratamiento':combo_tratamiento, 'fecha_calendario':fecha_calendario
	$id_responsable=$_POST['id_responsable'];
	$id_centro=$_POST['id_centro'];
	$id_tratamiento=$_POST['id_tratamiento'];
	//$fecha=$_POST['fecha_calendario'];

	//echo $_POST['fecha_calendario'];
		$fecha=str_replace("/","-", $_POST['fecha_calendario']);
			

	//$fecha=str_replace("/","",implode(',',$_POST['fecha_calendario']));
	$id_hora=$_POST['id_hora'];
	$estado='Disponible';

	//echo $id_responsable;
	//print_r($id_centro);
	//echo $id_tratamiento;
	//print_r($fecha);
	//echo $id_horario;
	//echo $estado;

	

	//validacion desde php

	//if($id_responsable=='' || $id_centro=='' || $id_tratamiento=='' || $fecha==''){
	//	$mensaje='El campo no puede estar vacío';
//	}else{

	
 $sql = "INSERT INTO citas_disponibles VALUES (NULL, $id_responsable, $id_centro, $id_tratamiento, $id_hora, '$fecha','$estado',NULL);";

 //controlar duplicados
	if (!mysqli_query($conexionLp, $sql)) {
		if (mysqli_errno($conexionLp)==1062) {
			$mensaje='El registro ya existe en la base de datos';
		} else {
			die(mysqli_error($conexionLp));
		}
	}else{
		$mensaje='Las citas disponibles se han guardado exitosamente';
	} 
	
//else	}
	echo $mensaje;

 ?>