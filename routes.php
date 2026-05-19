<?php

/** @var mixed $router */
$router->get('/', 'app/controllers/home.php');
$router->get('/listings', 'app/controllers/listings/index.php');
$router->get('/listings/create', 'app/controllers/listings/create.php');
$router->get('/auth/register', 'app/controllers/auth/register.php');
$router->get('/auth/login', 'app/controllers/auth/login.php');
$router->post('/auth/register', 'app/controllers/auth/register.php');
$router->post('/auth/login', 'app/controllers/auth/login.php');
$router->post('/listings/create', 'app/controllers/listings/create.php');
$router->get('/listings/{id}', 'app/controllers/listings/show.php');
$router->get('/myblog', 'app/controllers/myblog.php');
$router->get('/ternary', 'app/controllers/ternary.php');
