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

rebuild: ## Full rebuild of Docker containers (stops, removes containers and images, then builds again)
	@echo "$(COLOR_YELLOW)Stopping all containers...$(COLOR_RESET)"
	docker-compose down
	@echo "$(COLOR_YELLOW)Removing all containers and images related to this project...$(COLOR_RESET)"
	docker-compose down --rmi all --volumes --remove-orphans
	@echo "$(COLOR_GREEN)Remove db folders ...$(COLOR_RESET)"
	rm -rf ./conf/postgres/data
	rm -rf ./conf/redis/data
	@echo "$(COLOR_GREEN)Remove app folders...$(COLOR_RESET)"
	rm -rf ../vendor
	rm -rf ../coverage
	rm -rf ../node_modules
	@echo "$(COLOR_GREEN)Building and starting containers from scratch...$(COLOR_RESET)"
	make build-construct
	@echo "$(COLOR_GREEN)Rebuild completed successfully!$(COLOR_RESET)"

build-setup: ## Build setup
	@if [ ! -f .env ]; then \
		echo "$(COLOR_GREEN)Creating .env file from .env.example...$(COLOR_RESET)"; \
		cp .env.example .env; \
	else \
		echo "$(COLOR_YELLOW).env file already exists, skipping...$(COLOR_RESET)"; \
	fi

build-construct: ## Initial project setup and build
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate
	docker-compose exec app php artisan shield:install

# Docker commands
start: ## Start Docker containers
	docker-compose up -d

stop: ## Stop Docker containers
	docker-compose down

restart: ## Restart Docker containers
	docker-compose down
	docker-compose up -d

# Shield initialization
init-shield-user: ## Initialize FilamentShield
	docker-compose exec app php artisan shield:super-admin

# Linting and formatting
lint: ## Run linting and code formatting
	docker-compose exec app composer cs-fix
	docker-compose exec app composer refactor

seed: ## Run database seeders
	docker-compose exec app php artisan db:seed

# Logs
app-logs: ## View application logs
	docker-compose logs -f app

# Default target
.DEFAULT_GOAL := help
