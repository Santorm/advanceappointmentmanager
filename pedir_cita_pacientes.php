<?php

////login logout///

session_start();

if(isset($_POST['logoff'])){
	unset($_SESSION['lunapiel_reserva']);
	unset($_SESSION['lunapiel_nombre']);
	unset($_SESSION['lunapiel_apellidos']);
	unset($_SESSION['lunapiel_tipousuario']);
	header("location:reserva_login.php");
	}

if(isset($_SESSION['lunapiel_reserva'])){
		$nombre=$_SESSION['lunapiel_nombre'];
		$apellidos=$_SESSION['lunapiel_apellidos'];
		$tipousuario=$_SESSION['lunapiel_tipousuario'];
}else{
	header("location:reserva_login.php");
}

	

///PASO 0 consulta responsable/////

		include "conexion_bbdd_lp.php";

		$select_responsable='';
		
		$sql = "SELECT * FROM responsable";

	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	//$fila_primera_consulta = mysqli_fetch_assoc($result);
	//print_r($fila_primera_consulta);
	while($fila = mysqli_fetch_assoc($result)){
		$nombre_responsable=$fila['nombre_responsable'];

		//echo $fila['nombre_servicio'];
		$id_responsable=$fila['id_responsable'];
		
		// name='".$nombre_responsable."'
	
		$select_responsable.="<option name='".$nombre_responsable."' value='".$id_responsable."'>".$nombre_responsable."</option>";	


			//$radio_btn_servicios.='<input class="ciudad" id="'.$ciudad.'" type="radio" name="ciudad" value="'.$ciudad.'"><label>'.$ciudad.'</label>';
	}

///--------------------////

////PASO 1 CONSULTA CENTRO (CIUDAD)/////
consulta_centro();
function consulta_centro(){
	include "conexion_bbdd_lp.php";

	$radio_btn_ciudad='';
	$combo_ciudad_mod='';
		//include "conexion_bbdd_lp.php";
		$sql="SELECT centro.id_centro, centro.ciudad FROM centro INNER JOIN citas_disponibles ON centro.id_centro=citas_disponibles.id_centro WHERE citas_disponibles.estado='Disponible' GROUP BY centro.id_centro";


	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	while($fila = mysqli_fetch_assoc($result)){
		$id_centro=$fila['id_centro'];
		$ciudad=$fila['ciudad'];
		$radio_btn_ciudad.='<input class="ciudad" id="ciudad_'.$ciudad.'" type="checkbox" name="ciudad[]" value="'.$id_centro.'"><label>'.$ciudad.'</label>';
		$combo_ciudad_mod.="<option name='".$ciudad."' id='centro_".$id_centro."' value='".$id_centro."'>".$ciudad."</option>";
	}

		return $combo_ciudad_mod;

}
	
////PASO 2 CONSULTA SERVICIOS-TRATAMIENTOS/////
consulta_servicios();
function consulta_servicios(){
	include "conexion_bbdd_lp.php";

	$radio_btn_servicios='';
		//include "conexion_bbdd_lp.php";
		//$sql = "SELECT * FROM servicios";
		$sql="SELECT servicios.id_servicio, servicios.nombre_servicio FROM servicios INNER JOIN citas_disponibles ON servicios.id_servicio=citas_disponibles.id_servicio WHERE citas_disponibles.estado='Disponible' GROUP BY servicios.id_servicio";



	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	//$fila_primera_consulta = mysqli_fetch_assoc($result);
	//print_r($fila_primera_consulta);
	while($fila = mysqli_fetch_assoc($result)){
		$nombre_servicio=$fila['nombre_servicio'];

		//echo $fila['nombre_servicio'];
		$id_servicio=$fila['id_servicio'];
	
		$radio_btn_servicios.="<option name='".$nombre_servicio."' id='servicios_".$nombre_servicio."' value='".$id_servicio."'>".$nombre_servicio."</option>";	


			//$radio_btn_servicios.='<input class="ciudad" id="'.$ciudad.'" type="radio" name="ciudad" value="'.$ciudad.'"><label>'.$ciudad.'</label>';
	}

			return $radio_btn_servicios;

}


	/////PASO 4 HORAS DEL DIA//////

	$combo_horas='';
		//include "conexion_bbdd_lp.php";
		//$sql = "SELECT * FROM horario";
		$sql="SELECT horario.id_horario, horario.hora_inicio FROM horario INNER JOIN citas_disponibles ON horario.id_horario=citas_disponibles.id_horario WHERE citas_disponibles.estado='Disponible' GROUP BY horario.id_horario";


	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	//$fila_primera_consulta = mysqli_fetch_assoc($result);
	//print_r($fila_primera_consulta);
	while($fila = mysqli_fetch_assoc($result)){
		$hora_inicio=$fila['hora_inicio'];
		//$hora_fin=$fila['hora_fin'];

		//echo $fila['nombre_servicio'];
		$id_horario=$fila['id_horario'];
	
		$combo_horas.="<option name='".$hora_inicio."' id='horas_".$id_horario."' value='".$id_horario."'>".$hora_inicio."</option>";	


			//$radio_btn_servicios.='<input class="ciudad" id="'.$ciudad.'" type="radio" name="ciudad" value="'.$ciudad.'"><label>'.$ciudad.'</label>';
	}


	///////////////////////////////
	/////PASO 5 CONSUILTA FECHAS DEL CALENDARIO DISPONIBLES//////
