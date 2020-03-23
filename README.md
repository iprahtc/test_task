# Name

## Table of Contents

[Requirements](#requirements)
[How to](#how-to)
    - [Install](#install)

### Requirements

- Main
    0. PHP 7.2+
    0. MySQL 5.7+

- For dependencies
    0. Composer

### How to

#### Install

1. Clone the repository
2. Set up dependencies
    - composer (`composer install`)
3. Make .env (if it was not created automatically)
    - linux/bash (`cp .env.example .env`)
    - win cmd (`copy .env.example .env`)
4. Generate an application key (if it was not done automatically)
    - `php artisan key:generate --ansi`
5. Change the values in `.env`
    - DB_
6. Compiling assets
    - []
7. Migrations (`php artisan migrate`)
8. Create the encryption keys needed to generate tokens (`php artisan passport:install`)
9. Seeds (`php artisan db:seed`) (The task is not said, but may have time to add)
10. Queue (`php artisan queue:work`)
11. Postman API - Test-task.postman_collection.json
12. Enjoy 😎

