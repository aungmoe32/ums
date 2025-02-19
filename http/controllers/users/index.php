<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$users = $db->query('
    select users.id, users.name, users.email, roles.name as role 
    from users 
    join roles on users.role_id = roles.id
')->get();

view("users/index.view.php", [
    'heading' => 'Users',
    'users' => $users
]);
