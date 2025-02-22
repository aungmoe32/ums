<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select users.*, roles.name as role_name, roles.id as role_id from users left join roles on users.role_id = roles.id where email = :email', [
                'email' => $email
            ])->find();

        if ($user) {
            if (!password_verify($password, $user['password'])) {
                return 'invalid_credentials';
            }

            $this->login($user);

            return true;
        }

        return 'invalid_credentials';
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'user_id' => $user['id']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }

    public function user()
    {
        return $_SESSION['user'];
    }

    // Get permissions for the current user
    public function permissions()
    {
        return $this->getPermissions($this->user()['role_id']);
    }

    // Get permissions for a specific role
    public function getPermissions($role_id)
    {
        $permissions = App::resolve(Database::class)
            ->query('select permissions.name as permission_name, features.name as feature_name from permissions left join role_permissions on permissions.id = role_permissions.permission_id left join features on permissions.feature_id = features.id where role_permissions.role_id = :role_id', [
                'role_id' => $role_id
            ])->get();

        $pers = [];

        foreach ($permissions as $permission) {
            $pers[$permission['feature_name']][] = $permission['permission_name'];
        }

        return $pers;
    }
    // Get all permissions
    public function getAllPermissions()
    {
        $permissions = App::resolve(Database::class)
            ->query('select permissions.name as permission_name, features.name as feature_name from permissions left join features on permissions.feature_id = features.id')->get();
        $pers = [];

        foreach ($permissions as $permission) {
            $pers[$permission['feature_name']][] = $permission['permission_name'];
        }

        return $pers;
    }
    public function getFeatures()
    {
        $datas = App::resolve(Database::class)
            ->query('
    SELECT features.id AS feature_id , features.name AS feature_name, permissions.name AS permission_name, permissions.id AS permission_id
    FROM features
    LEFT JOIN permissions ON features.id = permissions.feature_id
')->get();
        $features = [];

        foreach ($datas as $data) {
            $features[$data['feature_name']][] = $data;
        }

        return $features;
    }
}
