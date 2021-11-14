
## How to run project

Make sure that You have laravel configured locally <br>
Run command
```
git clone https://github.com/jakubcekala/laboratory.git
```
Install composer:
```
composer install
```
Install npm dependencies
```
npm install
```
Create copy of .env file
```
cp .env.example .env
```
Generate an app encryption key
```
php artisan key:generate
```


Create locally MySql database named `laboratory`
and in `.env` file define
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run command
```
php artisan migrate
```
Run command
```
php artisan serve
```
