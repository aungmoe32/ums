<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$roles = $db->query('
    select roles.id as role_id, roles.name as role_name, permissions.name as permission_name, features.name as feature_name
    from roles 
    left join role_permissions on roles.id = role_permissions.role_id 
    left join permissions on role_permissions.permission_id = permissions.id
    left join features on permissions.feature_id = features.id
')->get();

$formattedRoles = [];

foreach ($roles as $item) {
    $roleId = $item['role_id'];
    $roleName = $item['role_name'];
    $featureName = $item['feature_name'];
    $permissionName = $item['permission_name'];

    if (!isset($formattedRoles[$roleId])) {
        $formattedRoles[$roleId] = [
            'role_name' => $roleName,
            'features' => []
        ];
    }

    if ($featureName) {
        if (!isset($formattedRoles[$roleId]['features'][$featureName])) {
            $formattedRoles[$roleId]['features'][$featureName] = [];
        }

        if ($permissionName && !in_array($permissionName, $formattedRoles[$roleId]['features'][$featureName])) {
            $formattedRoles[$roleId]['features'][$featureName][] = $permissionName;
        }
    }
}

$roles = array_map(function ($roleId, $roleData) {
    return [
        'role_id' => $roleId,
        'role_name' => $roleData['role_name'],
        'features' => array_map(function ($featureName, $permissions) {
            return [$featureName => $permissions];
        }, array_keys($roleData['features']), $roleData['features'])
    ];
}, array_keys($formattedRoles), $formattedRoles);

$permissions = App::resolve(Authenticator::class)->permissions();
$canDelete = in_array('delete', $permissions['role']);
// dd($permissions);
view("roles/index.view.php", [
    'heading' => 'Roles',
    'roles' => $roles,
    'permissions' => $permissions,
    'canDelete' => $canDelete
]);
