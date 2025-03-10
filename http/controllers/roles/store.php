<?php

use Core\App;
use Core\Validator;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();

if (!in_array('create', $permissions['role'])) {
    redirect('/roles');
}

// Add validation
$errors = [];

if (! Validator::string($_POST['role'], 1, 255)) {
    $errors['role'] = 'A role name of less than 255 characters is required';
}

// Check if role already exists
$existingRole = $db->query('SELECT * FROM roles WHERE name = :name', [
    'name' => $_POST['role']
])->find();

if ($existingRole) {
    $errors['role'] = 'Role name already exists';
}

// If validation fails, redirect back with errors
if (count($errors) > 0) {
    \Core\Session::flash('errors', $errors);
    \Core\Session::flash('old', [
        'role' => $_POST['role']
    ]);

    return redirect('/roles/create');
}

try {
    $db->beginTransaction();

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

    $db->commit();
} catch (\PDOException $e) {
    $db->rollBack();

    // Flash error message and redirect
    \Core\Session::flash('errors', ['database' => 'An error occurred while creating the role']);
    return redirect('/roles/create');
}

// Redirect to a success page or login page
\Core\Session::flash('success', 'Role created successfully!');

if (isset($_POST['action']) && $_POST['action'] === 'create_another') {
    // Redirect back to the create form
    redirect('/roles/create');
} else {
    // Default behavior - redirect to users list
    redirect('/roles');
}
