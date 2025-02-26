<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);

$roles = $db->query('SELECT * FROM roles')->get();
$permissions = App::resolve(Authenticator::class)->permissions();
$canCreate = in_array('create', $permissions['user']);
$canEdit = in_array('edit', $permissions['user']);

view("users/create.view.php", [
    'heading' => 'Create User',
    'errors' => \Core\Session::get('errors'),
    'roles' => $roles,
    'permissions' => $permissions,
    'canCreate' => $canCreate,
    'canEdit' => $canEdit
]);
