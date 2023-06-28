<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

//DefaultController
Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');

//SecurityController
Routing::post('checkLogin', 'SecurityController');
Routing::post('checkRegister', 'SecurityController');

//SessionController
Routing::post('logout', 'SessionController');

Routing::run($path);