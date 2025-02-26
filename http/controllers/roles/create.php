<?php

use Core\App;
use Core\Authenticator;

$features = App::resolve(Authenticator::class)->getFeatures();
$permissions = App::resolve(Authenticator::class)->permissions();

$canCreate = in_array('create', $permissions['role']);
$canEdit = in_array('edit', $permissions['role']);

// dd($userPermissions);
view("roles/create.view.php", [
    'heading' => 'Create Role',
    'features' => $features,
    'errors' => \Core\Session::get('errors'),
    'permissions' => $permissions,
    'canCreate' => $canCreate
]);
