<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$roleId = $_GET['id'] ?? null;

if (!$roleId) {
    abort(400, 'Role ID is required.');
}

$db = App::resolve(Database::class);

$roleData = $db->query('
    SELECT roles.id as role_id, roles.name as role_name, permissions.name as permission_name, features.name as feature_name
    FROM roles 
    LEFT JOIN role_permissions ON roles.id = role_permissions.role_id 
    LEFT JOIN permissions ON role_permissions.permission_id = permissions.id
    LEFT JOIN features ON permissions.feature_id = features.id
    WHERE roles.id = :role_id
', ['role_id' => $roleId])->get();

if (empty($roleData)) {
    abort(404);
}

$role = [
    'role_id' => $roleData[0]['role_id'],
    'role_name' => $roleData[0]['role_name'],
    'features' => []
];

foreach ($roleData as $item) {
    $featureName = $item['feature_name'];
    $permissionName = $item['permission_name'];

    if ($featureName) {
        if (!isset($role['features'][$featureName])) {
            $role['features'][$featureName] = [];
        }

        if ($permissionName && !in_array($permissionName, $role['features'][$featureName])) {
            $role['features'][$featureName][] = $permissionName;
        }
    }
}
$permissions = App::resolve(Authenticator::class)->permissions();

view("roles/show.view.php", [
    'heading' => 'Role Details',
    'role' => $role,
    'permissions' => $permissions
]);
