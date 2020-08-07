# H11 VSCode template

## Makefile

### Development

#### make build
Executes **docker-compose build**

#### make init
Executes **composer install** and initiates files and folders

#### make up
Executes **docker-compose up -d**

#### make bash-CONTAINERNAME
Opens bash to specified docker container

#### make down
Shutdown all container that are defined in docker-compose file

#### make destroy
Shutdown all container that are defined in docker-compose file and remove **vendor** and **.docker** folder

### Production

#### make init-production
Executes **composer install --no-dev** and initiates files and folders

## Required Makefile config h11.conf.mk

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
- **VSCODE_PW**: vscode password
- **VSCODE_ROOT_PW**: vscode root password
