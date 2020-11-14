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
            $GmailClient= $this->GoogleMailServiceClient->getClient();
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

    
}