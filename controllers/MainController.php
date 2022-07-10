<?php

namespace controllers;

use app\Application;

class MainController extends Controller{

    public function indexAction(){
        return (new View())->setModel(['appName'=>Application::getConfiguration('appName')])->
                setRequireUserSession(false)->render();
        
    }

    public function errorAction(){
        return (new View('notfound'))->render();
    }


}