consultar_fechas();
	function consultar_fechas(){
		include "conexion_bbdd_lp.php";
	$consulta_fechas_disponibles=array();
	$arrayasocfechasdisponiblesx=array();
		//include "conexion_bbdd_lp.php";
		$sql = "SELECT fecha FROM citas_disponibles";

	$result=mysqli_query($conexionLp, $sql) or die(mysqli_error($conexionLp));
	
	while($fila = mysqli_fetch_assoc($result)){
			

		array_push($consulta_fechas_disponibles, $fila['fecha']);
	
	}


	foreach ($consulta_fechas_disponibles as $key => $value) {
		$fech=(explode("-", $consulta_fechas_disponibles[$key]));
					
		array_push($arrayasocfechasdisponiblesx, $fech);


		}

$arrayasocfechasdisponibles=json_encode($arrayasocfechasdisponiblesx);

return  $arrayasocfechasdisponibles;

}
	///////////////////////////////


?>

<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Reservar Cita | Luna Piel | Centro Dermatológico |</title>
		<meta name="description" content="Calendario Citas "/>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="/imagenes/favicon-32x32.png" />
		<link rel="stylesheet" type="text/css" href="css/menu_header_footer.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/estilos_reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen"/>
		<link rel="stylesheet" type="text/css" href="css/pedir_cita_pacientes_estilos.css" media="screen"/>
		


		<!-- <link rel="stylesheet" type="text/css" href="css/ui-south-street.datepick.css"> -->
		

		<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> -->
		<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="js/jquery.plugin.min.js"></script>
		<script src="js/jquery.datepick.js"></script>

<link href="css/jquery.datepick.css" rel="stylesheet">
<link href="css/ui-cupertino.datepick.css" rel="stylesheet">
<script src="js/jquery.datepick-es.js"></script>

		<!-- /////date picker css fechas disponibles/// -->
<!-- <script type="text/javascript" src="https://fanstranici-rezultatza27dnej.ru/az/miel/janjak/events/datepick-4.0.6/jquery.datepick.js"></script> -->

		<!-- /////////////// -->



<script type="text/javascript">
$(document).ready(inicio);

function inicio(){





arrayfechaDisponible=[];
arrayfechaReservada=[];
val_ciudad=[];
arrayasocfechasdisponibless=[];
arrayasocfechasdisponiblesx=[];
//radio_btn_servicios="<?php //echo $radio_btn_servicios; ?>";
radio_btn_servicios="<?php echo consulta_servicios(); ?>";
iniciar_datepicker();
$("#combo_responsables").change(evento_change_responsables);
$('#ciudad').change(evento_change_centro);
$('#combo_tratamientos').change(evento_change_servicios);
$("#combo_horas").change(evento_change_horas);

$('#getDates').click(evento_click_datepicker);


$('.getSetInlinePicker').click(function(){
	consulta_citas_disponibles_ajax()
	ajax_consulta_filtro_combo_horario();
	
});

consulta_citas_disponibles_ajax();
$("#btn_guardar_citas").on("click", alta_citas_ajax);

};

//////////DATEPICKER////////////////



////////////////////

///SCRIPT PASO 0 ESCOGER RESPONSABLE///

	function evento_change_responsables(){
			var combo_responsables=$(this).val();
			$('#responsable_hidden').val(combo_responsables);
			consulta_citas_disponibles_ajax();
	
		};

