<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);
// $errors = [];

// if (! Validator::string($_POST['body'], 1, 1000)) {
//     $errors['body'] = 'A body of no more than 1,000 characters is required.';
// }

// if (! empty($errors)) {
//     return view("notes/create.view.php", [
//         'heading' => 'Create Note',
//         'errors' => $errors
//     ]);
// }

$db->query("INSERT INTO roles(name) VALUES(:name)", [
    'name' => $_POST['role']
]);

$role_id = $db->lastInsertId();

foreach ($_POST['permissions'] as $permission) {
    $db->query("INSERT INTO role_permissions(role_id, permission_id) VALUES(:role_id, :permission_id)", [
        'role_id' => $role_id,
        'permission_id' => $permission
    ]);
}

header('location: /roles/create');
die();
