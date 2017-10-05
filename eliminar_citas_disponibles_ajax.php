<?php 

include "conexion_bbdd_lp.php";

	include "conexion_bbdd_lp.php";
	if (isset($_POST['id_cita'])) {
		$id_cita=$_POST['id_cita'];
		
	}

$sql = "DELETE FROM citas_disponibles WHERE id_cita='$id_cita';";
	
mysqli_query($conexionLp, $sql) or
die(mysqli_error($conexionLp));
echo 'La cita disponible se ha eliminado';


 ?>