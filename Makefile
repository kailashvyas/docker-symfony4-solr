setup:
	docker-compose build
	docker-compose run symfony_php composer install
	docker-compose run symfony_php yarn encore dev
	docker-compose up -d

composer:
	docker-compose run symfony_php composer install

assets:
	docker-compose run symfony_php yarn encore dev

assets-prod:
	docker-compose run symfony_php yarn encore prod

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

tests:
	docker-compose run symfony_php bin/phpunit