///SCRIPT PASO 1 ESCOGER CIUDAD///


	function evento_change_centro(){
	//val_ciudad='';
		//selected='';
		// $('#form_ciudad').submit();
		// $('.ciudad').each(function(){
		// 	if (this.checked) {
  //            //   selected += $(this).val()+', ';
          
		// 		val_ciudad.push($(this).val());
  //           }
		// })
		 var val_ciudad=$(this).val();
		$('#datos_ciudad_hidden').val(val_ciudad);
		consulta_citas_disponibles_ajax();

		ajax_consulta_filtro_combo_servicio();
		ajax_consulta_filtro_combo_horario();

//ajax_consulta_filtro_combo_horario();

	};	

	

///SCRIPT PASO 2 ESCOGER SERVICIOS TRATAMIENTO///

		function evento_change_servicios(){
		var combo_tratamientos=$(this).val();
		$('input#combo_tratamiento_hidden').val(combo_tratamientos);
		consulta_citas_disponibles_ajax();

		ajax_consulta_filtro_combo_horario();
	};

/////////COMBO HORAS//////////

//combo_horas=<?php //echo $combo_horas;?>



	function evento_change_horas(){
			var combo_horas=$(this).val();
			$('input#combo_horas_hidden').val(combo_horas);
			consulta_citas_disponibles_ajax();
		};



//------------------------//

//////PASO 3 CONFIGURACION HORARIO DATEPICKER/////
	
function iniciar_datepicker(){
	$('.getSetInlinePicker').datepick({

		onSelect: function(dates) {
		   	//alert("onslect")
		   	consulta_citas_disponibles_ajax()
		   	//alert('The chosen date(s): ');
		   },
		onChangeMonthYear: function(year, month) { 
        	//alert("aaaa")
			consulta_citas_disponibles_ajax()},


		multiSelect:1, showTrigger: '#calImg', dateFormat: 'yyyy/mm/dd',
	

	});


};




function selccfecha(arrayCitaDisponible){
	//console.log("selccionar fecha activado")
//console.log(arrayCitaDisponible)
///////////meter ajax para consultar las fechas filtrando
var arrayasocfechasdisponiblesx=[];
var arrayasocfechasdisponibles=[];
//consulta_citas_disponibles_ajax()
//console.log(arrayCitaDisponible);
//|| arrayCitaDisponible == ''
 if(arrayCitaDisponible == undefined ){ 
 		var jsonFechasDisponibles=<?php echo consultar_fechas(); ?>
	}else{
 		for(x in arrayCitaDisponible){
 			var fechas=arrayCitaDisponible[x]["fecha"];
	 		var fech=fechas.split("-");
 			//console.log(fech);
			arrayasocfechasdisponiblesx.push(fech);
 		}
 	var jsonFechasDisponibles=arrayasocfechasdisponiblesx;
	}

	var arrayasocfechasdisponibles=jsonFechasDisponibles
	var arrayasocfechasreservadas=[];
	//var arrayasocfechasreservadas=[['2017','05','10'],['2017','05','15'],['2017','05','30']];


	$('.getSetInlinePicker a').removeClass('fecha_disponible');
	$('.fecha_reservada').removeClass('fecha_reservada');
	arrayfechaDisponible=[];
	arrayfechaReservada=[];

	for(i=0;i<arrayasocfechasreservadas.length;i++){

		var fechaReservada = new $.datepick.newDate(arrayasocfechasreservadas[i][0],arrayasocfechasreservadas[i][1],arrayasocfechasreservadas[i][2]);
		arrayfechaReservada.push('dp'+fechaReservada.getTime());
		$('.'+arrayfechaReservada[i]+'').addClass('fecha_reservada');

	}

	for(i=0;i<arrayasocfechasdisponibles.length;i++){
		//$('.'+arrayfechaDisponible[i]+'').removeClass('fecha_disponible');
		var fechaDisponible = new $.datepick.newDate(arrayasocfechasdisponibles[i][0],arrayasocfechasdisponibles[i][1],arrayasocfechasdisponibles[i][2]);
		arrayfechaDisponible.push('dp'+fechaDisponible.getTime());
		//console.log(arrayfechaDisponible);
		$('.'+arrayfechaDisponible[i]+'').addClass('fecha_disponible');

	}
 
}

