include ./h11.conf.mk

build:
	docker-compose build

init:
	composer install
	mkdir -p ./.docker/vscode/data/User/
	mkdir -p ./.docker/vscode/extensions/
	mkdir -p ./.docker/vscode/custom-cont-init.d/
	mkdir -p ./.docker/vscode/.config/code-server/
	cp ./docker/dockerfiles/vscode ./.docker/vscode/custom-cont-init.d/vscode.sh
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

mysql:
	docker-compose exec h11.sql mysql -u $(MYSQL_ROOT_USER) -p$(MYSQL_ROOT_PW)

.PHONY: all start bash-www bash-sql bash-sqladmin bash-mq bash-vscode down destroy mysql
