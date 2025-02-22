<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();

if (!in_array('create', $permissions['user'])) {
    redirect('/users');
}

// Validate the form inputs
$errors = [];

if (!Validator::string($_POST['name'], 1, 255)) {
    $errors['name'] = 'A name is required and cannot exceed 255 characters.';
}

if (!Validator::email($_POST['email'])) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($_POST['password'], 8, 255)) {
    $errors['password'] = 'Password must be at least 8 characters.';
}

// Check if email already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $_POST['email']
])->find();

if ($user) {
    $errors['email'] = 'Email already exists.';
}

// If there are validation errors, redirect back with the errors
if (count($errors)) {
    \Core\Session::flash('errors', $errors);
    \Core\Session::flash('old', [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'role' => $_POST['role']
    ]);

    redirect('/users/create');
}

// If validation passes, create the user
$db->query('INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)', [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
    'role_id' => $_POST['role']
]);

// Redirect to a success page or login page
\Core\Session::flash('success', 'User account created successfully!');

if (isset($_POST['action']) && $_POST['action'] === 'create_another') {
    // Redirect back to the create form
    redirect('/users/create');
} else {
    // Default behavior - redirect to users list
    redirect('/users');
}
