<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

# SOIS Supply API

A Laravel-based API for supply management developed as part of the Student Organization Information System (SOIS) project.

## Overview

This API serves as the backend service for managing supplies and inventory within the SOIS ecosystem, allowing for efficient tracking and management of organizational resources.

## Technology Stack

- **Framework:** Laravel
- **Frontend:** Tailwind CSS
- **Build Tool:** Vite
- **Package Manager:** Composer & NPM

## Installation

### Prerequisites

- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Setup Instructions

1. Clone the repository
   ```bash
   git clone <repository-url>
   cd supply-api
   ```
2. Install PHP dependencies
   ```bash  
   composer install
   ```
3. Install JavaScript dependencies
   ```bash
   npm install
   ```
4. Create environment file
   ```bash
   cp .env.example .env
   ```
5. Generate application key
   ```bash
   php artisan key:generate
   ```
6. Configure your database in the .env file
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
7. Run migrations
   ```bash
   php artisan migrate
   ```
8. Start development server
   ```bash
   php artisan serve
   ```

Development 
Building Assets
This project uses Vite for asset compilation:

```bash
# Run development server with hot reloading
npm run dev

# Build for production
npm run build
```

Database Migrations
Run migrations to set up your database schema:

```bash
php artisan migrate
```

To rollback migrations:

```bash
php artisan migrate:rollback
```

Queue Processing
This API uses Laravel's queue system for background processing. The jobs table is already set up in the migrations.

To start a queue worker:

```bash
php artisan queue:work
```
API Documentation
[Documentation will be available here]

Project Structure
The project follows the standard Laravel structure:

app - Contains the core code of the application
bootstrap - Contains files that bootstrap the framework
config - Contains configuration files
database - Contains database migrations and seeders
public - The document root for the application
resources - Contains views and uncompiled assets
routes - Contains route definitions
storage - Contains compiled Blade templates, sessions, and file uploads
tests - Contains automated tests

Testing
Run the test suite with:

```bash
php artisan test
```

Contributing
Guidelines for contributing to this project:

Fork the repository
Create a feature branch
Submit a pull request
License
This project is open-sourced software licensed under the MIT license.