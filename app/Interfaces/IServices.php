<?php

namespace app\Interfaces;

use app\Interfaces\IRepository;

interface IServices{

    function getRepository() : IRepository;
    function __construct();

}