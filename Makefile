include ./h11.conf.mk

build:
	docker-compose build --no-cache

init:
	composer install
	mkdir -p ./.docker/vscode/data/User/
	mkdir -p ./.docker/vscode/extensions/
	mkdir -p ./.docker/vscode/custom-cont-init.d/
	mkdir -p ./.docker/vscode/.config/code-server/
	cp -r ./vendor/h11/vscode-server-config/src/extensions/* ./.docker/vscode/extensions
	cp ./vendor/h11/vscode-server-config/src/settings.json ./.docker/vscode/data/User/settings.json

up:
	docker-compose up -d

down:
	docker-compose down

destroy:
	docker-compose down && sudo rm -rf ./.docker && sudo rm -rf ./vendor && sudo rm -rf composer.lock

bash-www:
	docker-compose exec www bash

bash-sql:
	docker-compose exec sql bash

bash-sqladmin:
	docker-compose exec sqladmin bash

bash-mq:
	docker-compose exec mq bash

bash-vscode:
	docker-compose exec vscode bash

build-production:
	docker-compose -f docker-compose-production.yml build --no-cache

init-production:
	composer install --no-dev

up-production:
	docker-compose -f docker-compose-production.yml up -d

down-production:
	docker-compose -f docker-compose-production.yml down

destroy-production:
	docker-compose -f docker-compose-production.yml down && sudo rm -rf ./.docker && sudo rm -rf ./vendor && sudo rm -rf composer.lock

bash-www-production:
	docker-compose -f docker-compose-production.yml exec www-production bash

bash-sql-production:
	docker-compose -f docker-compose-production.yml exec sql-production bash

bash-sqladmin-production:
	docker-compose -f docker-compose-production.yml exec sqladmin-production bash

bash-vscode-production:
	docker-compose -f docker-compose-production.yml exec vscode-production bash

.PHONY: build init up down destroy bash-www bash-sql bash-sqladmin bash-vscode
