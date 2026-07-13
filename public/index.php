<?php

session_start();

require_once '../config/config.php';
require_once '../app/core/Autoload.php';

$router = new Router();

$router->run();