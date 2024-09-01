
# PHP REST API

This API provides a simple RESTful interface for interacting with a database of users. It now includes several features to enhance security, performance, and access control.

## Features

- **Authentication**: JWT-based authentication to ensure secure API access.
- **Authorization**: Role-based access control to restrict certain actions to specific user roles.
- **CSRF Protection**: Security measures to prevent Cross-Site Request Forgery attacks.
- **Caching**: Basic file-based caching to improve performance by reducing redundant database queries.

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure your environment variables:
   - Set your database connection details in `config.php`.
   - Set your JWT secret key in `Auth.php`.

4. Set up the database:
   - Import the SQL file `serie_login.sql` to create the necessary tables.
   - Ensure that your database user has appropriate permissions.

## Usage

### Authentication

To authenticate a user, send a POST request with the user's credentials. If valid, a JWT token will be returned.

Example:
```php
$token = Auth::SignIn(['id' => $user->id, 'role' => $user->role]);
```

### Authorization

Use the `Auth::Check($token)` method to verify the user's token and authorize actions based on their role.

Example:
```php
Auth::Check($_SESSION['token']);
```

### CSRF Protection

Ensure that each form submission includes the CSRF token:
```html
<input type="hidden" name="_csrf_token" value="<?= $_SESSION['_csrf_token']; ?>">
```

### Caching

You can cache results to improve performance:
```php
$cache = new Cache();
$cachedData = $cache->get('some_key');

if (!$cachedData) {
    $cachedData = $expensiveQueryResult;
    $cache->set('some_key', $cachedData);
}
```

## License

This project is licensed under the MIT License. See the LICENSE file for details.
