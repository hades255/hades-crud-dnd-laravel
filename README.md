## About Project

This is a Laravel project that create, edit, delete and reord tasks.

Developed with Laravel 10.21.0 PHP 8.2.4

## How to install

### Install Composer
Can setup composer manual.
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### Install Laravel
run the following command in your terminal

```
composer global require laravel/installer
```
Create a new Laravel project using the following command
```
laravel new task-manager
```
Change to the project directory
```
cd task-manager
```

### Replace files
App/Http/Controllers/TaskController.php

App/Livewire/TasksReorder.php

App/Model

Route/web.php

Replace necessary files in Database, Resource and Public folder.

### Config .env || Setup Mysql

Setup Mysql and config mysql database.

Run the database migrations using the following command
```
php artisan migrate
```
```
php artisan db:seed
```
### Add Livewire
Install the Laravel Livewire package for handling dynamic UI interactions
```
composer require livewire/livewire
```
### RUN!
```
php artisan serve
```

---
Thanks for looking my project.
Zhang Zhi

### Screenshot

![/ss/laravel%20crud.png](/ss/laravel%20crud.png)