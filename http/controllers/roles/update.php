<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();

if (!in_array('edit', $permissions['role'])) {
    redirect('/roles');
}

// Validate incoming data
$roleId = $_POST['id'];
$roleName = $_POST['role'];
$permissions = $_POST['permissions'] ?? [];

// Add validation
$errors = [];

if (! Validator::string($roleName, 1, 255)) {
    $errors['role'] = 'A role name of less than 255 characters is required';
}

// Check if role already exists
$existingRole = $db->query('SELECT * FROM roles WHERE name = :name AND id != :id', [
    'name' => $roleName,
    'id' => $roleId
])->find();

if ($existingRole) {
    $errors['role'] = 'Role name already exists';
}

// If validation fails, redirect back with errors
if (count($errors) > 0) {
    \Core\Session::flash('errors', $errors);
    \Core\Session::flash('old', [
        'role' => $roleName
    ]);

    return redirect('/roles/edit?id=' . $roleId);
}

try {
    $db->beginTransaction();

    $db->query("UPDATE roles SET name = :name WHERE id = :id", [
        'name' => $roleName,
        'id' => $roleId
    ]);

    $db->query("DELETE FROM role_permissions WHERE role_id = :role_id", [
        'role_id' => $roleId
    ]);

    foreach ($permissions as $permission) {
        $db->query("INSERT INTO role_permissions(role_id, permission_id) VALUES(:role_id, :permission_id)", [
            'role_id' => $roleId,
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
\Core\Session::flash('success', 'Role updated successfully!');

redirect('/roles/edit?id=' . $roleId);
