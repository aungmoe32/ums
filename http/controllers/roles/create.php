<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$roles = $db->query('
    SELECT features.id AS feature_id , features.name AS feature_name, permissions.name AS permission_name, permissions.id AS permission_id
    FROM features
    LEFT JOIN permissions ON features.id = permissions.feature_id
')->get();
$features = [];

foreach ($roles as $role) {
    $features[$role['feature_name']][] = $role;
}

// dd($features);

$permissions = App::resolve(Authenticator::class)->permissions();

view("roles/create.view.php", [
    'heading' => 'Create Role',
    'features' => $features,
    'errors' => \Core\Session::get('errors'),
    'permissions' => $permissions
]);
