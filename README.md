# CodeIgniter4-Docker

## Installation

1. Start up your application by running:

```sh
docker compose up -d
```

2. Execute a command in a running container
```sh
docker exec -it ... bash
```

  - Install or update source (/var/www/html)
```sh
# Install 
composer install --no-dev
```
```sh
# Or update source
composer update
```

  - Import sql
```sh
mysql -u username -p database_name < file.sql
```
