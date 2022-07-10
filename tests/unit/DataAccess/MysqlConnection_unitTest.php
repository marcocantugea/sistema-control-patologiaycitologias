<?php 

namespace Test\units;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use app\DataAccess\MysqlConnection;

class MysqlConnection_unitTest  extends TestCase {

    public function setUp():void{
        $dotenv =Dotenv::createImmutable("./");
        $dotenv->load();
    }
    
    public function test_OpenConnection_openConnectionSuccess(){
        $mysql = new MysqlConnection();
        $mysql->openConnection();
        $mysql->closeConnection();
        $this->assertTrue(true);
    }

}