include ./h11.conf.mk

up:
	composer install
	mkdir -p ./.docker/vscode/.config/code-server/
	mkdir -p ./.docker/vscode/data/User/
	cp ./vendor/h11/vscode-server-config/src/config.yaml ./.docker/vscode/.config/code-server/config.yaml
	cp ./vendor/h11/vscode-server-config/src/settings.json ./.docker/vscode/data/User/settings.json
	docker-compose up -d

down:
	docker-compose down

destroy:
	docker-compose down && sudo rm -rf ./.docker

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
	docker-compose exec wow.stats.sql mysql -u $(MYSQL_ROOT_USER) -p$(MYSQL_ROOT_PW)

.PHONY: all start bash-www bash-sql bash-sqladmin bash-mq bash-vscode down destroy mysql
