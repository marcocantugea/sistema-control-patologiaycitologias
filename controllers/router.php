<?php

namespace controllers;

use controllers\config\ControllersConfig;
use controllers\MainController;

class router {

    private $controllers=null;

    public function __construct()
    {
        $this->controllerConfig = ControllersConfig::getConfig();
    }

    public static function reroute() : void{

        $mainController =ControllersConfig::getConfig()['MainController'];

        if(!isset($_GET['url'])){
            $mainController= new $mainController;
            $mainController->indexAction();
            return;
        }

        $url= $_GET['url'];
        //si esta vacio lleva al controlador main
        if(empty($url)) {
            $mainController= new $mainController;
            $mainController->indexAction();
            return;
        }

        $actions= explode("/",$url);

        $controller= $actions[0]."Controller";
        $controllerAction = (isset($actions[1])) ? $actions[1]."Action" : null;
        unset($actions[0]);
        unset($actions[1]);
        $args = $actions;

        //cargamos el controllador
        if(!isset(ControllersConfig::getConfig()[$controller])) {
            $mainController= new $mainController;
            $mainController->errorAction();
            return;
        }

        $controllerName=ControllersConfig::getConfig()[$controller];
        $controllerObj = new $controllerName;
        try {
            $controllerObj->{$controllerAction}($args);
        } catch (\Throwable $th) {
            $mainController= new $mainController;
            $mainController->errorAction();
            return;
        }

    }

    private function MainControllerErrorAction($mainController){
        $mainController= new $mainController;
        $mainController->errorAction();
        return;
    }
}