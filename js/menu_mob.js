$(document).ready(inici_menu);

var scrollTimer = null;

function inici_menu(){

 $(window).on("orientationchange",function(){
 	$("#caja_ico_nav, .nav, #overlay").removeAttr('style');
 		location.reload()
          });

reconocer_orientacion();
}

function reconocer_orientacion(){


currentScroll=0;
currentScrollpc=0;

	ancho_pantalla=$(window).width();
	if (ancho_pantalla<780) {
		$(".nav").removeClass("nav_pc");
		$(".nav").addClass("nav_mob");
		$(".nav_mob").css("display","none");
		
		$(window).on("scroll", timeScroll);
		$("#ico_nav").on("click", desp_menu);
	}else{
		
		$(".nav").removeClass("nav_mob");
		$(".nav").addClass("nav_pc");
		$(window).on("scroll", timeScroll_pc);
	}

}



function desp_menu(){
	//aqui desactivamos el evento que oculta el menu para que no desaparezca.
	$("#caja_ico_nav").css({"background-color":"transparent"});
	$("#caja_ico_nav").css({"z-index":"6","background-image":"none","-webkit-box-shadow":"none","-moz-box-shadow":"none","box-shadow":"none"});
	// $(".nav_mob").css({"background-color":"#d0d3ce"});

	$(".nav_mob").toggle("slide",{direction: 'right'},opacidad_menu);
	
				
		
}

function opacidad_menu(){
	if($(".nav_mob").css("display") == "block"){
		
		
		$(".nav_mob").css("z-index","5");
		$("#overlay").css({"opacity":"1","z-index":"4"});
	
			
	}else{

	
		$("#overlay").css({"opacity":"0"});
		$("#overlay").css({"z-index":"0"});

		}
}

////////FUNCION DE FIJAR Y OCULTAR NAVEGADOR////

	function timeScroll(){

		if (scrollTimer) {
        clearTimeout(scrollTimer);   // clear any previous pending timer
   			}
    	scrollTimer = setTimeout(ocultar_nav, 200);
	}



function ocultar_nav(){

 if($(".nav_mob").css("display")=="none"){
	
	var nextScroll = $(window).scrollTop();

      if (nextScroll > currentScroll){
         //write the codes related to down-ward scrolling here
         $("#caja_ico_nav").stop(true).slideUp(100);
         
      }
      else {
         //write the codes related to upward-scrolling here
         $("#caja_ico_nav").stop(true).slideDown(100);
    
         if(nextScroll >5){
         	$("#caja_ico_nav").css({"background-color":"#D0D3CE","background-image":"url(imagenes/logo_gold.png)"});
         	$("#caja_ico_nav").css({"-webkit-box-shadow":"0px 0px 20px 0px rgba(97,97,97,0.83)","-moz-box-shadow":"0px 0px 20px 0px rgba(97,97,97,0.83)","box-shadow":"0px 0px 20px 0px rgba(97,97,97,0.83)"});
      		}else{
			$("#caja_ico_nav").css({"background-image":"none","-webkit-box-shadow":"none","-moz-box-shadow":"none","box-shadow":"none"});
      		$("#caja_ico_nav").animate({"background-color":"transparent"},100);
      		}
      }

      currentScroll = nextScroll;  //Updates current scroll position
  

	}

	}

	function timeScroll_pc(){

		if (scrollTimer) {
        clearTimeout(scrollTimer);   // clear any previous pending timer
   			}
    	scrollTimer = setTimeout(ocultar_nav_pc, 200);
	}

	function ocultar_nav_pc(){
	scrollTimer = null;


	var nextScrollpc = $(window).scrollTop();

	var altura_header=190;
	// if(nextScrollpc<altura_header){
	// 	$(".nav_pc").css({"background-color":"transparent"});
	// }

      if (nextScrollpc > currentScrollpc){
         //write the codes related to down-ward scrolling here
         $(".nav_pc").stop(true).slideUp(100);
      }
      else {
         //write the codes related to upward-scrolling here
         $(".nav_pc").stop(true).slideDown(100);

         if(nextScrollpc<altura_header){
		$(".nav_pc").css({"background-color":"transparent"});
		$("#logo_menu").css({"display":"none"});

		}else if(nextScrollpc >5){
         	$(".nav_pc").css({"background-color":"#D0D3CE"});
         	$(".nav_pc a").css({"color":"#002E3E"});
         	$("#logo_menu").css({"display":"block"});
      		}else{
      		$("#logo_menu").css({"display":"none"});
      		$(".nav_pc").css({"box-shadow":"none","-webkit-box-shadow":"none","-moz-box-shadow":"none"});
      		$(".nav_pc").animate({"background-color":"transparent"},100);
      		}
      }
       currentScrollpc = nextScrollpc;  //Updates current scroll position
	}
