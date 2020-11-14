<?php

namespace GoogleServices\Mail;

use Google_Client;
use Google_Service_Gmail;

class AuthGoogleMailService
{

    private  $tokenPath = './token.json';
    private $Expiretoken = false;
    private $clientName="This is my CLI app";
    private $credentialsJsonPath="./credentials.json";
    private $accessType="offline";
    private $setPrompt="select_account consent";
    private $scope=Google_Service_Gmail::GMAIL_READONLY;

    /**
     * Constructor de servicio de Autentificacion de servicio de Mail de google
     */
    public function __construct()
    {
        
    }
    
    /**
     * Funcion para obtener el tokenen json y regresar un objeto cliente
     *
     * @return Google_Client
     */
    public function getClient() : Google_Client
    {

        $client = new Google_Client();
        $client->setApplicationName($this->clientName);
        $client->setScopes($this->scope);
        $client->setAuthConfig($this->credentialsJsonPath);
        $client->setAccessType($this->accessType);
        $client->setPrompt($this->setPrompt);

       
        $accessToken = $this->getGoogleToken();
        if (!is_null($accessToken)) {
            $client->setAccessToken($accessToken);
        }

        $this->Expiretoken=$client->isAccessTokenExpired();
        if($this->Expiretoken){
            $this->refreshToken($client);
        }

        return $client;
    }

    /**
     * Funcion para crear un json con  la llave obtenida de google
     *
     * @param string $path
     * @return mixed
     */
    public function getGoogleToken()
    {
        return (file_exists($this->tokenPath)) ? json_decode(file_get_contents($this->tokenPath), true) : null;
    }

    /**
     * Guarda el token de google en el path indicado
     *
     * 
     * @param mixed $token
     * @return self
     */
    public function saveGoogletoken( $token ,bool $delete = false)
    {

        if(file_exists($this->tokenPath) && $delete){
            unlink($this->tokenPath);
        }
        file_put_contents($this->tokenPath, json_encode($token));
        return $this;
    }

    
    /**
     * Realiza el proceso de dar  permisos a la aplicacion si se requiere cambiar de credenciales
     *
     * @return void
     */
    public static function grantAccessToCLI(callable $functoDisplayAnSetTheCode)
    {
        $GoogleAthService = new AuthGoogleMailService();
        $GoogleClient = $GoogleAthService->getClient();
        $token = $GoogleAthService->getGoogleToken();

        //Asigna el token si existe
        if (!is_null($token)) {
            $GoogleClient->setAccessToken($token);
        }

        if ($GoogleClient->isAccessTokenExpired()) {
            //actualiza token
            if ($GoogleClient->getRefreshToken()) {
                $GoogleClient->fetchAccessTokenWithRefreshToken();
            } else {
                //Debe solicitar al usuario el acceso a google
                $authLink = $GoogleClient->createAuthUrl();

                $authCode=$functoDisplayAnSetTheCode($authLink);
                // try {
                //     $this->openBrowser($authLink);
                // } catch (\Throwable $th) {
                //     LoggerHandler::logException('Makegoogleauth','makeGoogleAuth','Fail to open browser',$th);
                //     //throw $th;
                // }
               
                // $this->comment("URL > ". $authLink);
                // $this->info("Ingrese el codigo de verificacion: ");
                // $authCode=trim(fgets(STDIN));

                $tokenGenerated=$GoogleClient->fetchAccessTokenWithAuthCode($authCode);
                $GoogleClient->setAccessToken($tokenGenerated);
                //Error en en proceso
                if(array_key_exists('error',$tokenGenerated)){
                    throw new Exception(join(', ', $tokenGenerated));
                }
            }

            //guarda token
            $GoogleAthService->saveGoogletoken($GoogleClient->getAccessToken());
        }
    }


    /**
     * Get the value of tokenPath
     */ 
    public function getTokenPath()
    {
        return $this->tokenPath;
    }

    /**
     * Set the value of tokenPath
     *
     * @return  self
     */ 
    public function setTokenPath($tokenPath)
    {
        $this->tokenPath = $tokenPath;

        return $this;
    }

    /**
     * Get the value of Expiretoken
     */ 
    public function getExpiretoken()
    {
        return $this->Expiretoken;
    }

    /**
     * Actualiza el token 
     *
     * @param Google_Client $client
     * @return void
     */
    private function refreshToken(Google_Client $client){
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken();
            $this->getGoogleToken=$client->getAccessToken();
            $this->saveGoogletoken($this->getGoogleToken,true);
        }
    }


    /**
     * Get the value of clientName
     */ 
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set the value of clientName
     *
     * @return  self
     */ 
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get the value of credentialsJsonPath
     */ 
    public function getCredentialsJsonPath()
    {
        return $this->credentialsJsonPath;
    }

    /**
     * Set the value of credentialsJsonPath
     *
     * @return  self
     */ 
    public function setCredentialsJsonPath($credentialsJsonPath)
    {
        $this->credentialsJsonPath = $credentialsJsonPath;

        return $this;
    }

    /**
     * Get the value of accessType
     */ 
    public function getAccessType()
    {
        return $this->accessType;
    }

    /**
     * Set the value of accessType
     *
     * @return  self
     */ 
    public function setAccessType($accessType)
    {
        $this->accessType = $accessType;

        return $this;
    }

    /**
     * Get the value of setPrompt
     */ 
    public function getSetPrompt()
    {
        return $this->setPrompt;
    }

    /**
     * Set the value of setPrompt
     *
     * @return  self
     */ 
    public function setSetPrompt($setPrompt)
    {
        $this->setPrompt = $setPrompt;

        return $this;
    }

    /**
     * Get the value of scope
     */ 
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set the value of scope
     *
     * @return  self
     */ 
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }
}
