<?php

namespace app\config;

class AppConfig{

    private $configuration=null;
    private $pathConfig="./app/config/";
    private $defaultConfigFileName="app-config.json";

    public function __construct()
    {
        $this->loadConfig();    
    }

    private function loadConfig(){
        $configuration=array();
        if(!file_exists($this->pathConfig.$this->defaultConfigFileName)) return $configuration;

        $configuration = json_decode(file_get_contents($this->pathConfig.$this->defaultConfigFileName),true);

        if(!empty($configuration)) $this->configuration= $configuration;

        return $this->configuration;
    }

    public function get(string $parameter){
        if(empty($this->configuration)) $this->loadConfig();
        if(!isset($this->configuration[$parameter])) return null;
        return $this->configuration[$parameter];
    }

}