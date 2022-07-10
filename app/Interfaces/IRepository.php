<?php

namespace app\Interfaces;

use app\Interfaces\IModel;

interface IRepository{

    function add(IModel $model);
    function update($id,IModel $model);
    function getById($id);
    function getAll();
    function delete($id);
    function setConnection(IDBConnection $connection);
    function loadConnectionSettings();
}