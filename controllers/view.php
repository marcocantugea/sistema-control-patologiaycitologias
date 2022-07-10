<?php

namespace controllers;

use app\Application;

class View{

    private $viewPath="./views/";
    private $viewName="index";
    private $model=null;
    private $requireUserSession=true;
    
    public function __construct(string $viewName="index")
    {
        $this->viewName=$viewName;
    }
    
    public function render(){
        require($this->viewPath.$this->viewName."_view.php");
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of requireUserSession
     */ 
    public function getRequireUserSession(): bool
    {
        return $this->requireUserSession;
    }

    /**
     * Set the value of requireUserSession
     *
     * @return  self
     */ 
    public function setRequireUserSession(bool $requireUserSession)
    {
        $this->requireUserSession = $requireUserSession;

        return $this;
    }

    public function getPathImages(): string{
        return Application::getConfiguration('host')."/public/images/";
    }

    public function getPathPublic():string{
        return Application::getConfiguration('host')."/public/";
    }

    public function getPathCss():string{
        return Application::getConfiguration('host')."/public/css";
    }

    public function getPathJs():string{
        return Application::getConfiguration('host')."/public/js";
    }

    public function getHostPath():string{
        return Application::getConfiguration('host')."/";
    }
}