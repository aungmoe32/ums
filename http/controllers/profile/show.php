<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();
$user = App::resolve(Authenticator::class)->user();

view("profile/show.view.php", [
    'heading' => 'Profile',
    'user' => $user,
    'permissions' => $permissions
]);
