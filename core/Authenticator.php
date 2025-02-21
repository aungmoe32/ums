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

    public function permissions()
    {
        $user = App::resolve(Database::class)
            ->query('select permissions.name as permission_name, features.name as feature_name from permissions left join role_permissions on permissions.id = role_permissions.permission_id left join features on permissions.feature_id = features.id where role_permissions.role_id = :role_id', [
                'role_id' => $this->user()['role_id']
            ])->get();

        $permissions = [];

        foreach ($user as $permission) {
            $permissions[$permission['feature_name']][] = $permission['permission_name'];
        }

        return $permissions;
    }
}
