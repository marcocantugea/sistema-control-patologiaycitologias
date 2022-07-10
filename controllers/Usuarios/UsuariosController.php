<?php

namespace controllers\Usuarios;

use app\Application;
use app\Handlers\Encryptor;
use controllers\View;
use app\Models\Usuario;
use controllers\Controller;
use app\Services\UsuariosServicios;

class usuariosController extends Controller{

    public function loginAction(){
        
        if($this->isPost()){
            //revisamos si el usuario es administrador
            $request= $this->getRequest();
            $usuario=$request->get('usuario');
            $password=Encryptor::encryptInfo($request->get('password'));
            
            $UserService= new UsuariosServicios();
            $response= $UserService->loginUser($usuario,$password);
            if($response['success']==false){
                $this->redirect(Application::getConfiguration('host'));        
            }

            Application::setSessionVariable('user',$response['data']); 
            $this->redirect(Application::getConfiguration('host'));

        }

    }

    public function logoutAction(){
        unset($_SESSION['user']);
        $this->redirect(Application::getConfiguration('host'));
    }

    public function addAction(){
        if($this->isPost()){
            
            if(empty(Application::getSessionVariable('user'))) $this->failResponse(401);

            //validamos que el cuerpo sea json
            $content= $this->getRequest()->getContent();
            $JsonContent= json_decode($content,true);

            if(empty($JsonContent)) $this->failResponse(500);

            //validamos que el cuerpo tenga las variables requeridas
            if(!isset($JsonContent['user']) || !isset($JsonContent['email']) || !isset($JsonContent['password']))
                 return $this->failResponse(500);

            //generamos el modelo de usuario a insertar
            $userToAdd= new Usuario();
            $userToAdd->user=$JsonContent['user'];
            $userToAdd->email=$JsonContent['email'];
            $userToAdd->password=$JsonContent['password'];

            //agregamos el usuario 
            $response=(new UsuariosServicios())->addUser($userToAdd);

            //regresamos respuesta
            $this->jsonResponse($response);
        }

        $this->failResponse(401);
    }
    
    public function deleteAction(){
        //validamos que sea un metodo DELETE
        if(!$this->isDelete()) $this->failResponse(401);
        //validamos que el usuario este en session
        //if(empty(Application::getSessionVariable('user'))) $this->failResponse(401);

        //obtenemos el cuerpo y lo convertimos a json
        // y validamos que en el cuerpo contenga las variables de id y token
        // despues comprobamos el token para evitar XSS
        $content= $this->getRequest()->getContent();
        $JsonContent= json_decode($content,true);
        
        if(!isset($JsonContent['id']) || !isset($JsonContent['word']) ) return $this->failResponse(500);

        //desencriptamos los valores 
        $id= Encryptor::decryptInfo($JsonContent['id']);
        $token=Encryptor::decryptInfo($JsonContent['word']);
        // aplicamos el decode base 64
        $token= base64_decode($token);
        //separamos por : para revision de id
        $tokenSplited= explode(":",$token);
        if(!isset($tokenSplited[0])) $this->failResponse(500);

        if($id!=$tokenSplited[0]) $this->failResponse(500);

        //eliminamos el usuario
        $response=(new UsuariosServicios)->eliminarUsuario($id);

        $this->jsonResponse($response);

    }

    public function passwordAction(){
        //validamos que sea un metodo DELETE
        if(!$this->isPut()) $this->failResponse(401);
        $content= $this->getRequest()->getContent();
        $JsonContent= json_decode($content,true);
        
        if(!isset($JsonContent['id']) || !isset($JsonContent['word']) || !isset($JsonContent['newpass']) ) return $this->failResponse(500);

        //desencriptamos los valores 
        $id= Encryptor::decryptInfo($JsonContent['id']);
        $token=Encryptor::decryptInfo($JsonContent['word']);
        $nuevaContrasena= $JsonContent['newpass'];
        // aplicamos el decode base 64
        $token= base64_decode($token);
        //separamos por : para revision de id
        $tokenSplited= explode(":",$token);
        if(!isset($tokenSplited[0])) $this->failResponse(500);

        if($id!=$tokenSplited[0]) $this->failResponse(500);

        if(empty($nuevaContrasena)) $this->failResponse(500);

        $response= (new UsuariosServicios())->actualizarContrasena($id,$nuevaContrasena);

        $this->jsonResponse($response);

    }

    public function agregarUsuariosAction(){
        return (new View('usuarios/agregarUsuario'))->render();
    }

    public function listarUsuariosAction(){

        $listadoUsuarios = (new UsuariosServicios)->getUsuarios();

        $model=[
            'listaUsuarios'=>$listadoUsuarios['data']
        ];

        return (new View('usuarios/listarUsuarios'))->setModel($model)->render();
        
    }
}