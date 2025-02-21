<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$auth_result = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

if ($auth_result !== true) {
    $message = match ($auth_result) {
        'invalid_credentials' => 'No matching account found for that email address and password.'
    };

    $form->error('email', $message)->throw();
}

redirect('/users');
