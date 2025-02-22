<?php

$router->get('/', 'index.php')->only('auth');

$router->get('/roles/create', 'roles/create.php')->only('auth');
$router->post('/roles', 'roles/store.php', ['csrf', 'auth']);
$router->get('/roles', 'roles/index.php')->only('auth');
$router->get('/roles/show', 'roles/show.php')->only('auth');
$router->post('/roles/delete', 'roles/destroy.php', ['csrf', 'auth']);

$router->get('/users/create', 'users/create.php')->only('auth');
$router->post('/users', 'users/store.php', ['csrf', 'auth']);
$router->get('/users', 'users/index.php')->only('auth');
$router->get('/users/edit', 'users/edit.php')->only('auth');
$router->post('/users/update', 'users/update.php', ['csrf', 'auth']);
$router->post('/users/delete', 'users/destroy.php', ['csrf', 'auth']);

// $router->get('/register', 'registration/create.php')->only('guest');
// $router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php', ['csrf', 'guest']);
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/profile', 'profile/show.php')->only('auth');
