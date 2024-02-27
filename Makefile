include .env
export

setup:
	@make build
	@make up
	@make composer-update
	docker exec $(APP_NAME)-app /bin/sh -c "php artisan key:generate"

build:
	docker-compose build --no-cache --force-rm

stop:
	docker-compose stop

up:
	docker-compose up -d

composer-update:
	docker exec $(APP_NAME)-app /bin/sh -c "composer update"

data:
	docker exec $(APP_NAME)-app /bin/sh -c "php artisan migrate --seed"

data-fresh:
	docker exec $(APP_NAME)-app /bin/sh -c "php artisan migrate:fresh --seed"

console:
	docker exec -it --user laravel:laravel $(APP_NAME)-app /bin/sh
