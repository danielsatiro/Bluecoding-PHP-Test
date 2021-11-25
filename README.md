### System Requirements

- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### Install via Docker
    docker-compose up -d
    docker exec -it blue-coding_php_1 bash

### Commands to install on Server/Docker
    composer install
    cp .env.example .env
    php artisan migrate
Config the file `.env` as the environment

### Write permissions on:
    bootstrap/cache/
    storage/

### Running Tests
    php artinsa test

### Changing Queue connection
The queue is configured to run synchronously, to run asynchronously change the `QUEUE_CONNECTION` key from `sync` to `redis` in the `.env` file and run the `php artisan queue:work &` line command

### Navigation
- Go to `http://localhost` to see the the top 100 board
- Click Create on top right to shorten new URLs