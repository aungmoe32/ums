<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$user = $db->query('select * from users where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$roles = $db->query('select * from roles')->get();

view('users/edit.view.php', [
    'user' => $user,
    'roles' => $roles,
    'heading' => 'Edit User'
]);
