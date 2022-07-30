<?php

use Michel\Projeto\App\Router;

$router = new Router;

$router->get('/', '/Views/homepage.php');
$router->get('/dashboard', '/Views/dashboard.php');

$router->get('/register', '/Views/auth/register.php');
$router->post('/register', '/Views/auth/register.php');

$router->get('/login', '/Views/auth/login.php');
$router->post('/login', '/Views/auth/login.php');

$router->post('/books/add', '/Views/book/add.php');
$router->get('/books/add', '/Views/book/add.php');
$router->get('/books/listbooks', '/Views/book/listbooks.php');
$router->get('/books/bookexists', '/Views/book/bookexists.php');

$router->get('/lending/add', '/Views/lending/add.php');
$router->post('/lending/add', '/Views/lending/add.php');

$router->get('/dashboard', '/Views/dashboard.php', true);

$router->post('/logout', '/Views/auth/auth.php', true);

return $router;