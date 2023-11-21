## Fake twitter backend

# Backend Manual Setup: (php8.1 and php-mongodb driver is must required)

```bash

1. For Backend manual setup cd into backend directory and just cp .env.example .env and change the .env value accordingly
2. composer dump-autoload
3. composer install
4. php artisan key:generate
5. php artisan config:clear
6. php artisan cache:clear
7. php artisan migrate:fresh
4. php artisan serve --port=9000 
```
