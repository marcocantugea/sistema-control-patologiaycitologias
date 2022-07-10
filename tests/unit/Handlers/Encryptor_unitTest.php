<?php

namespace Test\units\Handlers;

use app\Handlers\Encryptor;
use PHPUnit\Framework\TestCase;

class Encryptor_unitTest extends TestCase {

    public function test_Prueba1(){
        $this->assertTrue(true);
    }

    public function test_encryptInfo_encryptData(){

        $dotenv = \Dotenv\Dotenv::createImmutable("./");
        $dotenv->load();

        $dataEncrypted = Encryptor::encryptInfo("this is the info");
        $this->assertNotEquals("this is the info",$dataEncrypted);
    }

    public function test_encryptInfo_noConfiguration(){
        unset($_ENV['APP_KEY_ENCRYPTION']);

        $dataEncrypted = Encryptor::encryptInfo("this is the info");
        $this->assertEquals("this is the info",$dataEncrypted);
    }

    public function test_encryptInfo_decryptData(){

        $dataEncrypted = Encryptor::encryptInfo("this is the info");
        $datadecrypted = Encryptor::decryptInfo($dataEncrypted);

        $this->assertEquals("this is the info",$datadecrypted);
    }

}