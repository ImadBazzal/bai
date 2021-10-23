.DEFAULT_GOAL := up

up:
	docker-compose up -d;

down:
	docker-compose down;

build:
	docker-compose build;

test:
	docker-compose exec php-fpm ./bin/phpunit

ssh:
	docker-compose exec php-fpm bash;

update-schema:
	docker-compose exec php-fpm bash -c "\
	./bin/console doctrine:database:create --if-not-exists && \
	./bin/console doctrine:migrations:migrate && \
	./bin/console doctrine:database:create --if-not-exists --env=test && \
	./bin/console doctrine:migrations:migrate --env=test";

load-fixtures:
	docker-compose exec php-fpm ./bin/console hautelook:fixtures:load;

build-frontend:
	cd frontend && yarn serve;