<?php 

namespace app\DataAccess;

use app\Interfaces\IDBConnection;
use PDO;

class MysqlConnection implements IDBConnection {
    /** @var PDO */
    private $client=null; 
    private $database="";
    private $persistentConnection=true;
    private $options=array();

    public function openConnection(){
        $host = (isset($_ENV["MYSQLDB_HOST"]))? $_ENV["MYSQLDB_HOST"] :"";
        $port =(isset($_ENV["MYSQLDB_PORT"]))? $_ENV["MYSQLDB_PORT"] :"";
        $user= (isset($_ENV["MYSQLDB_USER"]))? $_ENV["MYSQLDB_USER"] :"";
        if(empty($this->database)) $this->database =(isset($_ENV["MYSQLDB_DATABASE"]))? $_ENV["MYSQLDB_DATABASE"] : $this->database; 
        $password= (isset($_ENV["MYSQLDB_PASSWORD"]))? $_ENV["MYSQLDB_PASSWORD"] :"";
        $strConnection="mysql:host=$host;port=$port;dbname=".$this->database;
        $attr  = [];
        if($this->persistentConnection) $attr[PDO::ATTR_PERSISTENT]= $this->persistentConnection;
        $options = array_merge($attr,$this->options);

        $this->client = new PDO($strConnection,$user,$password,$options);

        return $this->client;
    }

    public function closeConnection(){
        $this->client=null;
    }

    public function getConfiguration(){
        $host = (isset($_ENV["MYSQLDB_HOST"]))? $_ENV["MYSQLDB_HOST"] :"";
        $port =(isset($_ENV["MYSQLDB_PORT"]))? $_ENV["MYSQLDB_PORT"] :"";
        if($this->persistentConnection) $attr[PDO::ATTR_PERSISTENT]= $this->persistentConnection;
        $options = array_merge($attr,$this->options);

            return [
                'host'=> $host,
                'port'=> $port,
                'database'=> $this->database,
                'options' => $options
            ];
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
     * Set the value of persistentConnection
     *
     * @return  self
     */ 
    public function setPersistentConnection(bool $persistentConnection)
    {
        $this->persistentConnection = $persistentConnection;

        return $this;
    }
}