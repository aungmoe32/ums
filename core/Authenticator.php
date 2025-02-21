<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select users.*, roles.name as role_name from users left join roles on users.role_id = roles.id where email = :email', [
                'email' => $email
            ])->find();

        if ($user) {
            if (!password_verify($password, $user['password'])) {
                return 'invalid_credentials';
            }

            if ($user['role_name'] !== 'admin') {
                return 'not_admin';
            }

            $this->login([
                'email' => $email
            ]);

            return true;
        }

        return 'invalid_credentials';
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
