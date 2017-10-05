$( window ).on( "load", altura_caras);

$(document).ready(inici_principal);
      
       function inici_principal(){
$(window).resize(altura_caras);
///////
$(".iconos_informativos").on("click", pagina_iconos); 
$("#dialogo_secc_1").on("click", function(){window.location='tratamientos-dermatologia.php#contenedor'}); 

$(".cajas_ofrecemos").mouseover(mostrar_ofrecemos);
$(".cajas_ofrecemos").mouseout(ocultar_ofrecemos);
//$(".cajas_ofrecemos").click(mostrar_trat_zona_2);
$(".cajas_ofrecemos").on("mouseover",mostrar_trat_zona_2);
/////EVENTOS DE BOT COMPARACION CARAS/////
$(".botones_comp"). click(pagina_caras);
$(".botones_comp"). mouseover(escala_botones);
$(".botones_comp"). mouseout(reduce_botones);
$("#btn_desp"). mouseover(escala_botones_2);
$("#btn_desp"). mouseout(reduce_botones);

//evento cambio de pantalla para ajustar alturas carasa

//variable del ocultamiento del menu

///////////////////
/// VARIABLES DE DEPSLAZAMIENTO GLOBALES
////////////
 y_desplazar=$("#desplazar").position().left;
 //var y_cont=$("#cont_comp").offset().left;
 width_cont=$("#cont_comp").css("width");
 //alert(width_cont);
 corte_medio=$('#cont_comp').width();
//$(window).scroll(fondo_2);
//variable global para que no modifique la posicion inicial del header
posicion_nav=$(".nav").position().top;
antesDespues(); ///////funcion de comparacion caras
corte();
}
function pagina_iconos(){
	var id_btn=$(this).closest(".iconos_informativos").attr("id");
	if(id_btn=="servicios"){
		window.location='tratamientos-dermatologia.php'
	}else if(id_btn=="reserva_cita"){
		window.location='reserva_login.php'
	}else if(id_btn=="localizacion"){
		window.location='contacto-luna-piel.php#contenido_footer'
	}
}
function mostrar_ofrecemos(){
//$(this).find(".tit_2").stop().animate({"top":"0px"},1500);
$(this).find(".cont_2").stop().animate({"opacity":"1"},250);
$(this).find(".icono_caja_ofrecemos").stop().animate({"opacity":"0.1"},250);

}

function ocultar_ofrecemos(){
//$(this).find(".tit_2").stop().animate({"top":"340px"},1500);
$(this).find(".cont_2").stop().animate({"opacity":"0"},250);
$(this).find(".icono_caja_ofrecemos").stop().animate({"opacity":"0.9"},250);
}
//////SECCION 2 CLINICA QUIRURGICA ESTETICA APLICADA////
 function mostrar_trat_zona_2(){

              var id=$(this).attr("id");
              //$(".zonas").animate({"opacity":"0"},100);
              //$(this).animate({"opacity":"1"},500);
              $("#trat_zona_2").stop().animate({"opacity":"0"},000);
              $("#trat_zona_2").load("files/tratamientos_"+id+".html");
              $("#trat_zona_2").stop().animate({"opacity":"1"},1000);
       }
////////////////////DESDE AQUI COMPRACION CARAS//////////////////
function pagina_caras(){
	corte();
		$(".botones_comp").css({"background-color":"#fff"});

		$(this).css({"background-color":"grey"});

		var tecla=$(this).attr("id");
		var indice=eval(tecla.substring(4,5));
		var nom_img="cara_";
		
		//alert($('#cara_'+indice).attr("src"));
		var width_cont_num=parseInt(width_cont)/2;
		$("#desplazar").animate({"left":(corte_medio/2)},500);
		//$("#cara_2").css('clip', 'rect(0px,'+(y_desplazar)+'px,'+(corte_medio)+'px, 0px')
		$("#cara_2").css('clip', 'rect(0px,'+(parseInt(width_cont)/2)+'px,'+(corte_medio)+'px, 0px');
		$("#cara_1, #cara_2").css({"opacity":"0.1"});
		$("#cara_1, #cara_2").animate({"opacity":"1"},700);
		//$("#cara_2").animate({'clip': 'rect(0px,'+(width_cont_num/2)+'px,'+(corte_medio)+'px, 0px'});
		  switch(indice) {
    case 1:
        $('#cara_1').attr("src","imagenes/"+nom_img+indice+".png");
		$('#cara_2').attr("src","imagenes/"+nom_img+(indice+1)+".png");
		
        break;
    case 2:
        $('#cara_1').attr("src","imagenes/"+nom_img+(indice+1)+".png");
		$('#cara_2').attr("src","imagenes/"+nom_img+(indice+2)+".png");
		break;
    case 3:
        $('#cara_1').attr("src","imagenes/"+nom_img+(indice+2)+".png");
		$('#cara_2').attr("src","imagenes/"+nom_img+(indice+3)+".png");
		break;
    default:
        $('#cara_1').attr("src","imagenes/"+nom_img+indice+".png");
		$('#cara_2').attr("src","imagenes/"+nom_img+(indice+1)+".png");
	}  
}
var y_desplazar;
var width_cont;
 function antesDespues(){
 		$("#desplazar").draggable({
    	containment:'parent',
  		drag: function(){
  			 y_desplazar=$("#desplazar").position().left;
  			width_cont=$("#cont_comp").css("width");
  			corte_medio=$('#cont_comp').width();
  			//para centrar el boton de desp
  			$("#cara_2").css('clip', 'rect(0px,'+(y_desplazar)+'px,'+(corte_medio)+'px, 0px');
  			//console.log(y_desplazar+"//"+parseInt(width_cont)+"//"+(parseInt(width_cont)/100*60));
  				if(y_desplazar > (parseInt(width_cont)/100*55)){
  					$("#antes").css({"display":"block"}).animate({"opacity":"0.8"},1000);
  					$("#despues").css({"opacity":"0","display":"none"});
  				}else if(y_desplazar < (parseInt(width_cont)/100*45)){
  					$("#despues").css({"display":"block"}).animate({"opacity":"0.8"},1000);
  					$("#antes").css({"opacity":"0","display":"none"});
  				}
  			}
		});
}
///INICA LOS VALORES DEL clip
function corte(){	
	var corte=$("#cara_2").css('clip', 'rect(0px,'+(y_desplazar)+'px,'+(corte_medio)+'px, 0px');
	return corte;
}
function escala_botones(){
	//$(".botones_comp").css({"width":"10px","height":"10px"});
	$(this).css({"transform":"scale(1.2)"});
}

function escala_botones_2(){
	//$(".botones_comp").css({"width":"10px","height":"10px"});
	$(this).css({"transform":"scale(1.03)"});
}

function reduce_botones(){
	//$(".botones_comp").css({"width":"10px","height":"10px"});
	$(this).css({"transform":"scale(1)"});
}
/////////// 
////////////////////HASTA AQUI COMPRACION CARAS//////////////////
///////funcion ajustar altura caras///
function altura_caras(){
	//contenedor_seccion_4
	var altura_img=$("#cont_comp img").height();
	var altura_btn=(altura_img*0.70);
	$("div#cont_comp").height(altura_img+"px")
	$("#btn_desp").css("top",altura_btn+"px")

}