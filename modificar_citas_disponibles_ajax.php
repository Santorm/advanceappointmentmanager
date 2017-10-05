<?php 

include "conexion_bbdd_lp.php";

	include "conexion_bbdd_lp.php";
	if (isset($_POST['id_cita'])) {
		$id_cita=$_POST['id_cita'];
		$id_responsable=$_POST['id_responsable'];
		$id_centro=$_POST['id_centro'];
		$id_servicio=$_POST['id_servicio'];
		$id_horario=$_POST['id_horario'];
		$fecha=$_POST['fecha'];
		$estado=$_POST['estado'];
	}

$sql = "UPDATE citas_disponibles SET id_responsable=$id_responsable, id_centro=$id_centro, id_servicio=$id_servicio, id_horario=$id_horario WHERE id_cita=$id_cita;";
mysqli_query($conexionLp, $sql) or
die(mysqli_error($conexionLp));
echo 'Se ha modificado el registro';


 ?>