# Article

This is a simple article application using Laravel-admin. where there are several features such as creating, editing, deleting articles.

## Installation

First,you have to run the following command on cmd :

```bash
composer install
```
Then run these commands to publish assets and config：

```bash
php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
```
After run command you can find config file in config/admin.php, in this file you can change the install directory,db connection or table names.
\
\
Now open .env file, end changed like this:

```python
# set database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=article
DB_USERNAME=root
DB_PASSWORD=
```
Run the migrate Artisan command:
```bash
php artisan migrate
```
Then run db:seed Artisan command to seed your database:
```bash
php artisan db:seed
```
At last you may run server using the Artisan CLi's serve command:

```bash
php artisan serve
```

Finally open http://localhost/admin/ in browser,use username admin and password admin to login.

## Environment
- PHP version => PHP/7.4.12
- Laravel version => 5.8.38
- Databse => Mysql
## Dependencies
- php => ^7.1.3
- doctrine/dbal => 2.*
- encore/laravel-admin => ^1.8
- fideloper/proxy => ^4.0
- laravel/framework => 5.8.*
- laravel/tinker => ^1.0
