<?php

namespace app\Repositories;

use app\DataAccess\MongoConnection;
use app\Interfaces\IDBConnection;
use app\Interfaces\IModel;
use app\Interfaces\IRepository;
use MongoDB\BSON\ObjectId;

class UsuariosRepositorio implements IRepository{

    /** @var IDBConnection $connection */
    private $adapter=null;
    private $collection="usuarios";

    public function __construct()
    {
       $this->loadConnectionSettings();
       
    }

    function add(IModel $model){
        $response=null;
        try {
            $collection = $this->adapter->getCollection();
            $response=$collection->insertOne($model);
        } catch (\Throwable $th) {
            throw $th;
        }
        return $response;
    }

    function update($id,IModel $model){
        try {
            $collection = $this->adapter->getCollection();
            $userObj =$collection->findOne();
            if(!empty($userObj)){
                
                $model->user=(!empty($model->user)) ? $model->user : $userObj->user ;
                $model->email=(!empty($model->email)) ? $model->email : $userObj->email;
                $model->password=(!empty($model->password)) ? $model->password : $userObj->password;
                unset($model->__pclass);

                $collection->updateOne(["_id"=> new ObjectId($id)],['$set'=>$model]);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    function getById($id){
        $resulset=array();
        try {
            $resulset=$this->adapter->getCollection()->findOne(['_id'=> new ObjectId($id)]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $resulset;
    }
    
    function getAll(){
        $resulset=array();
        try {
            $resulset=$this->adapter->getCollection()->find();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $resulset;
    }

    function delete($id){
        $resulset=array();
        try {
            $resulset=$this->adapter->getCollection()->deleteOne(['_id'=> new ObjectId($id)]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $resulset;
    }

    function loadConnectionSettings(){
        if(empty($this->adapter)) $this->adapter= new MongoConnection();
        $this->adapter->openConnection();
        $this->adapter->selectCollection($this->collection);
    }

    function setConnection(IDBConnection $connection)
    {
        $this->adapter= $connection;
    }

    public function getUser(string $usuario,string $password){
        $userObj=null;
        try {
            $userObj=$this->adapter->getCollection()->findOne(['user'=>$usuario,'password'=>$password]);
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return $userObj;
    }

    public function getUserByUserName(string $usuario){
        $userObj=null;
        try {
            $userObj=$this->adapter->getCollection()->findOne(['user'=>$usuario]);
        } catch (\Throwable $th) {
            throw $th;
        }
        return $userObj;
    }

}