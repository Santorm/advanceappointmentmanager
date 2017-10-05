<?php 
		include "conexion_bbdd_lp.php";
	
	//$id_responsable=$_POST['id_responsable'];

	$id_centro=$_POST['id_centro'];
	$fecha=str_replace("/","",implode(',',$_POST['fecha_calendario']));
	//$fecha='20170526,20170529';
	$id_tratamiento=$_POST['id_tratamiento'];
	$id_horario=$_POST['id_hora'];
	//$fecha=$_POST['fecha_calendario'];


 


// if($id_responsable=='todos'){
// 	$id_responsable_min=999999;
// 	$id_responsable_max=999999;
// 	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
// }else{
// 	$id_responsable_min=$id_responsable;
// 	$id_responsable_max=$id_responsable;
// 	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
// }

if($id_centro=='todos'){
	$id_centro_min=0;
	$id_centro_max=999999;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}else{
	$id_centro_min=$id_centro;
	$id_centro_max=$id_centro;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}

if($id_tratamiento=='todos'){
	$id_tratamiento_min=0;
	$id_tratamiento_max=999999;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}else{
	$id_tratamiento_min=$id_tratamiento;
	$id_tratamiento_max=$id_tratamiento;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}



if($id_horario=='todos'){
	$id_horario_min=0;
	$id_horario_max=999999;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}else{
	$id_horario_min=$id_horario;
	$id_horario_max=$id_horario;
	//$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
}



//	$filtro_responsable="citas_disponibles.id_responsable BETWEEN $id_responsable_min AND $id_responsable_max";
	$filtro_tratamiento="citas_disponibles.id_servicio BETWEEN $id_tratamiento_min AND $id_tratamiento_max";
	$filtro_centros="citas_disponibles.id_centro BETWEEN $id_centro_min AND $id_centro_max";
	$filtro_fecha="citas_disponibles.fecha IN ($fecha)";
	$filtro_hora="citas_disponibles.id_horario BETWEEN $id_horario_min AND $id_horario_max";

if($fecha=='' || $fecha=='none'){
	$filtro_fecha="citas_disponibles.fecha";
}else{
	$filtro_fecha="citas_disponibles.fecha IN ($fecha)";
}




$sql="SELECT citas_disponibles.id_cita, centro.ciudad, servicios.nombre_servicio, horario.hora_inicio, citas_disponibles.fecha, citas_disponibles.estado
FROM citas_disponibles
JOIN centro
ON centro.id_centro = citas_disponibles.id_centro
JOIN servicios
ON servicios.id_servicio = citas_disponibles.id_servicio
JOIN horario
ON horario.id_horario = citas_disponibles.id_horario
WHERE $filtro_centros AND $filtro_tratamiento AND $filtro_fecha AND $filtro_hora AND citas_disponibles.estado='Disponible'
ORDER BY citas_disponibles.fecha";

//$id_responsable BETWEEN $id_responsable_min AND $id_responsable_max"


//$sql = "SELECT *
//		FROM citas_disponibles 
//		WHERE id_responsable=$id_responsable AND fecha='$fecha' AND id_centro=$id_centro ";



//$sql = "SELECT *
//		FROM citas_disponibles 
//		WHERE id_responsable=$id_responsable AND fecha='$fecha' AND id_centro=$id_centro ";
		

		//LEFT JOIN responsable ON 'citas_disponibles.id_responsable'='responsable.id_responsable'";
	//	WHERE 'responsable.id_responsable'=$id_responsable";

		//LEFT JOIN responsable ON 'citas_disponibles.".$id_responsable."'='responsable.id_responsable'";


// WHERE  id_centro=$id_centro AND id_tratamiento=$id_tratamiento AND fecha_calendario=$fecha_calendario";



 //$sql = "INSERT INTO citas_disponibles VALUES (NULL,$id_responsable, $id_centro, $id_tratamiento, 4, '$fecha_calendario', 1);";

 //controlar duplicados
	

$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	
	//antes del bucle creamos un array vacío
	$arrayCitas=array();
	while($fila = mysqli_fetch_assoc($result)){
		
array_push($arrayCitas, array('id_cita'=>$fila['id_cita'],'ciudad'=>$fila['ciudad'], 'nombre_servicio'=>$fila['nombre_servicio'], 'hora_inicio'=>$fila['hora_inicio'], 'fecha'=>$fila['fecha'], 'estado'=>$fila['estado']));
		
	}

	
echo json_encode($arrayCitas);
?>
