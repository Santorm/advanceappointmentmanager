$(document).ready(inici_contact);
function inici_contact(){
	$(".form_confirm").on("blur",validar);
}


	function validar(){
		var todo_correcto = true;
		nombre=$("#form_nombre");
		telefono=$("#form_tel");
		email=$("#form_email");
		mensaje=$("#form_mensaje");
		val_email=email.val();
		val_telefono=telefono.val();
		val_mensaje=mensaje.val();
		val_nombre=nombre.val();
		
		mensaje_error_nombre="Debes completar tu nombre!";
		mensaje_error_telefono="Introduce un teléfono válido!";
		mensaje_error_email="Introduce un e-mail válido!";
		mensaje_error_mensaje="El campo mensaje está vacío!";
		
		if(val_nombre.trim() == "" || val_nombre.length>40 ){
			nombre.val("");
			nombre.attr("placeholder",mensaje_error_nombre);
       		var todo_correcto = false;
        }
        if(val_telefono.trim() == "" ||  !(val_telefono.match(/^\d+$/)) || val_telefono.length>14){
        	telefono.val("");
			telefono.attr("placeholder",mensaje_error_telefono);
			var todo_correcto = false;
        }
        if(!(val_email.match(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/)) || val_email.length>30){
        	email.val("");
			email.attr("placeholder",mensaje_error_email);
			var todo_correcto = false;
    	 }
    	 if(val_mensaje.trim() == "" || val_email.length>600 ){
			mensaje.val("");
			mensaje.attr("placeholder",mensaje_error_mensaje);
			var todo_correcto = false;
         }

        if(!todo_correcto){
        	$("#notificacion").html('Algunos campos no están correctos, vuelva a revisarlos!');
			}else{

			$("#notificacion").html('');
			return todo_correcto;
			}
	}
function enviar_formulario(){
	if(validar()){
			val_pagina_formulario=$("#pagina_formulario").val();
			$.ajax({
					url: "files/phpmailer.php",
					type: "post",
					data: {"nombre":val_nombre, "mensaje": val_mensaje, "emailremitente":val_email,"telefono":val_telefono, "val_pagina_formulario":val_pagina_formulario},	
						success: function(data_mail) {
							procesaRespuesta(data_mail);
						},
			});
	}

}

 
function procesaRespuesta(resp){
        	$("#notificacion").html(resp);
        	
}