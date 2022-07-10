<?php

namespace app\DataAccess;

use app\Interfaces\IDBConnection;
use Exception;
use MongoDB\Client;

class MongoConnection implements IDBConnection {
    
    /** @var Client $client */
    private $client=null; 
    private $database=null;
    private $collection=null;

    function openConnection(){
        $host = (isset($_ENV["MONGODB_HOST"]))? $_ENV["MONGODB_HOST"] :"";
        $port =(isset($_ENV["MONGODB_PORT"]))? $_ENV["MONGODB_PORT"] :"";
        $uri="mongodb://$host:$port/?readPreference=primary&appname=MongoDB%20Compass%20Community&ssl=false";
        $this->client= new Client($uri);
        if(empty($database)) $this->database=(isset($_ENV["MONGODB_DATABASE"]))? $_ENV["MONGODB_DATABASE"] :"";
        $this->client->selectDatabase($this->database);
    }

    function closeConnection(){
        $this->client=null;
    }

    function getConfiguration(){
        return [
            'host'=>  (isset($_ENV["MONGODB_HOST"]))? $_ENV["MONGODB_HOST"] :"",
            'port'=>  (isset($_ENV["MONGODB_PORT"]))? $_ENV["MONGODB_PORT"] :"",
            'db' => (isset($_ENV["MONGODB_DATABASE"]))? $_ENV["MONGODB_DATABASE"] :"",
        ];
    }

    function getClient(){
        return $this->client;
    }
    

    /**
     * Get the value of database
     */ 
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Set the value of database
     *
     * @return  self
     */ 
    public function setDatabase($database)
    {
        $this->database = $database;

        return $this;
    }

    /**
     * Get the value of collection
     */ 
    public function getCollection()
    {
        return $this->client->{$this->database}->{$this->collection};
    }

    /**
     * Set the value of collection
     *
     * @return  self
     */ 
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }
    
    public function selectCollection($collecion){
        $this->collection=$collecion;
        $this->client->selectCollection($this->database,$collecion);
    }
}