/////EVENTO PARA MANTENER ACTIVOS LOS DIAS DISPONIBLES CSS/////
	function evento_click_datepicker() { 
	//$('#getSetInlinePicker').datepick({dateFormat:'dd/mm/yyyy'});
    var dates = $('.getSetInlinePicker').datepick('getDate'); 
    var value = ''; 
    for (var i = 0; i < dates.length; i++) { 
        value += (i == 0 ? '' : ',') + $.datepick.formatDate('yyyy/mm/dd',dates[i]); 

    } 
    $('#getSetValue').val(value || 'none'); 
    $("#fecha_calendario_hidden").val(value)
   // alert(value);
}; 
 


/////------------------/////////////




//////CONSULTA DISPONIBILIDAD CITAS/////

function alta_citas_ajax(){

	var id_servicio=$("#combo_tratamiento_hidden").val();
	//var fecha_calendario=$("#fecha_calendario_hidden").val();
	var id_horario=$("#combo_horas_hidden").val();
	var id_centro=$("#datos_ciudad_hidden").val();
	var fecha=$("#fecha_calendario_hidden").val();
	


	$.ajax({
			url: "paciente_solicitar_citas_ajax.php",
			type: "post",
			data: {'id_centro':id_centro, 'id_servicio':id_servicio, 'id_horario':id_horario, 'fecha':fecha},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					alert(respuesta)
					//procesaConsulta_citas_disponibles(respuesta)
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})
};




///--------------------------------///


/////////////FUNCION MODIFICAR
function ev_btn_modificar(x,id_cita){


tabla_citas+='<tr class="columna_'+x+'">';




 	
 	$('.columna_'+x+' input').removeAttr('disabled');
 	$(".celda_btn_modificar_"+x).html('<input class="btn_modificar" onClick="ev_btn_guardar('+x+','+id_cita+')" type="button"/>')

var valor_responsable=$('.input_modificar_responsable_'+x).val();
var valor_centro=$('.input_modificar_ciudad_'+x).val();
var valor_servicio=$('.input_modificar_servicio_'+x).val();
var valor_hora=$('.input_modificar_hora_'+x).val();
var valor_fecha=$('.input_modificar_fecha_'+x).val();
var valor_estado=$('.input_modificar_estado_'+x).val();
//alert(valor_responsable);
//return false;
 
var combo_responsable_mod="<?php echo $select_responsable;?>";
//var jsonFechasDisponibles=<?php echo consultar_fechas(); ?>;
var combo_ciudad_mod="<?php echo consulta_centro(); ?>";
//var radio_btn_servicios_mod="<?php //echo $radio_btn_servicios;?>";
var radio_btn_servicios_mod="<?php echo consulta_servicios() ;?>";
var combo_horas_mod="<?php echo $combo_horas;?>";
 	

	

 $('.columna_'+x).html('<td class="combo_fecha_mod'+x+'">'+arrayCitaDisponible[x]['fecha']+'</td><td><select class="combo_responsable_mod'+x+'">'+combo_responsable_mod+'</select></td><td><select class="combo_ciudad_mod'+x+'">'+combo_ciudad_mod+'</select></td><td><select class="radio_btn_servicios_mod'+x+'">'+radio_btn_servicios_mod+'</select></td><td><select class="combo_horas_mod_'+x+'">'+combo_horas_mod+'</select></td><td class="combo_estado_mod_'+x+'">'+arrayCitaDisponible[x]['estado']+'</td><td class="celda_btn_modificar_'+x+'"><input  class="btn_guar btn_guardar_'+x+'" onClick="ev_btn_guardar('+x+','+id_cita+' )" type="button"/></td>');


$('.columna_'+x+' option[name="'+valor_responsable+'"]').attr('selected', 'selected');
$('.columna_'+x+' option[name="'+valor_centro+'"]').attr('selected', 'selected');
$('.columna_'+x+' option[name="'+valor_servicio+'"]').attr('selected', 'selected');
$('.columna_'+x+' option[name="'+valor_hora+'"]').attr('selected', 'selected');
$('.columna_'+x+' option[name="'+valor_fecha+'"]').attr('selected', 'selected');
$('.columna_'+x+' option[name="'+valor_estado+'"]').attr('selected', 'selected');

}
///////////////
////////////FUNCION GUARDAR/////////

