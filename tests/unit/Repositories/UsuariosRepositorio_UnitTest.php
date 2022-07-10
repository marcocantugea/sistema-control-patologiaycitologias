<?php

namespace Test\units\Repositories;

use app\Models\Usuario;
use app\Repositories\UsuariosRepositorio;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\isInstanceOf;

class UsuariosRepositorio_UnitTest extends TestCase{

    public function setUp():void{
        putenv("MONGODB_URI=mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass%20Community&ssl=false");
    }

    public function test_Prueba(){
        $this->assertTrue(true);
    }

    public function test_UsuariosRepositorio_addmodel(){
        $UserRepo= new UsuariosRepositorio();
        $usuario = new Usuario();
        $usuario->user="marcocantu";
        $usuario->email="marco.cantu.g@gmail.com";

        try {
            $UserRepo->add($usuario);
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->assertTrue(true);
        
    }

    public function test_UsuariosRepositorio_getAll(){
        $UserRepo= new UsuariosRepositorio();
        try {
            $resulset= $UserRepo->getAll();
        } catch (\Throwable $th) {
            throw $th;
        }

        $instanceOfUsuario=true;
        foreach($resulset as $document){
           if(!$document instanceof Usuario){
                $instanceOfUsuario=false;
           }
        }

        $this->assertTrue($instanceOfUsuario);
    }

    public function test_UsuariosRepositorio_updateAllData(){
        // 629b34a57876000082006de2
        $UserRepo= new UsuariosRepositorio();
        try {
            $user = new Usuario();
            $user->user="admin";
            $user->email="admin@server.com";
            $user->password="passwithoutencription";
            $UserRepo->update('629b348cb95b0000d60027a2',$user);
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->assertTrue(true);
    }

    public function test_UsuariosRepositorio_updateUser(){
        // 629b34a57876000082006de2
        $UserRepo= new UsuariosRepositorio();
        try {
            $user = new Usuario();
            $user->user="adminUser";
            $UserRepo->update('629b348cb95b0000d60027a2',$user);
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->assertTrue(true);
    }

    public function test_UsuariosRepositorio_getUserId(){
        $UserRepo= new UsuariosRepositorio();
        try {
            $resulset= $UserRepo->getById('629b348cb95b0000d60027a2');
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->assertInstanceOf(Usuario::class,$resulset);

    }

}