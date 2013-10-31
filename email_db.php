<?php
if(isset($_POST['email'])) {//revisar según formulario
    
	function died($error) {
        // Se imprimen los errores
        echo "Lo sentimos mucho, pero se encontraron algunos errores con el formulario que has enviado. ";
        echo "Estos errores aparecen abajo.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor regrese y arregle los errores.<br /><br />";
        die();
    }

	// verificando que existan los datos
    if( !isset($_POST['nombre']) ||
        !isset($_POST['de']) ||
        !isset($_POST['para']) ||
        !isset($_POST['asunto']) ||
        !isset($_POST['contenido'])
		
		) {
        died('Lo sentimos, pero parece que hay un problema con el formulario que has enviado.');       
    }
	
	$nombre = $_POST['nombre']; // not required
    $de = $_POST['de']; // required
    $para = $_POST['para']; // required
    $asunto = $_POST['asunto']; // not required
    $contenido = $_POST['contenido']; // not required
    
	 $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$de)) {
    $error_message .= 'El Email (de) introducido no parece ser valido.<br />';
  }
  if(!preg_match($email_exp,$de)) {
    $error_message .= 'El Email (para) introducido no parece ser valido.<br />';
  }

  //verificando los mensajes de error
	if(strlen($error_message) > 0) {
		died($error_message);
  }
  
	//Conectando con la Base de datos
	$link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';
	
	//Consulta para insertar los datos en la tabla 
	$query = sprintf("INSERT INTO form ('nombre','de','para','asunto','contenido')
								VALUES ('%s',	'%s',	'%s',	'%s',	'%s')",
					mysql_real_escape_string($nombre),
					mysql_real_escape_string($de),
					mysql_real_escape_string($para),
					mysql_real_escape_string($asunto),
					mysql_real_escape_string($contenido),
					);
// Realizar consulta
$result = mysql_query($query);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}
/*
// Use result
// Attempting to print $result won't allow access to information in the resource
// One of the mysql result functions must be used
// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
while ($row = mysql_fetch_assoc($result)) {
    echo $row['firstname'];
    echo $row['lastname'];
    echo $row['address'];
    echo $row['age'];
}

// Free the resources associated with the result set
// This is done automatically at the end of the script
mysql_free_result($result);
*/	
	//Cerrando la conexión
	mysql_close($link);
	
	
}
?>