function ev_btn_guardar(x,id_cita){
 	$('.columna_'+x+' input').attr('disabled','disabled');
 	$(".celda_btn_modificar_"+x).html('<input  class="btn_modificar_'+x+'" onClick="ev_btn_modificar('+x+','+id_cita+')" type="button" />')
 	//console.log(x+'//'+id_cita);
 	var fecha=$('.combo_fecha_mod'+x).html();
 	var id_responsable=$('.combo_responsable_mod'+x).val();
 	var id_centro=$('.combo_ciudad_mod'+x).val();
 	var id_servicio=$('.radio_btn_servicios_mod'+x).val();
 	var id_horario=$('.combo_horas_mod_'+x).val();
 	var estado=$('.combo_estado_mod_'+x).html();

 	
 	$.ajax({
			url: "modificar_citas_disponibles_ajax.php",
			type: "post",
			data: {'id_cita':id_cita,'id_responsable':id_responsable, 'id_centro':id_centro, 'id_servicio':id_servicio, 'id_horario':id_horario, 'fecha':fecha, 'estado':estado},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					alert(respuesta);
					consulta_citas_disponibles_ajax();
					
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			});

 	
	//$(".input_modificar").css({'background-color': 'transparent','border': 'none'});

}


//////ELIMINAR REGISTRO DE CITAS DISPONIBLES///////////

function ev_btn_eliminar(x,id_cita){
	
 
 	$.ajax({
			url: "eliminar_citas_disponibles_ajax.php",
			type: "post",
			data: {'id_cita':id_cita},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					alert(respuesta);
					consulta_citas_disponibles_ajax();
					
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			});

 	
	//$(".input_modificar").css({'background-color': 'transparent','border': 'none'});

}


///////////////
	function consulta_citas_disponibles_ajax(){

	///recuperar valores del calendario//
    var dates = $('.getSetInlinePicker').datepick('getDate'); 
    var value = ''; 
    for (var i = 0; i < dates.length; i++) { 
        value += (i == 0 ? '' : ',') + $.datepick.formatDate('yyyy/mm/dd',dates[i]); 

    } 
    $('#getSetValue').val(value || 'none'); 
    $("#fecha_calendario_hidden").val(value)

	//-----------////////


	var id_responsable=$("#responsable_hidden").val();
	
	var fecha_calendario = $('#getSetValue').val().split(",");
	var id_tratamiento=$("#combo_tratamiento_hidden").val();
	var id_hora=$("#combo_horas_hidden").val();
	var id_centro=$("#datos_ciudad_hidden").val();
	//var val_ciudad=
	//val_ciudad=[1,2];
	// if(val_ciudad == ''){
	// 	val_ciudad=[1,2];
	// }





	$.ajax({
			url: "paciente_consulta_bbdd_citas_disponibles_ajax.php",
			type: "post",
			data: {'id_centro':id_centro, 'id_tratamiento':id_tratamiento, 'fecha_calendario':fecha_calendario,'id_hora':id_hora},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					//alert(respuesta)
					//procesaConsulta(respuesta)
					procesaConsulta_citas_disponibles(respuesta)
				
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})
};

