default: install test
.PHONY: all

install:
	cp -a .env.example .env
	docker-compose up -d
	docker-compose run composer install
	docker-compose run php-fpm ./artisan migrate
	docker-compose run php-fpm ./artisan db:seed
.PHONY: install
	
test:
	docker-compose run php-fpm ./vendor/bin/phpunit
.PHONY: test

phpcs:
	docker-compose run php-fpm ./vendor/bin/phpcs --standard=/var/www/html/ruleset.xml
.PHONY: phpcs

phpcbf:
	docker-compose run php-fpm ./vendor/bin/phpcbf --standard=/var/www/html/ruleset.xml
.PHONY: phpcbf

clean:
	docker-compose down
.PHONY: clean

phpstan:
	docker-compose run phpstan analyze --level 7 core
.PHONY: phpstan
