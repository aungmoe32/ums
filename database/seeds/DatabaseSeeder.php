<?php

class DatabaseSeeder
{
    private $pdo;
    private $seeds = [
        'features' => [
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'products'],
            ['id' => 3, 'name' => 'orders'],
        ],

        'permissions' => [
            // User permissions
            ['id' => 1, 'name' => 'view', 'feature_id' => 1],
            ['id' => 2, 'name' => 'create', 'feature_id' => 1],
            ['id' => 3, 'name' => 'edit', 'feature_id' => 1],
            ['id' => 4, 'name' => 'delete', 'feature_id' => 1],

            // Product permissions
            ['id' => 6, 'name' => 'view', 'feature_id' => 2],
            ['id' => 7, 'name' => 'create', 'feature_id' => 2],
            ['id' => 8, 'name' => 'edit', 'feature_id' => 2],
            ['id' => 9, 'name' => 'delete', 'feature_id' => 2],

            // Order permissions
            ['id' => 11, 'name' => 'view', 'feature_id' => 3],
            ['id' => 12, 'name' => 'create', 'feature_id' => 3],
            ['id' => 13, 'name' => 'edit', 'feature_id' => 3],
            ['id' => 14, 'name' => 'delete', 'feature_id' => 3],
        ],

        'roles' => [
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'user'],
        ],

        'role_permissions' => [
            // Admin has view/create/edit permissions
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 9],
            ['role_id' => 1, 'permission_id' => 10],
            ['role_id' => 1, 'permission_id' => 11],

            // Regular user has only view permissions
            ['role_id' => 2, 'permission_id' => 1],
            ['role_id' => 2, 'permission_id' => 5],
            ['role_id' => 2, 'permission_id' => 9],
        ],

        'users' => [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => 'password',
                'role_id' => 1
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => 'password',
                'role_id' => 2
            ],
        ],
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function run()
    {
        // Clear existing data
        $this->truncateTables();

        // Seed tables in order (to maintain foreign key constraints)
        $this->seedFeatures();
        $this->seedPermissions();
        $this->seedRoles();
        $this->seedRolePermissions();
        $this->seedUsers();

        echo "Database seeded successfully!\n";
    }

    private function truncateTables()
    {
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        $tables = ['users', 'roles', 'role_permissions', 'permissions', 'features'];
        foreach ($tables as $table) {
            $this->pdo->exec("TRUNCATE TABLE {$table}");
        }
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function seedFeatures()
    {
        $stmt = $this->pdo->prepare("INSERT INTO features (id, name) VALUES (:id, :name)");
        foreach ($this->seeds['features'] as $feature) {
            $stmt->execute($feature);
        }
    }

    private function seedPermissions()
    {
        $stmt = $this->pdo->prepare("INSERT INTO permissions (id, name, feature_id) VALUES (:id, :name, :feature_id)");
        foreach ($this->seeds['permissions'] as $permission) {
            $stmt->execute($permission);
        }
    }

    private function seedRoles()
    {
        $stmt = $this->pdo->prepare("INSERT INTO roles (id, name) VALUES (:id, :name)");
        foreach ($this->seeds['roles'] as $role) {
            $stmt->execute($role);
        }
    }

    private function seedRolePermissions()
    {
        $stmt = $this->pdo->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
        foreach ($this->seeds['role_permissions'] as $rolePermission) {
            $stmt->execute($rolePermission);
        }
    }

    private function seedUsers()
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
        foreach ($this->seeds['users'] as $user) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $stmt->execute($user);
        }
    }
}
