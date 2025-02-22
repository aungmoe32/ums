<?php

namespace Core\Middleware;

use Core\Authenticator;

class PermissionMiddleware
{
    protected $requiredPermissions;

    public function __construct($requiredPermissions)
    {
        $this->requiredPermissions = $requiredPermissions;
    }

    public function handle()
    {
        $authenticator = new Authenticator();
        $userPermissions = $authenticator->permissions();

        foreach ($this->requiredPermissions as $feature => $permissions) {
            if (!isset($userPermissions[$feature])) {
                $this->denyAccess();
            }

            foreach ($permissions as $permission) {
                if (!in_array($permission, $userPermissions[$feature])) {
                    $this->denyAccess();
                }
            }
        }
    }

    protected function denyAccess()
    {
        header('location: /no-access');
        exit();
    }
}
