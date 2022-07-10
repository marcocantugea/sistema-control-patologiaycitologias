<?php

namespace app\Interfaces;

interface IDBConnection{

    function openConnection();
    function closeConnection();
    function getConfiguration();

}