<?php

namespace controllers\config;

use controllers\MainController;
use controllers\RegistroUsuarios\registroUsuariosController;
use controllers\Usuarios\usuariosController;

class ControllersConfig {

    public static function getConfig(){
        return [
            'MainController'=>MainController::class,
            'usuariosController' => usuariosController::class,
            'registroUsuariosController' => registroUsuariosController::class
        ];
    }

}