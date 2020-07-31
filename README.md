# wow.stats

## Makefile

### development

#### make or make start
Executes **composer install** and **docker-compose up -d**

#### make bash-CONTAINERNAME
Opens bash to specified docker container

#### make down
Shutdown all container that are defined in docker-compose file

#### make destroy
Destroy all container that are defined in docker-compose file

#### make mysql
Opens mysql connection for mysql server defined in docker-compose

### production

#### make or make start
Executes **composer install** and **docker-compose up -d**

#### make bash-CONTAINERNAME
Opens bash to specified docker container

#### make down
Shutdown all container that are defined in docker-compose file

#### make destroy
Destroy all container that are defined in docker-compose file

#### make mysql
Opens mysql connection for mysql server defined in docker-compose

## Required Makefile config wow.stats.conf.mk

### Values

- **RABBITMQ_USER**: rabbit mq user
- **RABBITMQ_PW**: rabbit mq password
- **MYSQL_DB**: mysql database name
- **MYSQL_USER**: mysql user name
- **MYSQL_PW**: mysql password
- **MYSQL_ROOT_USER**: mysql root user
- **MYSQL_ROOT_PW**: mysql root password
- **UID**: current user id
- **GID**: current user group
