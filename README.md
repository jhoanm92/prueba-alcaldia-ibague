# Oracle Test

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x)

Requirements

    PHP 8.1
    NODE 18
    ORACLE
    Extension PHP oci19


Install all the dependencies using composer

    composer install   

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Install all dependencies using node

    npm install

Compile all dependencies using node

    npm run dev

Run the database migrations & seeder (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh --seed

Start the local development server

    php artisan serve


**TL;DR command list**
    
    composer install    
    cp .env.example .env
    php artisan key:generate
    npm install
    npm run dev
    php artisan migrate:fresh --seed
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan serve

----------

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Http/Requests` - Contains all the form requests
- `app/Http/Feature` - Contains all logic business depending on the function
- `config` - Contains all the application configuration files (**How datatable or oracle config)
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the web routes defined in web.php file
- `tests` - Contains all the web tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing

Run the laravel test 

    php artisan test

Run the laravel development server

    php artisan serve

User login

    admin@admin.com
    password