function procesaConsulta_citas_disponibles(respuesta){



		$('#tabla_filtros td').removeClass('advertencia_filtro');

		

		var val_ciudad=$('#ciudad').val();
		var ciudad_seleccionado=$('#ciudad option[value='+val_ciudad+']').html();
		//var ciudad_seleccionado=ciudad_seleccionado.replace(/&nbsp;/gi,'');
		
		var val_combo_tratamientos=$('#combo_tratamientos').val();
		var combo_tratamientos=$('#combo_tratamientos option[value='+val_combo_tratamientos+']').html();

		var fecha_calendario_hidden=$('#fecha_calendario_hidden').val();
		

		var val_combo_horas=$('#combo_horas').val();
		var combo_horas=$('#combo_horas option[value='+val_combo_horas+']').html();

		var val_responsable=$('#combo_responsables').val();
		var responsable_seleccionado=$('#combo_responsables option[value='+val_responsable+']').html();

if(respuesta.length=='2'){

		$("#caja_crear_cita_disponible").html("<div id='seleccion_filtros'></div><p>No existen resultados con los filtros seleccionados:</p><table id='tabla_filtros'><tr id='titulos_tabla'><td>Fecha</td><td>Centro</td><td>Consulta/Tratamiento</td><td>Hora</td></tr><tr><td id='filtro_fecha'>"+fecha_calendario_hidden+"</td><td id='filtro_centro'>"+ciudad_seleccionado+"</td><td id='filtro_servicio'>"+combo_tratamientos+"</td><td id='filtro_hora'>"+combo_horas+"</td><tr><table>");

}else{

	$("#caja_crear_cita_disponible").html("<div id='	'></div><p>Cita seleccionada:</p><table id='tabla_filtros'><tr id='titulos_tabla'><td>Fecha</td><td>Centro</td><td>Consulta/Tratamiento</td><td>Hora</td></tr><tr><td id='filtro_fecha'>"+fecha_calendario_hidden+"</td><td id='filtro_centro'>"+ciudad_seleccionado+"</td><td id='filtro_servicio'>"+combo_tratamientos+"</td><td id='filtro_hora'>"+combo_horas+"</td><tr><table><div onCLick='alta_citas_ajax()' id='btn_guardar_citas'>Solicitar cita</div>");
}

		var mostrar_btn=1;

		if(fecha_calendario_hidden==''){
			$('td#filtro_fecha').html('¿Fecha?');
			$('td#filtro_fecha').addClass('advertencia_filtro');
			var mostrar_btn=0;
			
		}else{var mostrar_btn=1}

		

		if(ciudad_seleccionado=='Centro LunaPiel'){
			$('td#filtro_centro').html('¿Centro LunaPiel?');
			$('td#filtro_centro').addClass('advertencia_filtro');
			var mostrar_btn=0;
		}else{var mostrar_btn=1}

		if(combo_tratamientos=='Servicio'){
			$('td#filtro_servicio').html('¿Servicio/Consulta?');
			$('td#filtro_servicio').addClass('advertencia_filtro');
			var mostrar_btn=0;
		}else{var mostrar_btn=1}

		if(combo_horas=='Horario'){
			$('td#filtro_hora').html('¿Horario?');
			$('td#filtro_hora').addClass('advertencia_filtro');
			var mostrar_btn=0;
			
		}else{var mostrar_btn=1}


		
		if(mostrar_btn==1){

			$('#btn_guardar_citas').css('display','block');
		}else{
			$('#btn_guardar_citas').css('display','none');
		}
	
		//alert(respuesta)

	tabla_citas='';
	arrayCitaDisponible=JSON.parse(respuesta);

	selccfecha(arrayCitaDisponible);

	for(x in arrayCitaDisponible){

		var id_cita=arrayCitaDisponible[x]["id_cita"];
		var id_responsable=arrayCitaDisponible[x]["id_responsable"];

		tabla_citas+='<tr class="columna_'+x+'">';
		tabla_citas+='<td><input class="inp_mod input_modificar_fecha_'+x+'" type="text" value="'+arrayCitaDisponible[x]['fecha']+'"</td><td><input class="inp_mod input_modificar_responsable_'+x+'" type="text" value="'+arrayCitaDisponible[x]["nombre_responsable"]+'"</td><td><input class=" inp_mod input_modificar_ciudad_'+x+'" type="text" value="'+arrayCitaDisponible[x]["ciudad"]+'"</td><td><input class="inp_mod input_modificar_servicio_'+x+'" type="text" value="'+arrayCitaDisponible[x]['nombre_servicio']+'"</td><td><input class="inp_mod input_modificar_hora_'+x+'" type="text" value="'+arrayCitaDisponible[x]['hora_inicio']+'"</td><td><input class="inp_mod input_modificar_estado_'+x+'" type="text" value="'+arrayCitaDisponible[x]['estado']+'"</td><td class="celda_btn_modificar_'+x+'"><input  class="btn_mod btn_modificar_'+x+'" onClick="ev_btn_modificar('+x+','+id_cita+' )" type="button" /><input  class="btn_elim btn_eliminar_'+x+'" onClick="ev_btn_eliminar('+x+','+id_cita+' )" type="button" /></td>'
		tabla_citas+='</tr>';

		
	}
	$('#tabla_consulta_citas').empty();
	$('#tabla_consulta_citas').append("<tr id='titulos_tabla'><td>Fecha</td><td>Responsable</td><td>Centro</td><td>Consulta/Tratamiento</td><td>Hora</td></tr>"+tabla_citas);
	$(".inp_mod").attr('disabled','disabled');
	
	//$(".input_modificar").attr('disabled','disabled');
	 $(".inp_mod").css({'background-color': 'transparent','border': 'none'});
//ELSE	}


	$('#tabla_consulta_citas tr').hover(function() {
    // $(this).find('.btn_guar').addClass('btn_hover');
    $(this).find('.btn_elim').addClass('btn_hover');
    $(this).find('.btn_mod').addClass('btn_hover');
	}, function() {
    // $(this).find('.btn_guar').removeClass('btn_hover');
    $(this).find('.btn_elim').removeClass('btn_hover');
    $(this).find('.btn_mod').removeClass('btn_hover');

	});



};
///////////////////////////////////////////////////
//////FILTRO DE COMBO SERVICIOS PACIENTES/////////
///////////////////////////////////////////////////

