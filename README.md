# User Management System (UMS)

A PHP-based user management system with role-based access control, built using modern practices and a custom MVC framework.

## Features

- User Authentication
- Role-Based Access Control (RBAC)
- User Management (CRUD operations)
- Role Management with Granular Permissions
- CSRF Protection
- Session Management
- Responsive UI with Tailwind CSS
- Mobile-friendly Sidebar Navigation

## Tech Stack

- PHP 8.x
- PostgreSQL
- Tailwind CSS
- Alpine.js
- Composer for Dependency Management
- Penguins UI

## Project Structure

```
ums/
├── core/                   # Core framework components
│   ├── App.php            # Application container
│   ├── Authenticator.php  # Authentication logic
│   ├── Container.php      # Dependency injection container
│   ├── Database.php       # Database wrapper
│   ├── Middleware/        # Request middleware
│   └── ...
├── http/                  # HTTP layer
│   ├── controllers/       # Request handlers
│   └── Forms/            # Form validation
├── views/                 # View templates
│   ├── partials/         # Reusable view components
│   ├── roles/            # Role management views
│   └── users/            # User management views
├── public/               # Public assets
├── bootstrap.php         # Application bootstrap
├── routes.php           # Route definitions
└── composer.json        # Project dependencies
```

## Requirements

- PHP 8.0 or higher
- MySQL
- Composer
- Web server (Apache/Nginx)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/ums.git
cd ums
```

2. Install dependencies:

```bash
composer install
```

3. Configure your database in `config.php`:

```php
return [
    'database' => [
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'ums',
        'charset' => 'utf8mb4'
    ]
];
```

4. Run the seeder to populate the database:

```bash
php database/seed.php
```

5. Run the development server:

```bash
php -S localhost:8000 -t public
```

## Features in Detail

### Authentication

- Secure login system
- Session management
- Password hashing
- CSRF protection

### Role Management

- Create and manage roles
- Assign granular permissions
- Feature-based access control
- Role assignment to users

### User Management

- Create new users
- Edit user details
- Assign roles to users
- View user listings

## Security Features

- CSRF Protection
- Password Hashing
- Session Security
- Input Validation
- SQL Injection Prevention
- XSS Protection

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Built with modern PHP practices
- Uses Tailwind CSS for styling
- Alpine.js for interactive UI components
