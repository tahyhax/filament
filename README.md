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

## Quick Start

1. Clone repository:
```bash
git clone <repository-url>
cd fillament
```

2. Run initial setup:
```bash
make setup
```
This command will:
- Copy environment file
- Build and start Docker containers
- Install all dependencies
- Initialize FilamentShield

## Available Commands

### Docker Management
```bash
make start    # Start Docker containers
make stop     # Stop Docker containers
make restart  # Restart Docker containers
make logs     # View application logs
```

### Development
```bash
make dev      # Start development environment (queue worker + vite)
make lint     # Run code linting and formatting
make test     # Run tests
```

### Database Operations
```bash
make seed         # Run seeders
```

### FilamentShield Management
```bash
make init-shield-user  # Initialize FilamentShield user
```

## Application Access

- Admin Panel: http://localhost:8080/admin

## Core Features

- User and Role Management (FilamentShield)
- Course Management
- Credit Management
- Specialty Management
- Notification System
- Data Export

## Security

- Role and permission system implemented through FilamentShield
- CSRF protection enabled
- Resource and action level access control

## Development Guide

### Environment Setup

The project includes a comprehensive Makefile for common tasks. View all available commands:
```bash
make help
```

### Debugging

The project is configured with Xdebug for PHP. Configuration can be found in `.docker/php/xdebug.ini`.

### Queue Processing

The project uses Supervisor to manage Laravel queues. Configuration is located in `.docker/supervisor/queue.conf`.
