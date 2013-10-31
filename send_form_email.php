<?php

if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "info@americaorganica.com";
    $email_subject = "Contacto desde Web";
     
     
    function died($error) {
        // your error code can go here
        echo "Lo sentimos mucho, pero se encontraron algunos errores con el formulario que has enviado. ";
        echo "Estos errores aparecen abajo.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor regrese y arregle los errores.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['nombre']) ||
        !isset($_POST['company']) ||
        !isset($_POST['pais']) ||
        !isset($_POST['ciudad']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['comentarios'])) {
        died('Lo sentimos, pero parece que hay un problema con el formulario que has enviado.');       
    }
     
    $nombre = $_POST['nombre']; // required
    $company = $_POST['company']; // not required
    $email_from = $_POST['email']; // required
    $pais = $_POST['pais']; // not required
    $ciudad = $_POST['ciudad']; // not required
    $telefono = $_POST['telefono']; // not required
    $comentarios = $_POST['comentarios']; // not required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'El Email introducido no parece ser valido.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$nombre)) {
    $error_message .= 'El Nombre introducido no parece ser valido.<br />';
  }
  /*
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'El Nombre de Compa&ntilde;&iacute;a introducido no parece ser valido.<br />';
  }
  if(!preg_match($string_exp,$pais)) {
    $error_message .= 'El Pa&iacute;s introducido no parece ser valido.<br />';
  }
  if(!preg_match($string_exp,$ciudad)) {
    $error_message .= 'La ciudad introducida no parece ser valida.<br />';
  }
  if(strlen($comentarios) < 2) {
    $error_message .= 'Los comentarios introducidos no parecen ser validos.<br />';
  }
   * 
   */
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Detalles del formulario.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Empresa: ".clean_string($company)."\n";
    $email_message .= "Pais: ".clean_string($pais)."\n";
    $email_message .= "Ciudad: ".clean_string($ciudad)."\n";
    $email_message .= "Telefono: ".clean_string($telefono)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";    
    $email_message .= "Comentarios: ".clean_string($comentarios)."\n";
     
     
// create email headers
$headers = 'De: '.$email_from."\r\n".
'Responder a: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  

?>
 
<!-- include your own success html here -->
 Gracias por Contactarnos. Pronto estaremos en contacto con Ud.
 
<?php
}
?>
