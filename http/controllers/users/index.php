<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$users = $db->query('
    select users.id, users.name, users.email, users.role_id, roles.name as role 
    from users 
    join roles on users.role_id = roles.id
')->get();

$permissions = App::resolve(Authenticator::class)->permissions();

view("users/index.view.php", [
    'heading' => 'Users',
    'users' => $users,
    'permissions' => $permissions
]);
