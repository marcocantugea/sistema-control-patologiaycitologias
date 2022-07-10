<?php

namespace Test\units\Servicios;

use app\Models\Usuario;
use app\Repositories\UsuariosRepositorio;
use app\Services\UsuariosServicios;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\isInstanceOf;

class UsuariosServicios_UnitTest extends TestCase{

    public function setUp():void{
        $dotenv = \Dotenv\Dotenv::createImmutable("./");
        $dotenv->load();
    }

    public function test_Test1(){
        $this->assertFalse(false);
    }

    public function test_UsuariosServicios_login_Valid(){
        $UsuarioServicios = new UsuariosServicios();

        $reponse = $UsuarioServicios->loginUser("admin","turnos$34");

        $this->assertArrayHasKey('success',$reponse);
        $this->assertArrayHasKey('message',$reponse);
        $this->assertArrayHasKey('data',$reponse);
        $this->assertTrue($reponse['success']);

    }

    public function test_UsuariosServicios_login_NoValid(){
        $UsuarioServicios = new UsuariosServicios();

        $reponse = $UsuarioServicios->loginUser("adminUser","ddfd");

        $this->assertArrayHasKey('success',$reponse);
        $this->assertArrayHasKey('message',$reponse);
        $this->assertArrayHasKey('data',$reponse);
        $this->assertFalse($reponse['success']);

    }

    public function test_UsuariosServicios_addUser_validaValoresVacios(){

        $UsuarioServicios = new UsuariosServicios();
        $usuarioPrueba= new Usuario();

        $usuarioPrueba->email="server@gmail.com";
        $usuarioPrueba->password="12345";

        $response= $UsuarioServicios->addUser($usuarioPrueba);

        $this->assertFalse($response['success']);

    }

    public function test_UsuariosServicios_addUser_validaUsuarioExistente(){

        $UsuarioServicios = new UsuariosServicios();
        $usuarioPrueba= new Usuario();

        $usuarioPrueba->user="marcocantu";
        $usuarioPrueba->email="marco.cantu.g@gmail.com";
        $usuarioPrueba->password="12345";

        $response= $UsuarioServicios->addUser($usuarioPrueba);

        $this->assertFalse($response['success']);

    }

    public function test_UsuariosServicios_addUser_agregaUsuarioSistema(){

        $UsuarioServicios = new UsuariosServicios();
        $usuarioPrueba= new Usuario();

        $usuarioPrueba->user="admin999";
        $usuarioPrueba->email="marco.cantu.g@gmail.com";
        $usuarioPrueba->password="12345";

        $response= $UsuarioServicios->addUser($usuarioPrueba);

        $this->assertTrue($response['success']);

    }

}