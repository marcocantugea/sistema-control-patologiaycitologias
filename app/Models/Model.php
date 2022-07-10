<?php

namespace app\Models;

use app\Interfaces\IModel;
use MongoDB\BSON\Persistable;
abstract class Model implements IModel,Persistable  {

    public function bsonSerialize()
    {
        return get_object_vars($this);
    }


    public function bsonUnserialize(array $map)
    {
        foreach($map as $k=>$value){
            $this->$k=$value;
        }
    }

}