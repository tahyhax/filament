# Makefile for Fillament Project

.PHONY: help setup install build start stop restart test lint dev init-shield

# Colors for terminal output
COLOR_RESET = \033[0m
COLOR_BOLD = \033[1m
COLOR_GREEN = \033[32m
COLOR_YELLOW = \033[33m

# Help command
help: ## Show this help message
	@printf "Usage:\n"
	@printf "  make \033[33m<target>\033[0m\n\n"
	@printf "Available targets:\n"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[33m%-15s\033[0m %s\n", $$1, $$2}'

# Initial setup
setup: ## Initial project setup
	cp .env.example .env
	docker-compose up -d --build
	make install
	make init-shield
	make build

# Installation commands
install: ## Install all dependencies
	docker-compose exec app composer install
	docker-compose exec app npm install
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate
	docker-compose exec app php artisan db:seed

# Build commands
build: ## Build frontend assets
	docker-compose exec app npm run build

# Docker commands
start: ## Start Docker containers
	docker-compose up -d

stop: ## Stop Docker containers
	docker-compose down

restart: ## Restart Docker containers
	docker-compose down
	docker-compose up -d

# Shield initialization
init-shield: ## Initialize FilamentShield
	docker-compose exec app php artisan shield:install
	docker-compose exec app php artisan shield:super-admin
	docker-compose exec app php artisan shield:generate --all

# Development commands
dev: ## Start development environment
	docker-compose exec app php artisan queue:work & \
	docker-compose exec app npm run dev

# Testing commands
test: ## Run tests
	docker-compose exec app composer test

# Linting and formatting
lint: ## Run linting and code formatting
	docker-compose exec app composer cs-fix
	docker-compose exec app composer refactor

# Shield management
shield-role: ## Create new Shield role (usage: make shield-role ROLE=roleName)
	docker-compose exec app php artisan shield:role $(ROLE)

shield-generate: ## Generate Shield permissions
	docker-compose exec app php artisan shield:generate --all

# Queue management
queue-work: ## Start queue worker
	docker-compose exec app php artisan queue:work

# Database commands
migrate: ## Run database migrations
	docker-compose exec app php artisan migrate

seed: ## Run database seeders
	docker-compose exec app php artisan db:seed

migrate-fresh: ## Reset and re-run all migrations
	docker-compose exec app php artisan migrate:fresh --seed

# Logs
logs: ## View application logs
	docker-compose logs -f app

# Default target
.DEFAULT_GOAL := help 