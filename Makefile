include ./wow.stats.conf.mk

all: start

start:
	composer install
	docker-compose up -d

bash:
	docker-compose run www bash

down:
	docker-compose down

destroy:
	docker-compose down && sudo rm -rf data

mysql:
	docker-compose exec db mysql -u $(MYSQL_ROOT_USER) -p$(MYSQL_ROOT_PW)

.PHONY: all start daemon bash destroy mysql