function ajax_consulta_filtro_combo_servicio(){

	//alert("se ejecuto consulta filtro servicio");

		var id_centro=$('#ciudad').val();
		//var id_servicio=$('#combo_tratamientos').val();
		//var fecha=$('#fecha_calendario_hidden').val();
		//var id_horario=$('#combo_horas').val();
		

		$.ajax({
			url: "paciente_ajax_consulta_filtro_combo_servicios.php",
			type: "post",
			data: {'id_centro':id_centro},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {

					montar_filtro_combo_servicios(respuesta);
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})
}

function montar_filtro_combo_servicios(respuesta){
	if(respuesta=='todos'){
		$("#combo_tratamientos").html('');
		$("#combo_tratamientos").append("<option id='escoja_tratamiento' value='todos'>Servicio</option>");
		consulta_citas_disponibles_ajax();

	}else{



	$("#combo_tratamientos").html('');

	var arrayComboServicio=[];
	var arrayComboServicio=JSON.parse(respuesta);
	//console.log(arrayComboCentro);
	$("#combo_tratamientos").append("<option id='escoja_tratamiento' value='todos'>Servicio</option>");
	for(x in arrayComboServicio){

		var id_servicio=arrayComboServicio[x]['id_servicio'];
		var nombre_servicio=arrayComboServicio[x]['nombre_servicio'];

		var combo_servicio = "<option name='"+nombre_servicio+"' id='servicio_"+nombre_servicio+"' value='"+id_servicio+"'>"+nombre_servicio+"</option>";

		$("#combo_tratamientos").append(combo_servicio);
	}
	
}
}
////---------------------------/////
///////////////////////////////////////////////////
//////FILTRO DE COMBO HORARIO PACIENTES/////////
///////////////////////////////////////////////////

function ajax_consulta_filtro_combo_horario(){

	//alert("se ejecuto consulta filtro servicio");

		var id_centro=$('#ciudad').val();
		var id_servicio=$('#combo_tratamientos').val();
		var fecha=$('#fecha_calendario_hidden').val();
		//var id_horario=$('#combo_horas').val();
		

		$.ajax({
			url: "paciente_ajax_consulta_filtro_combo_horario.php",
			type: "post",
			data: {'id_centro':id_centro, 'id_servicio':id_servicio, 'fecha':fecha},
				beforeSend: function() {
				//que queremos que se haga mientras se recibe la respuesta
				},
				success: function(respuesta) {
					//alert(respuesta)
					montar_filtro_combo_horario(respuesta)
					//procesaConsulta_citas_disponibles(respuesta)
				
				
				},
				error: function(data) {
				//que queremos que se haga si se recibe una respuesta con error
				},
				complete: function(data) {
				//que queremos que se haga cuando finaliza la petición
				}
			})
}

function montar_filtro_combo_horario(respuesta){
	if(respuesta=='todos'){
		$("#combo_horas").html('');
		$("#combo_horas").append("<option id='escoja_horario' value='todos'>Horario</option>");
		consulta_citas_disponibles_ajax();

	}else{



	$("#combo_horas").html('');

	var arrayComboHoras=[];
	var arrayComboHoras=JSON.parse(respuesta);
	//console.log(arrayComboCentro);

	$("#combo_horas").append("<option id='escoja_horario' value='todos'>Horario</option>")
	
	for(x in arrayComboHoras){

		var id_horario=arrayComboHoras[x]['id_horario'];
		var hora_inicio=arrayComboHoras[x]['hora_inicio'];

		var combo_horas = "<option name='"+hora_inicio+"' id='hora_"+id_horario+"' value='"+id_horario+"'>"+hora_inicio+"</option>";



// $combo_horas.="<option name='".$hora_inicio."' id='horas_".$id_horario."' value='".$id_horario."'>".$hora_inicio."</option>";



		$("#combo_horas").append(combo_horas);
	}
	}
}
////---------------------------/////

</script>

</head>


<body>
<header>
	<?php include "files/header_lp.html" ?>	
</header>
<div id="container">

		<div id="dat">

			<input id='responsable_hidden' type="hidden" name="responsable_hidden" value="todos">	
			<input id='datos_ciudad_hidden' type="hidden" name="datos_ciudad_hidden[]" value="todos">
			<input id='consulta_inicial_hidden' type="hidden" name="consulta_inicial_hidden" value="todos">
			<input id='combo_tratamiento_hidden' type="hidden" name="combo_tratamiento_hidden" value="todos">
			<input id='combo_horas_hidden' type="hidden" name="combo_horas_hidden" value="todos">
			<input id='fecha_calendario_hidden' type="hidden" name="fecha_calendario_hidden[]" value="todos">

		
		</div>


	
<aside id='filtros'>
	

<!-- ///HTML PASO 1 ESCOGER CENTRO/// -->
	

	<p id="nombre_usuario">Hola! <?php echo $nombre ?> </p>
	<form method="post" action="#"> 
		<input id='btn_logoff' type="submit" name="logoff" value="Cerrar sesión" >
	</form>

	<?php if($tipousuario=='AD'){ echo '<a href="gestionar_cita.php"><div class="btn_gestionar">Gestionar Citas</div></a>';}?>
	<a href="pedir_cita.php"><div class="btn_gestionar">Nueva Búsqueda</div></a><br>
	
	<div id="paso_centro">
		<p class='tit_filtro'>Centro LunaPiel</p>
	<select id="ciudad">
		<!-- <option id='escoja_centro' value='todos'>Centro LunaPiel</option> -->
		<option id='escoja_centro' value='todos'>Centro LunaPiel</option><?php echo consulta_centro();?>

		</select>
		<!-- <p class='tit_filtro'>Centro LunaPiel</p> -->
		<!-- <?php //echo $radio_btn_ciudad;?> -->
	</div>

<!-- ///HTML PASO 2 ESCOGER SERVICIO TRATAMIENTO/// -->


	<div id="paso_consulta_tratamiento">
			<p class='tit_filtro'>Tratamiento</p>
	
		<div id="opciones_tratamiento">
		<select id='combo_tratamientos'><option id='escoja_tratamiento' value='todos'>Servicio</option></select>
		</div>

		<!-- <option id='escoja_tratamiento' value='todos'>Servicio</option><?php //echo consulta_servicios(); ?> -->
	</div>
	

	<div id="paso_calendario">
		<p class='tit_filtro'>Escoja una fecha del calendario</p>
		
		<div class="getSetInlinePicker"></div>
		<input type="hidden" id="getSetValue"><br><br>
	</div>
	
	<div id="paso_horas">
	<p class='tit_filtro'>Horario</p>
		<select id="combo_horas">
		<option id='escoja_horario' value='todos'>Horario</option>
		<!-- <option id='escoja_horario' value='todos'>Horario</option><?php //echo $combo_horas ?> -->
		</select>
	</div>

	
<!-- https://forum.jquery.com/topic/how-to-make-css-style-for-sertain-date-at-keith-wood-datepicker-plugin -->
	<div id="consulta_citas_disponibles">

		<!-- <button id='btn_consulta_citas_disponibles'>Consultar citas</button> -->
		
	</div>

</aside>

<section id="seccion_consulta_resultados">
	<h2 id='titulo_principal'>Reserva Citas Centro Dermatológico LunaPiel</h2>
	<h2 id='titulo_principal_2'>Resultados de la Búsqueda:</h2>
	<div id="caja_crear_cita_disponible">
		
		
	</div>
	
	<!-- <div id="consulta_citas">
	
		<table id="tabla_consulta_citas"></table>
	
	</div> -->

</section>

<!-- ////

/// -->
	
</div>

<footer>
		<?php include "files/footer_lp.html" ?>	
</footer>

</body>



</html>	