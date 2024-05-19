## Inventory Application

#### built with

| Tools  |  |
| :--- | :--- |
| Laravel  | https://laravel.com  |
| InertiaJS  | https://inertiajs.com  |
| Vue | https://vuejs.org  |
| TailAdmin | https://tailadmin.com  |
| etc |  |

## setup

#### install dependencies
```
composer install
```

```
npm install
```
#### copy .env
```
copy .env.example .env
```
#### generate application key
```
php artisan key:generate
```
#### storage link
```
php artisan storage:link
```
#### DB configuration
- create database and setup .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<DB_NAME>
DB_USERNAME=<DB_USERNAME>>
DB_PASSWORD=<DB_PASSWORD>
```
#### data example 
> database/seeders


#### database migration and seeder
```
php artisan config:cache
php artisan config:clear
composer dump-autoload
php artisan migrate:fresh --seed
```
#### runnning
```
php artisan serve
```

```
npm run dev
```

#### screenshots

![administrator](screenshots/dashboard.png)

![products](screenshots/products.png)

![roles](screenshots/roles.png)
