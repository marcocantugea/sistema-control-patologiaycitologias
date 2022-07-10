<?php 

namespace Test\units;

use app\DataAccess\MongoConnection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class MongoConnection_UnitTest extends TestCase{

    public function setUp():void{
    }
    
    public function test_Prueba(){
        $mongoConnection = new MongoConnection();
        $this->assertTrue(true);
    }

    public function test_GetConfiguration_noEmpty(){
        $mongoConnection = new MongoConnection();
        $configuracion= $mongoConnection->getConfiguration();
        $this->assertArrayHasKey('host',$configuracion);
        $this->assertNotEmpty($configuracion['host']);
        $this->assertArrayHasKey('port',$configuracion);
        $this->assertNotEmpty($configuracion['port']);
        $this->assertArrayHasKey('db',$configuracion);
        $this->assertNotEmpty($configuracion['db']);
    }

    public function test_ConnectionOpenDb(){
        $mongoConnection = new MongoConnection();
        try {
            $mongoConnection->openConnection();
            $mongoConnection->closeConnection();
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->assertTrue(true);
    }

}