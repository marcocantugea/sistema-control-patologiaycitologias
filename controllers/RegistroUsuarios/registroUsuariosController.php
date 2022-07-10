<?php 

namespace controllers\RegistroUsuarios;

use controllers\Controller;

class registroUsuariosController extends Controller{

    public function addAction(){

        if(!$this->isPost()) return $this->failResponse(401);

        $this->validateBasicAuth();
        $this->validatePubliKey();

        $this->jsonResponse(['success'=>true]);

    }

}