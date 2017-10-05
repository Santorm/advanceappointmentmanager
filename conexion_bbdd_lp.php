<?php

$conexionLp = mysqli_connect('localhost', 'root', '', 'reserva_lp')
or die("Hubo un error al conectar con la base de datos");

mysqli_set_charset($conexionLp, "utf8");
?>