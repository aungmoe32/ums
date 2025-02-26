<?php

use Core\App;
use Core\Authenticator;
use Core\Database;

$db = App::resolve(Database::class);



$roleId = $_GET['id'];
$role = $db->query('select * from roles where id = :id', [
    'id' => $roleId
])->findOrFail();

$features = App::resolve(Authenticator::class)->getFeatures();
$permissions = App::resolve(Authenticator::class)->getAllPermissions();
$rolePermissions = App::resolve(Authenticator::class)->getPermissions($roleId);
$canEdit = in_array('edit', $permissions['role']);

view('roles/edit.view.php', [
    'heading' => 'Edit Role',
    'role' => $role,
    'features' => $features,
    'permissions' => $permissions,
    'canEdit' => $canEdit,
    'errors' => \Core\Session::get('errors'),
    'rolePermissions' => $rolePermissions
]);
