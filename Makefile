default: install test
.PHONY: all

install:
	docker-compose up -d
	docker-compose run --rm composer install
	cp -a .env.example .env
	docker-compose run --rm php-fpm ./artisan key:generate
	docker-compose run --rm php-fpm ./artisan migrate
	docker-compose run --rm php-fpm ./artisan db:seed
.PHONY: install
	
test:
	docker-compose run --rm php-fpm ./vendor/bin/phpunit
.PHONY: test

phpcs:
	docker-compose run --rm php-fpm ./vendor/bin/phpcs --standard=/var/www/html/ruleset.xml
.PHONY: phpcs

phpcbf:
	docker-compose run --rm php-fpm ./vendor/bin/phpcbf --standard=/var/www/html/ruleset.xml
.PHONY: phpcbf

clean:
	docker-compose down
.PHONY: clean
