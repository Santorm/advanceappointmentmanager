<?php 
include "conexion_bbdd_lp.php";

$id_centro=$_POST['id_centro'];
$id_servicio=$_POST['id_servicio'];
$fecha=$_POST['fecha'];
//$id_horario=$_POST['id_horario'];

if($id_centro=='todos' || $id_servicio=='todos' || $fecha=='' ){
	$respuesta='todos';
	echo $respuesta;
	return false;
}


//$id_centro='';
//$id_servicio=3;
//$fecha='2017-06-20';
//$id_horario=9;


// WHERE citas_disponibles.estado='Disponible' AND citas_disponibles.id_servicio=$id_servicio AND citas_disponibles.id_horario=$id_horario AND citas_disponibles.fecha='$fecha' GROUP BY servicios.id_centro";





//data: {'id_centro':val_ciudad, 'id_tratamiento':val_combo_tratamientos, 'fecha_calendario':fecha_calendario_hidden,'id_hora':val_combo_horas},
	
	$arrayCitas=array();
		//include "conexion_bbdd_lp.php";
		$sql="SELECT horario.id_horario, horario.hora_inicio
				FROM horario 
				INNER JOIN citas_disponibles 
				ON citas_disponibles.id_horario=horario.id_horario 
				WHERE citas_disponibles.estado='Disponible' AND citas_disponibles.id_centro=$id_centro AND citas_disponibles.id_servicio=$id_servicio AND citas_disponibles.fecha='$fecha'  GROUP BY horario.id_horario";


	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	while($fila = mysqli_fetch_assoc($result)){
		
		array_push($arrayCitas, array('id_horario'=>$fila['id_horario'],'hora_inicio'=>$fila['hora_inicio']));






		// $id_centro=$fila['id_centro'];
		// $ciudad=$fila['ciudad'];
		// $radio_btn_ciudad.='<input class="ciudad" id="ciudad_'.$ciudad.'" type="checkbox" name="ciudad[]" value="'.$id_centro.'"><label>'.$ciudad.'</label>';
		// $combo_ciudad_mod.="<option name='".$ciudad."' id='centro_".$id_centro."' value='".$id_centro."'>".$ciudad."</option>";
	}

	
	
	

	echo json_encode($arrayCitas);



 ?>