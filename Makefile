include ./wow.stats.conf.mk

start:
	composer install
	docker-compose up -d

bash-www:
	docker-compose run wow.stats.www bash

bash-sql:
	docker-compose run wow.stats.sql bash

bash-sqladmin:
	docker-compose run wow.stats.sqladmin bash

bash-mq:
	docker-compose run wow.stats.mq bash

bash-vscode:
	docker-compose run wow.stats.vscode bash

down:
	docker-compose down

destroy:
	docker-compose down && sudo rm -rf data

mysql:
	docker-compose exec wow.stats.sql mysql -u $(MYSQL_ROOT_USER) -p$(MYSQL_ROOT_PW)

.PHONY: all start bash-www bash-sql bash-sqladmin bash-mq bash-vscode down destroy mysql
