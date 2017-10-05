<?php 

//AQUI PRIMERO INCLUIMOS UN FICHERO DE LA CARPETA PHPMAILER, PARA ESO HAY QUE VER BIEN LA RITA DE DONDE ESTA LA ALIBRERIA   
require("PHPMailer-master/PHPMailerAutoload.php");
//recuperamos la informacion del formulario
//ojo apra envio de archivos solo funcion a con post
if(isset($_POST['nombre'])){

  $destinatario='lunapiel@gmail.com';
  $nombre_remitente=$_POST['nombre'];
  $mensaje=$_POST['mensaje'];
  $email_remitente=$_POST['emailremitente'];
  $telefono=$_POST['telefono'];
  $val_pagina_formulario=$_POST['val_pagina_formulario'];

  if(trim($destinatario)=='' || trim($nombre_remitente)=='' || trim($mensaje)=='' || trim($telefono)==''){
    echo "Revisa que todos los campos esten completos!";

  }else{

  $mensajeMail="$val_pagina_formulario <br>Nombre:$nombre_remitente <br>Teléfono:$telefono <br>Email:$email_remitente <br>Mensaje: $mensaje";
     //instanciamos un objeto de la clase php
            $mail = new PHPMailer();
            //configuramos el juego de caracteres utf8
            $mail->CharSet = 'utf-8';
            //segun las funciones podemos incluir o no algunas funciones
            $mail->From = $email_remitente;
            $mail->FromName = $nombre_remitente;
            //ponemso tantas lineas de addaddress como tantos otros destinatarios querramos, dejamos solo una de ejemp que es necesaria 
            //aqui va a donde se enviará el correo
            $mail->AddAddress($destinatario, "Contacto LunaPiel");
            $mail->AddAddress("prueba@mail.com", "mail");
            //$mail->addCC('cc@example.com'); //añadir copia a otro correo
            //$mail->addBCC('bcc@example.com'); //añadir copia oculta a otro correo
            //para que se envie como formato html con imagenes etc... si se quiere cambiar se pone false
            $mail->isHTML(true); // el mensaje es en formato HTML
            $mail->Subject = 'Contacto desde la web';
            //AQUI VA ELMENSAJE QUE QUEREMOS ENVIAR
            $mail->Body = $mensajeMail;
            //$mail->AltBody = 'Mensaje alternativo en texto para clientes de correo que no soportan HTML';
            $mail->SMTPDebug = 0; // indica si queremos activar los mensajes del debugger (0 o 1)
            
            
            
            if(!$mail->send()) {

            $mensajeerror="Lo sentimos! parece haber ocurrido un error, Por favor intentalo más tarde";

       



           // echo 'Mensaje NO enviado <br>';
           // echo 'Mailer Error: '. $mail->ErrorInfo;
            
            //header("location:../contacto.php");
            echo $mensajeerror;
            
            } else {

            $mensajeenvio='Tu mensaje se ha enviado correctamente, espera pronto nuestra respuesta!';
       
              echo $mensajeenvio;        
            }


//guardar los email en el archivo externo emailsrecibidos.txt

       $hoy = getdate();
       $fecha=$hoy['mday'].' '.$hoy['month'].' '.$hoy['year'].' '.$hoy['hours'].' '.$hoy['minutes'];
       $fichero_mail=fopen("emailsrecibidos.txt", "a");
       $mail_enviado="$val_pagina_formulario Fecha: $fecha Enviado por: $nombre_remitente Teléfono:$telefono E-mail:$email_remitente Mensaje:$mensaje Estado de envío:$mensajeerror\r\n";
       fputs($fichero_mail, $mail_enviado);
       fclose($fichero_mail);
  }
}
?>
