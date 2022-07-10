<?php

namespace app;

use controllers\router;
use app\config\AppConfig;
use app\Handlers\Encryptor;

class Application{

    /** @var AppConfig  */
    private $appConfiguration=null;
    /** @var router  */
    private $Router = null;

    protected function __construct()
    {
        $this->appConfiguration= new AppConfig();
        $this->Router= new router();
    }

    public static function reroute(){
        router::reroute();
    }

    public static function getConfiguration(string $parameter){
        $appConfig=new AppConfig();
        return $appConfig->get($parameter);
    }

    public static function setSessionVariable(string $variable,$object){
        if(isset($_SESSION[$variable])) $_SESSION[$variable]=base64_encode(Encryptor::encryptInfo(serialize($object)));
        $_SESSION[$variable]=base64_encode(Encryptor::encryptInfo(serialize($object)));
    }

    public static function getSessionVariable(string $variable){
        return (isset($_SESSION[$variable])) ? unserialize(Encryptor::decryptInfo(base64_decode($_SESSION[$variable]))) : null;
    }
}