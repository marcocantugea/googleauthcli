<?php

use GoogleServices\Mail\AuthGoogleMailService;

include __DIR__ ."../../../../vendor/autoload.php";

/**
 * Ejemplo de como obtener los correos electronicos
 * Se requiere que se tenga las credenciales oAuth en raiz del proyecto
 * 
 */

 //Obtenemos el servicio de gmail
 $GoogleClient = (new AuthGoogleMailService())->getClient();
 $Gmailservice = new Google_Service_Gmail($GoogleClient);

 //parametros para obtener los correos
 $options = array('labelIds' => 'INBOX', 'maxResults' => 2, 'q' => 'is:unread');
 //Obtiene los mensajes
 $messages = $Gmailservice->users_messages->listUsersMessages('me', $options);
 
 foreach ($messages as $message) {
  print('inicia mensaje' . PHP_EOL);
  print('------------------------------------' .PHP_EOL);
  print('id de mensaje '. $message['id'] .PHP_EOL);

  //Obtiene el encabezado del mensaje
  $Emailmessage = $Gmailservice->users_messages->get('me', $message['id'], ['format' => 'FULL']);
  foreach($Emailmessage['payload']->getHeaders() as $header){
      print_r($header->name." : ".$header->value . PHP_EOL);
  }

  //obtiene el contenido del mensaje
  print('contenido del mensaje' . PHP_EOL);
  print('------------------------------------' .PHP_EOL);
  $MessagePayload = $Emailmessage->getPayload()->getParts();
  foreach($MessagePayload as $part){
      if($part->mimeType=="text/html"){
        print_r(base64_decode($part['body']['data']));
      }
  }

  print('------------------------------------' .PHP_EOL);
  print('Termina mensaje' . PHP_EOL);

 }