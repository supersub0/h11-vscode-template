# H11 VSCode template

## Makefile

### Development

#### make build
Builds images defined in docker-compose file

#### make init
Executes composer installation and initiates files and folders

#### make up
Starts container defined in docker-compose file

#### make down
Shutdown all container that are defined in docker-compose file

#### make destroy
Shutdown all container that are defined in docker-compose file and remove **vendor** and **.docker** folder

#### make bash-CONTAINERNAME
Opens bash to specified docker container

### Production

#### make build-production
Builds images defined in docker-compose file

#### make init-production
Executes composer installation

#### make up-production
Starts container defined in docker-compose file

#### make down-production
Shutdown all container that are defined in docker-compose file

#### make destroy-production
Shutdown all container that are defined in docker-compose file and remove **vendor** and **.docker** folder

#### make bash-CONTAINERNAME
Opens bash to specified docker container

## Required Makefile config h11.conf.mk

### Values

- **MYSQL_DB**: mysql database name
- **MYSQL_USER**: mysql user name
- **MYSQL_PW**: mysql password
- **MYSQL_ROOT_USER**: mysql root user
- **MYSQL_ROOT_PW**: mysql root password
- **UID**: current user id
- **GID**: current user group
- **VSCODE_PW**: vscode password
- **VSCODE_ROOT_PW**: vscode root password
