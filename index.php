<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$base = parse_url($path, PHP_URL_PATH);
$query = parse_url($path, PHP_URL_QUERY);

//CarController
Routing::get('car', 'CarController');
Routing::get('addCar', 'CarController');
Routing::post('addCarForm', 'CarController');

//DefaultController
Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('statute', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('privacyPolicy', 'DefaultController');

//SecurityController
Routing::post('checkLogin', 'SecurityController');
Routing::post('checkRegister', 'SecurityController');

//SessionController
Routing::post('logout', 'SessionController');

Routing::run($base, $query);