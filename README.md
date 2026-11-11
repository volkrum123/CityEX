# City Explorer

City Explorer is a lightweight PHP application for browsing a PostgreSQL database of world cities. It demonstrates how an MVC-style framework works by implementing the router, request and response objects, controllers, service and repository layers, dependency injection, and view rendering from scratch.

## Features

- Browse a paginated list of cities
- Search cities by name
- Sort city names in ascending or descending order
- View country, population, coordinates, and other details for a city
- Handle dynamic routes such as `/cities/{id}`
- Display a custom 404 page when a route or city cannot be found

## Technology

- PHP 8+
- PostgreSQL
- PDO
- Composer with PSR-4 autoloading
- Apache with URL rewriting
- HTML and CSS

## Architecture

Every request enters through `public/index.php` and follows this flow:

```text
Browser request
    -> Router
    -> Controller
    -> Service
    -> Repository
    -> PostgreSQL
    -> View and layout
    -> HTTP response
```

The repository contains the SQL, the service applies pagination and sort rules, and the controllers coordinate requests and views. Dependencies are supplied through constructors and a small dependency-injection container.

## Project structure

```text
CityEX/
|-- app/
|   |-- Controllers/
|   |-- Core/
|   |-- Repositories/
|   |-- Services/
|   `-- Views/
|-- config/
|   |-- app.php
|   |-- database.php
|   `-- routes.php
|-- public/
|   |-- css/
|   `-- index.php
`-- composer.json
```

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/volkrum123/CityEX.git
cd CityEX
composer install
```

### 2. Configure PostgreSQL

Create a PostgreSQL database and import a `worldcities` table. The application requires at least these columns:

- `id`
- `city`

The detail page also uses `country`, `population`, `lat`, and `lng` when they are available.

Update the connection settings in `config/database.php`:

```php
return [
    'host' => '127.0.0.1',
    'port' => 5432,
    'dbname' => 'CityExplorer',
    'user' => 'postgres',
    'password' => 'your-password',
    'charset' => 'utf8',
];
```

### 3. Configure the application path

Set `base_path` in `config/app.php` to the URL path from which the application is served.

```php
return [
    'base_path' => '/php/CityEX/public',
];
```

Point Apache at the `public/` directory, ensure URL rewriting is enabled, and restart Apache.

## Routes

- `/` - home page
- `/about` - project information
- `/cities` - searchable, sortable, paginated city list
- `/cities/{id}` - details for one city

## Security

- PDO prepared statements protect parameterized database queries.
- A whitelist controls the SQL sort expression.
- View output is escaped with `htmlspecialchars()`.
- URL query values are encoded before being added to links.
- Strict PHP types are enabled in application classes.

## Skills demonstrated

- Object-oriented PHP
- MVC and layered application architecture
- Routing and HTTP request handling
- PostgreSQL and PDO
- Secure server-rendered web development
