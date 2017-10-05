$(document).ready(inici_trat);
      
   function inici_trat(){
        $(window).on("orientationchange",function(){
             $("#lista_trat a").off("click");
               estado_pantalla();
          });

       estado_pantalla();
    }
       function estado_pantalla(){
              var ancho_pantalla=$(window).width();
              $(".zonas").stop().mouseenter(function(){
                var id=$(this).attr("id");
                mostrar_trat(id);
                btns_pc(id);
              });
                    $("#lista_trat a").on('click', function tratamientos(e){           
                      e.preventDefault();
                      var nombre=$(this).find('li').attr("name");
                      mostrar_trat(nombre);
                    if (ancho_pantalla<600){
                        ocultar_btns_mobil(nombre);
                    }else{
                      btns_pc(nombre);
                    }
                    })
      }
      function mostrar_trat(nombre){
          $("#desc_trat").load("files/contenido_"+nombre+".html");
          $("#desc_trat").css({"display":"block"});       
      }
       function ocultar_btns_mobil(nombre){

              var left_lista = parseInt($('#lista_trat li[name='+nombre+']').css("left"),10);
              if(    left_lista=="0" || left_lista=="-30px"){
                     $('#lista_trat li[name='+nombre+']').animate({"left":"17%","background-color":"#8F7D53","color":"#8F7D53"},600);
                     $("#lista_trat").css({"background-image":"none"});
                     $("#lista_trat").animate({"left":"-138px"},500);
                     $("#lista_trat span").css({"display":"block"});
              }else{
                     $("#lista_trat span").css({"display":"none"});
                      $('#lista_trat li[name='+nombre+']').animate({"left":"0px","background-color":"#fff","color":"#8F7D53"},500);
                     $("#desc_trat").css({"display":"none"});
                     $("#lista_trat").animate({"left":"0"}, 500, function(){
                      $("#lista_trat").css({"background-image":"url(imagenes/tratamientos/dermatologia.jpg)"});
                     });
              }
       }
       function btns_pc(nombre){
            $('#lista_trat li').css({"background-color":"#fff","color":"#8F7D53"});
              $(".zonas").css({"opacity":"0"});
              $("#"+nombre).css({"opacity":"1"});
             $('#lista_trat li[name='+nombre+']').css({"background-color":"#8F7D53","color":"#fff"});
       }