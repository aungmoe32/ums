<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$roles = $db->query('select * from roles')->get();
// dd($roles);
view("roles/index.view.php", [
    'heading' => 'Roles',
    'roles' => $roles
]);
