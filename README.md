## Installation

1. Clone the repo locally: `git clone https://github.com/AlexProfffi/my.store.technology my.store.technology`
2. Navigate in your Laravel project folder: `cd /your-path/my.store.technology`
3. Run docker containers: `docker-compose up -d`
4. Install project dependencies: `docker exec container_app composer install`
5. Create a new .env file: `cp .env.example .env`
6. Generate application key: `docker exec container_app php artisan key:generate`
7. Generate storage key: `docker exec container_app php artisan storage:link`
8. Run database migrations: `docker exec container_app php artisan migrate:fresh --seed`
9. Install NPM dependencies: `npm install`
10. Clear all cache: `docker exec container_app php artisan optimize:clear`
11. Start the application: `npm run hot`
