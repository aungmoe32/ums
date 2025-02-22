<?php

use Core\App;
use Core\Authenticator;

$features = App::resolve(Authenticator::class)->getFeatures();
$userPermissions = App::resolve(Authenticator::class)->permissions();
$canCreate = in_array('create', $userPermissions['role']);

view("roles/create.view.php", [
    'heading' => 'Create Role',
    'features' => $features,
    'errors' => \Core\Session::get('errors'),
    'userPermissions' => $userPermissions,
    'canCreate' => $canCreate
]);
