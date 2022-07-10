<?php

use app\Application;
use controllers\router;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();
//inicia ruteo de controladores
Application::reroute();