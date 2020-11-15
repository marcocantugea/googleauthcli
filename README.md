<!-- <p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo"></a>
</p> -->

<h3 align="center">Servicios Google Librerias de Autentificación <br>mcg/google-auth-service</h3>

<div align="center">

<!-- [![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Issues](https://img.shields.io/github/issues/kylelobo/The-Documentation-Compendium.svg)](https://github.com/kylelobo/The-Documentation-Compendium/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/kylelobo/The-Documentation-Compendium.svg)](https://github.com/kylelobo/The-Documentation-Compendium/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE) -->

</div>

---

<p align="center"> Librer&iacute;as en PHP para facilitar la autentificaci&oacute;n hacia los servicios de Google como Gmail, Google  Drive usando las REST APIs de Google.
    <br> 
</p>

## 📝 Table of Contents

- [Acerca](#about)
- [Requerimientos](#Requerimientos)
- [Instalacion](#install)
- [Autentificaci&oacute;n a GMail por API](#usageMail)
- [Built Using](#built_using)
- [TODO](../TODO.md)
- [Contributing](../CONTRIBUTING.md)
- [Authors](#authors)
- [Acknowledgments](#acknowledgement)

## 🧐 Acerca <a name = "about"></a>

Estas clases son de ayuda a simplificar el proceso de obtener el cliente del servicio de google asi como realizar la 
autentificacion de Google

## 🏁 Requetimientos <a name = "Requerimientos"></a>

Antes de utilizar esta clase ser requiere crear las credenciales oAuth de google descargando el archivo json de la consola de APIs.

Para mayor informacion utilize la siguiente liga:

<a href="https://developers.google.com/identity/protocols/oauth2">https://developers.google.com/identity/protocols/oauth2</a>

Una vez descargado nuesro archivo de credenciales lo agregamos a nuestro proyecto, puede ser en la raiz del proyecto o en alguna 
carpeta deseada, por defecto , la libreria busca el archivo "./credentials.json" en la ra&iacute;z del proyecto.

En los siguientes ejemplo se ralizara basandonos que el archivo de credenciales esta en la ra&iacute;z del proyecto.

### Instalacion <a name = "install"></a>

Para la instalaci&oacute;n se utiliza via composer

```
composer require mcg/google-auth-service

```

## 🔧 Autentificaci&oacute;n a GMail por API <a name = "usageMail"></a>

Basandonos que el archivo de credenciales esta en la raiz del proyecto y tiene como nombre "credentials.json" se requiere que se agregen los permisos a esta aplicacion y crear un archivo del token que genera la autentificacion oAuth.

Para inicializar esta autentificaci&oacute;n se necesita llamar a la pagina de google para que el usuario le de perimiso a la aplicaci&oacute:n.

Para eso utilizamos el siguiente codigo desde nuestra consola:
...
  $url=AuthGoogleMailService::getActivationURL();
  print_r($url);
  AuthGoogleMailService::setActivationCode(readline());
...

El resultado sera un archivo json en la raiz de nuestro proyecto con el token oAuth generado por Google.

Si deseamos configurar la ruta de el archivo de credenciales y del token, utilizamos el siguente codigo.
...
$AuthGoogleMailService= new AuthGoogleMailService();
$AuthGoogleMailService->setCredentialsJsonPath("./credenciales/credentialsGmail.json");
$AuthGoogleMailService->setTokenPath("./tokens/tokenGmail.json");

$MailClient=$AuthGoogleMailService->getClient();
...

...
 $GoogleMailServiceClient= new AuthGoogleMailService()->getClient();
...

De esta manera obtenemos el cliente 

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## 🎈 Usage <a name="usage"></a>

Add notes about how to use the system.

## 🚀 Deployment <a name = "deployment"></a>

Add additional notes about how to deploy this on a live system.

## ⛏️ Built Using <a name = "built_using"></a>

- [MongoDB](https://www.mongodb.com/) - Database
- [Express](https://expressjs.com/) - Server Framework
- [VueJs](https://vuejs.org/) - Web Framework
- [NodeJs](https://nodejs.org/en/) - Server Environment

## ✍️ Authors <a name = "authors"></a>

- [@kylelobo](https://github.com/kylelobo) - Idea & Initial work

See also the list of [contributors](https://github.com/kylelobo/The-Documentation-Compendium/contributors) who participated in this project.

## 🎉 Acknowledgements <a name = "acknowledgement"></a>

- Hat tip to anyone whose code was used
- Inspiration
- References
