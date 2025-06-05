# Configuration
PHP_CONTAINER=survey-php
NGINX_CONTAINER=survey-nginx
DB_CONTAINER=survey-db
COMPOSE=docker compose

# 🚀 Containers
up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

restart:
	$(MAKE) down
	$(MAKE) up

build:
	$(COMPOSE) build

# 🐘 Symfony / PHP
php:
	$(COMPOSE) exec $(PHP_CONTAINER) sh

# 📦 Composer
composer-install:
	$(COMPOSE) exec $(PHP_CONTAINER) composer install

# 🧱 Doctrine Migrations
migrate:
	$(COMPOSE) exec $(PHP_CONTAINER) php bin/console doctrine:migrations:migrate --no-interaction


composer-update:
	$(COMPOSE) exec $(PHP_CONTAINER) composer update

# 🧪 Setup all
install:
	$(MAKE) composer-install
	$(MAKE) migrate
