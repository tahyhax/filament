# Fillament - Laravel Filament Admin Panel

Administrative panel based on Laravel Filament with course, credit, and specialty management.

## Requirements

- PHP 8.2 or higher
- Composer
- Docker and Docker Compose
- Node.js and NPM

## Technologies

- Laravel 12.x
- Filament 3.x
- PostgreSQL 15
- Redis
- Nginx
- PHP-FPM 8.3
- Supervisor for queues

## Installation and Setup

### 1. Clone Repository

```bash
git clone <repository-url>
cd fillament
```

### 2. Environment Setup

1. Copy environment file:
```bash
cp .env.example .env
```

2. Configure environment variables in `.env`:

### 3. Docker Setup

1. Build and start containers:
```bash
docker-compose up -d --build
```

2. Install dependencies:
```bash
docker-compose exec app composer install
docker-compose exec app npm install
```

3. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

4. Run migrations and seeders:
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Run seeders
docker-compose exec app php artisan db:seed
```

5. Initialize FilamentShield:
```bash
# Create roles and permissions
docker-compose exec app php artisan shield:install

# Create super-admin
docker-compose exec app php artisan shield:super-admin

# Generate policies and permissions for resources
docker-compose exec app php artisan shield:generate --all
```

6. Compile frontend assets:
```bash
docker-compose exec app npm run build
```

### 4. Application Access

- Admin Panel: http://localhost:8080/admin
- API: http://localhost:8080/api

## Core Features

- User and Role Management (FilamentShield)
- Course Management
- Credit Management
- Specialty Management
- Notification System
- Data Export

## Development

### Development Mode

```bash
# Start queue worker
docker-compose exec app php artisan queue:work

# Start development server
docker-compose exec app npm run dev
```

### Access Management

FilamentShield provides a role and permission management system:

1. Create new role:
```bash
docker-compose exec app php artisan shield:role roleName
```

2. Update permissions when adding new resources:
```bash
docker-compose exec app php artisan shield:generate --all
```

3. Manage permissions via interface:
- Navigate to "Shield" section in admin panel
- Configure roles and permissions for each resource
- Assign roles to users in "Users" section

### Debugging

The project is configured with Xdebug for PHP. Configuration can be found in `.docker/php/xdebug.ini`.

### Code Linting and Formatting

```bash
# PHP CS Fixer
docker-compose exec app composer cs-fix

# Rector (refactoring)
docker-compose exec app composer refactor
```

## Testing

```bash
docker-compose exec app composer test
```

## Queues and Tasks

The project uses Supervisor to manage Laravel queues. Configuration is located in `.docker/supervisor/queue.conf`.

## Security

- All API requests require authentication
- Role and permission system implemented through FilamentShield
- CSRF protection enabled
- Resource and action level access control
