<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


# Please follow the instructions to setup the project

Install all the dependencies using composer

`composer install`

Copy the example env file and make the required configuration changes in the .env file

`cp .env.example .env`

Make sure you replace these values in .env according to your setup

`FRONTEND_URL=`

`SESSION_DOMAIN=`

`SANCTUM_STATEFUL_DOMAINS=`

Generate a new application key

`php artisan key:generate`


Migrate Database

`php artisan migrate`


Seed Database

`php artisan db:seed`

Run Project

`php artisan serve`


# Run TestCases

`php artisan test`


# Architecure

This project is based on Repository Pattern Architecture.

Please have a look at this blog about repository pattern.

https://medium.com/@farhadmsyv/laravel-repository-pattern-861c2dd96a32
