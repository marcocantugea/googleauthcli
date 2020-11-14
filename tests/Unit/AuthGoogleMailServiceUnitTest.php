<?php

namespace tests\Unit;


use PHPUnit\Framework\TestCase;
use GoogleServices\Mail\AuthGoogleMailService;


final class AuthGoogleMailServiceUnitTest extends TestCase{

    /**
     * Google Mail Service Client
     *
     * @var AuthGoogleMailService
     */
    private $GoogleMailServiceClient=null;

    public function setUp():void{
        $this->GoogleMailServiceClient= new AuthGoogleMailService();

    }

    public function tearDown():void{

    }

    /**
     * prueba para inizializar el cliente de gmail pero no encuentra las credenciales de json de las credenciales
     *
     * @return void
     */
    public function test_ObtieneElClienteDelSevicioDeGoogleConError(){
        try {
            $GmailClient= $this->GoogleMailServiceClient->setCredentialsJsonPath("./credentials-gmailcredentialdsfs.json")->getClient();
        } catch (\Throwable $th) {
            $this->asserttrue(true);
            //throw $th;
        }
    }

    /**
     * Prueba para inizializar el cliente del servicio de gmail especificando la ruta del json de las credenciales
     *
     * @return void
     */
    public function test_ObtieneElClienteDelSevicioDeGoogleSinErrores(){
        try {
            
            $GmailClient= $this->GoogleMailServiceClient
                                    ->setCredentialsJsonPath("./credentials-gmailcredentials.json")
                                    ->getClient()
                                    ;
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Fallo al obtner el token generado por gmail
     *
     * @return void
     */
    public function test_ObtenerElTokenNull(){
        try {
            $GmailClient= $this->GoogleMailServiceClient->setCredentialsJsonPath("./credentials-gmailcredentials.json")->getClient();
            $this->assertNull($this->GoogleMailServiceClient->getGoogleToken());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Prueba de impresion de url para obtener el codigo de verificacion
     *
     * @return void
     */
    public function test_TestgrantAccessToCLI(){
        try {
            $urlToAuth=AuthGoogleMailService::grantAccessToCLI();
            $this->assertIsString($urlToAuth);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Obtiene la URL para la autentificacion a google
     *
     * @return void
     */
    public function test_ObtenerURLDeAutentificacion(){
        try {
            $url=AuthGoogleMailService::getActivationURL();
            $this->assertIsString($url);
            print_r($url);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function test_GenerarTokendeAcceso(){
        try {
            AuthGoogleMailService::setActivationCode(readline());
            if(file_exists("./token.json")){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
}