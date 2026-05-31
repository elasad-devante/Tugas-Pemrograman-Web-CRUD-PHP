# Simple PHP CRUD App

This repository is a simple PHP CRUD application using MySQLi and session-based login.

## Overview

The app allows users to register, log in, and manage operator data. There are two roles:

- `Admin` — can view the admin dashboard, edit operators, and delete operators.
- `User` — can log in and access the regular dashboard.

## Technologies

- PHP
- MySQL / MariaDB
- `mysqli` extension
- HTML/CSS

## Database Structure

The app uses one main database table:

### `operators`

- `id` — primary identifier for each operator
- `name` — username
- `password` — SHA-256 hashed password
- `role` — role name, typically `Admin` or `User`

The database name in `service/database.php` is `ri_operator`.

## MySQLi Style

This project uses the `mysqli` extension with a mixed procedural and object-oriented style:

- Connection: `mysqli_connect($hostname, $username, $password, $database_name)`
- Query execution:
  - Object-oriented: `$db->query($sql)`
  - Procedural: `mysqli_query($db, $sql)`

Passwords are hashed before insertion and comparison using:

```php
$hash_password = hash('sha256', $password);
```

## Project Workflow

### 1. Registration

- `register.php` accepts `username`, `password`, and `role`.
- Passwords are hashed and inserted into the `operators` table.

### 2. Login

- `login.php` checks the submitted username and password against `operators`.
- On success, session variables are set:
  - `$_SESSION["name"]`
  - `$_SESSION["role"]`
  - `$_SESSION["is_login"]`
- Users redirect to `dashboard.php`, admins redirect to `admin/dashboard.php`.

### 3. Read

- `dashboard.php` lists operator data for regular users.
- `admin/dashboard.php` lists all operators with edit and delete actions.

### 4. Update

- `admin/edit.php` displays the edit form for a selected operator.
- `admin/update.php` updates the operator record in the database.

### 5. Delete

- `admin/delete.php` removes an operator by `id`.
- Only admin sessions are allowed to perform delete actions.

## How to Run

1. Place the project in your web server root, e.g. `htdocs/el.com`.
2. Create a MySQL database named `ri_operator`.
3. Create the `operators` table with fields `id`, `name`, `password`, and `role`.
4. Adjust `service/database.php` if your database credentials differ.
5. Open the app in a browser:
   - `http://localhost/el.com`

## Notes

- This app is a simple demo and can be improved with prepared statements to prevent SQL injection.
- The current login and registration flows use SHA-256 hashing, but a stronger password hashing mechanism like `password_hash()` is recommended for production.
