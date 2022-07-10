<?php

namespace app\DataAccess;

use app\Interfaces\IDBConnection;
use Exception;

class DBConnection implements IDBConnection {
    
    function openConnection(){
        throw new Exception("no implemented");
    }

    function closeConnection(){
        throw new Exception("no implemented");
    }

    function getConfiguration(){
        throw new Exception("no implemented");
    }
    
}
