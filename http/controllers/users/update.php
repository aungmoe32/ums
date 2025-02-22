<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();

if (!in_array('edit', $permissions['user'])) {
    redirect('/users');
}

$user = $db->query('select * from users where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Check if password is provided and update accordingly
if (!empty($_POST['password'])) {
    $db->query('update users set name = :name, email = :email, role_id = :role_id, password = :password where id = :id', [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'role_id' => $_POST['role'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'id' => $_POST['id']
    ]);
} else {
    $db->query('update users set name = :name, email = :email, role_id = :role_id where id = :id', [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'role_id' => $_POST['role'],
        'id' => $_POST['id']
    ]);
}

Session::flash('success', 'User updated successfully');

redirect(previousUrl());
