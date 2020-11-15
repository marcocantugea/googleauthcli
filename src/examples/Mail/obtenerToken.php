<?php

use GoogleServices\Mail;
use GoogleServices\Mail\AuthGoogleMailService;

include __DIR__ ."../../../../vendor/autoload.php";

/**
 * Este ejemplo es como obtener antes el token y la autorizacion del usuario para acceder a su cuenta de gmail
 * es necesario crear las cerenciales oAth para la aplicacion que requieras
 * 
 * 
 */

 //Generar el link para el usuario
$url= AuthGoogleMailService::getActivationURL();
echo('Url de para activacion'.PHP_EOL);
echo(PHP_EOL);
echo($url);
echo(PHP_EOL);
echo('Ingrese el codigo de verificacion'.PHP_EOL);
//Creacion de token para la aplicacion
AuthGoogleMailService::setActivationCode(readline());
//Crea el archivo token.json en raiz
echo('token gerado'.PHP_EOL);