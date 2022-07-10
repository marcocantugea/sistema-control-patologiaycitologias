<?php

namespace app\Handlers;

class Encryptor{

    public static function encryptInfo(string $texto){
        if(!isset($_ENV['APP_KEY_ENCRYPTION']) || !isset($_ENV['APP_METHOD_ENCRYPTION']))
            return $texto;
            
        return openssl_encrypt($texto,$_ENV['APP_METHOD_ENCRYPTION'],$_ENV['APP_KEY_ENCRYPTION']);
    }

    public static function decryptInfo(string $texto){

        if(!isset($_ENV['APP_KEY_ENCRYPTION']) || !isset($_ENV['APP_METHOD_ENCRYPTION']))
            return $texto;
        return \openssl_decrypt($texto,$_ENV['APP_METHOD_ENCRYPTION'],$_ENV['APP_KEY_ENCRYPTION']);

    }

}