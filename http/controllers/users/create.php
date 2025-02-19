<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$roles = $db->query('SELECT * FROM roles')->get();

view("users/create.view.php", [
    'heading' => 'Create User',
    'errors' => \Core\Session::get('errors'),
    'roles' => $roles
]);
