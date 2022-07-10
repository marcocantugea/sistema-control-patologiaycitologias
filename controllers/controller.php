<?php

namespace controllers;

use app\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller{

    private $request=null;
      
    public function getRequest(){
        if(empty($this->request)) $this->request = Request::createFromGlobals();
        return $this->request;
    }
    
    public function failResponse(int $httpCode=404){
        $response = new Response();
        $response->setStatusCode($httpCode);
        $response->prepare($this->getRequest());
        $response->send();
        exit();
    }

    public function jsonResponse(array $data){
        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent(json_encode($data));
        $response->headers->set('Content-type','application/json');
        $response->prepare($this->getRequest());
        $response->send();
        exit();
    }

    public function isGet(): bool {
        return $this->getRequest()->server->get('REQUEST_METHOD')=='GET';
    }

    public function isPost(): bool {
        return $this->getRequest()->server->get('REQUEST_METHOD')=='POST';
    }

    public function isPut(): bool {
        return $this->getRequest()->server->get('REQUEST_METHOD')=='PUT';
    }

    public function isDelete(): bool {
        return $this->getRequest()->server->get('REQUEST_METHOD')=='DELETE';
    }

    public function validatePubliKey(){

        $request = $this->getRequest();
        $key=$request->headers->get('publickey');
        if(empty($key)) return $this->failResponse(401);
        if($key!=$_ENV['PUBLIC_KEY']) return $this->failResponse(401);

    }

    public function validateBasicAuth(){
        $request = $this->getRequest();
        $rawBasicAuth=$request->headers->get('Authorization');
        $decode = base64_decode(substr($rawBasicAuth,5));
        if($decode===false) $this->failResponse(401);
        if(strpos($decode,":")===false) $this->failResponse(401);
        $basicAuth= explode(":",$decode);
        if($basicAuth[0]!=$_ENV['API_USERNAME'])  $this->failResponse(401);
        if($basicAuth[1]!=$_ENV['API_USERPASSWORD'])  $this->failResponse(401);
    }

    public function redirect(string $url){
        $response = new RedirectResponse($url);
        $response->send();
        exit();
    }
}